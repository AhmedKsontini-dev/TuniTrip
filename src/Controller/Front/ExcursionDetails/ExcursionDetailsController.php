<?php

namespace App\Controller\Front\ExcursionDetails;

use App\Entity\ReservationExcursion;
use App\Entity\FAQExcursion;
use App\Entity\AvisExcursion;
use App\Form\ReservationExcursionType;
use App\Form\FaqExcursionType;
use App\Form\AvisExcursionType;
use App\Repository\ExcursionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\ExcursionPriceCalculator;
use Symfony\Component\Security\Core\Security;

final class ExcursionDetailsController extends AbstractController
{
    #[Route('/excursion/details/{slug}', name: 'app_front_excursion_details')]
    public function index(
        string $slug,
        ExcursionRepository $excursionRepository,
        Request $request,
        EntityManagerInterface $em,
        ExcursionPriceCalculator $priceCalculator
    ): Response
    {
        // -------------- EXCURSION ------------------
        $excursion = $excursionRepository->findOneBy(['slug' => $slug]);
        if (!$excursion) {
            throw $this->createNotFoundException('Excursion non trouvée.');
        }

        // -------------- RÉSERVATION ----------------
        $reservation = new ReservationExcursion();
        $reservation->setExcursion($excursion);
        $reservation->setDateCreation(new \DateTime());
        $reservation->setStatut('en attente');

        $reservationForm = $this->createForm(ReservationExcursionType::class, $reservation);
        $reservationForm->handleRequest($request);

        $reservationOK = false;

        if ($reservationForm->isSubmitted() && $reservationForm->isValid()) {

            $totalPrice = $priceCalculator->calculate($reservation);
            $reservation->setPrixTotal($totalPrice);

            $em->persist($reservation);
            $em->flush();

            $this->addFlash("success", "Réservation effectuée avec succès !");
            $reservationOK = true;
        }

        // -------------- FAQ ------------------------
        $faqs = $em->getRepository(FaqExcursion::class)->findBy(
            ['excursion' => $excursion],
            ['ordre' => 'ASC']
        );

        $faq = new FaqExcursion();
        $faq->setExcursion($excursion);

        $faqForm = $this->createForm(FaqExcursionType::class, $faq);
        $faqForm->handleRequest($request);

        if ($faqForm->isSubmitted() && $faqForm->isValid()) {
            $faq->setOrdre(count($faqs) + 1);

            $em->persist($faq);
            $em->flush();

            $this->addFlash('success', 'Votre question a été ajoutée !');
            return $this->redirectToRoute('app_front_excursion_details', ['id' => $id]);
        }

        // -------------- AVIS ------------------------
        $avisRepository = $em->getRepository(AvisExcursion::class);

        $avis = $avisRepository->findBy(
            ['excursion' => $excursion],
            ['createdAt' => 'DESC']
        );

        // calcul moyenne
        $noteMoyenne = null;
        if (count($avis) > 0) {
            $noteMoyenne = array_sum(array_map(fn($a) => $a->getNote(), $avis)) / count($avis);
        }

        // Formulaire avis
        $nouvelAvis = new AvisExcursion();
        $nouvelAvis->setExcursion($excursion);
        $nouvelAvis->setCreatedAt(new \DateTimeImmutable());

        if ($this->getUser()) {
            $nouvelAvis->setUser($this->getUser());
        }

        $avisForm = $this->createForm(AvisExcursionType::class, $nouvelAvis);
        $avisForm->handleRequest($request);

        if ($avisForm->isSubmitted() && $avisForm->isValid()) {

            if (!$this->getUser()) {
                $this->addFlash('error', 'Vous devez être connecté pour laisser un avis.');
                return $this->redirectToRoute('app_login');
            }

            $em->persist($nouvelAvis);
            $em->flush();

            $this->addFlash('success', 'Merci pour votre avis !');
            return $this->redirectToRoute('app_front_excursion_details', ['id' => $id]);
        }

        // -------------- AUTRES DONNÉES ----------------
        $imagePrincipale = $excursion->getImagePrincipale();
        $excursion->imagePrincipalePath = $imagePrincipale 
            ? '/uploads/images/' . $imagePrincipale
            : '/images/default-excursion.jpg';

        $images        = $excursion->getImages();
        $inclusList    = $excursion->getInclusList();
        $nonInclusList = $excursion->getNonInclusList();
        $itineraires   = $excursion->getItineraires();

        // favoris
        $userFavorisIds = [];
        if ($this->getUser()) {
            $userFavorisIds = $this->getUser()->getFavoris()->map(
                fn($f) => $f->getExcursion()->getId()
            )->toArray();
        }

        // -------------- RENDER ----------------
        return $this->render('Front/ExcursionDetails/index.html.twig', [
            'excursion'        => $excursion,
            'images'           => $images,
            'inclusList'       => $inclusList,
            'nonInclusList'    => $nonInclusList,
            'itineraires'      => $itineraires,

            // réservation
            'reservationForm'  => $reservationForm->createView(),
            'reservationOK'    => $reservationOK,
            'reservation'      => $reservation,

            // FAQ
            'faqs'             => $faqs,
            'faqForm'          => $faqForm->createView(),

            // Avis
            'avis'             => $avis,
            'noteMoyenne'      => $noteMoyenne,
            'avisForm'         => $avisForm->createView(),

            'userFavorisIds'   => $userFavorisIds,
        ]);
    }

    #[Route('/excursion/{id}/avis/add', name: 'ajax_add_avis', methods: ['POST'])]
    public function ajaxAddAvis(
        int $id,
        ExcursionRepository $excursionRepository,
        Request $request,
        EntityManagerInterface $em
    ): Response {
        $excursion = $excursionRepository->find($id);

        $avis = new AvisExcursion();
        $avis->setExcursion($excursion);
        $avis->setCreatedAt(new \DateTimeImmutable());
        if ($this->getUser()) {
            $avis->setUser($this->getUser());
        }

        $form = $this->createForm(AvisExcursionType::class, $avis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($avis);
            $em->flush();

            return $this->json([
                'success' => true,
                'html' => $this->renderView('Front/ExcursionDetails/_avis_item.html.twig', [
                    'a' => $avis
                ])
            ]);
        }

        return $this->json(['success' => false], 400);
    }

    #[Route('/excursion/{id}/faq/add', name: 'ajax_add_faq', methods: ['POST'])]
    public function ajaxAddFaq(
        int $id,
        ExcursionRepository $excursionRepository,
        Request $request,
        EntityManagerInterface $em
    ): Response {
        $excursion = $excursionRepository->find($id);

        $faq = new FaqExcursion();
        $faq->setExcursion($excursion);

        $form = $this->createForm(FaqExcursionType::class, $faq);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // ordre auto
            $faq->setOrdre(
                count($excursion->getFaqs()) + 1
            );

            $em->persist($faq);
            $em->flush();

            return $this->json([
                'success' => true,
                'html' => $this->renderView('Front/ExcursionDetails/_faq_item.html.twig', [
                    'faq' => $faq,
                    'index' => $faq->getId()
                ])
            ]);
        }

        return $this->json(['success' => false], 400);
    }

   


}
