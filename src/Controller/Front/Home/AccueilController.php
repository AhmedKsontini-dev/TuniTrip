<?php

namespace App\Controller\Front\Home;

use App\Entity\ContactMessage;
use App\Entity\Avis;
use App\Form\ContactMessageType;
use App\Form\AvisType;
use App\Repository\TransfereRepository;
use App\Repository\VoituresRepository;
use App\Repository\ExcursionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

final class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(
        TransfereRepository $transfereRepository,
        VoituresRepository $voituresRepository,
        ExcursionRepository $excursionRepository,
        EntityManagerInterface $em,
        Request $request
    ): Response
    {
        // ====================== TRANSFERTS ======================
        $transferes = $transfereRepository->findAll();
        $tunisCarthageTransfers = [];
        $enfidhaTransfers = [];

        foreach ($transferes as $t) {
            $lieuDepart = strtolower(trim($t->getLieuDepart()));
            if (str_contains($lieuDepart, 'tunis carthage')) {
                $tunisCarthageTransfers[] = $t;
            } elseif (str_contains($lieuDepart, 'enfidha')) {
                $enfidhaTransfers[] = $t;
            }
        }

        // ====================== VOITURES ======================
        $voitures = $voituresRepository->findBy(['disponible' => true]);

        // ====================== AVIS ======================
        $avisRepository = $em->getRepository(Avis::class);
        $avis = $avisRepository->findBy([], ['dateCreation' => 'DESC']);

        // ====================== FORMULAIRE AVIS ======================
        $avisEntity = new Avis();
        $formAvis = $this->createForm(AvisType::class, $avisEntity);
        $formAvis->handleRequest($request);

        if ($formAvis->isSubmitted() && $formAvis->isValid()) {
            $avisEntity->setDateCreation(new \DateTime());
            $em->persist($avisEntity);
            $em->flush();

            // Si envoi via AJAX
            if ($request->isXmlHttpRequest()) {
                return new JsonResponse([
                    'success' => true,
                    'message' => 'Merci pour votre avis !',
                    'avis' => [
                        'nom' => $avisEntity->getNom(),
                        'prenom' => $avisEntity->getPrenom(),
                        'commentaire' => $avisEntity->getCommentaire(),
                        'etoiles' => $avisEntity->getEtoiles(),
                        'date' => $avisEntity->getDateCreation()->format('F d, Y')
                    ]
                ]);
            }

            $this->addFlash('success', 'Merci pour votre avis !');
            return $this->redirectToRoute('app_accueil');
        }

        // ====================== FORMULAIRE CONTACT ======================
        $contact = new ContactMessage();
        $form = $this->createForm(ContactMessageType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $contact->setDateEnvoi(new \DateTime());
                $em->persist($contact);
                $em->flush();

                if ($request->isXmlHttpRequest()) {
                    return new JsonResponse([
                        'success' => true,
                        'message' => 'Votre message a été envoyé avec succès !'
                    ]);
                }

                $this->addFlash('success', 'Votre message a été envoyé avec succès !');
            } else {
                if ($request->isXmlHttpRequest()) {
                    $errors = [];
                    foreach ($form->getErrors(true) as $error) {
                        $errors[] = $error->getMessage();
                    }

                    return new JsonResponse([
                        'success' => false,
                        'message' => 'Le formulaire contient des erreurs.',
                        'errors' => $errors
                    ]);
                }
            }
        }

        // ====================== EXCURSIONS ======================
        $excursions = $excursionRepository->findLastExcursions(4);

        foreach ($excursions as $excursion) {
            $excursion->mainImagePath = $excursion->getImagePrincipale()
                ? '/uploads/images/' . $excursion->getImagePrincipale()
                : '/images/default-excursion.jpg';
        }

        // ====================== RENDER ======================
        return $this->render('Front/Home/index.html.twig', [
            'tunisCarthageTransfers' => $tunisCarthageTransfers,
            'enfidhaTransfers' => $enfidhaTransfers,
            'voitures' => $voitures,
            'form' => $form->createView(),
            'avis' => $avis,
            'excursions' => $excursions,
            'formAvis' => $formAvis->createView(),
            'user' => $this->getUser(),
        ]);
    }

    #[Route('/avis/add', name: 'avis_add', methods: ['POST'])]
    public function addAvis(Request $request, EntityManagerInterface $em): JsonResponse
    {
        if (!$this->getUser()) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Vous devez être connecté pour laisser un avis.'
            ], 403);
        }

        $data = json_decode($request->getContent(), true);

        $avis = new Avis();

        
        // Rattacher l'avis à l'utilisateur connecté
        $avis->setUser($this->getUser());

        // Récupérer nom & prénom depuis l'utilisateur connecté
        $user = $this->getUser();
        $avis->setNom($user->getNom());
        $avis->setPrenom($user->getPrenom());

        // Données envoyées par le formulaire
        $avis->setCommentaire($data['commentaire'] ?? '');
        $avis->setEtoiles((int)($data['etoiles'] ?? 0));
        $avis->setDateCreation(new \DateTime());

        $em->persist($avis);
        $em->flush();

        return new JsonResponse([
            'success' => true,
            'message' => 'Merci pour votre avis !',
            'avis' => [
                'nom' => $avis->getNom(),
                'prenom' => $avis->getPrenom(),
                'commentaire' => $avis->getCommentaire(),
                'etoiles' => $avis->getEtoiles(),
                'date' => $avis->getDateCreation()->format('F d, Y')
            ]
        ]);
    }


}
