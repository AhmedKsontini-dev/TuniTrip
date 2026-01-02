<?php

namespace App\Controller\Front\ReservationVoiture;

use App\Entity\ReservationVoiture;
use App\Entity\Voitures;
use App\Form\ReservationVoitureType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ReservationVoitureRepository;
use App\Repository\VoituresRepository;
use Symfony\Component\String\Slugger\SluggerInterface;

class ReservationVoitureController extends AbstractController
{
    #[Route('/reserver-voiture/{slug}', name: 'app_reservation_voiture')]
    public function reserver(string $slug, Request $request, EntityManagerInterface $em, VoituresRepository $voituresRepository): Response
    {
        // Récupérer la voiture par son slug
        $voiture = $voituresRepository->findOneBy(['slug' => $slug]);
        if (!$voiture) {
            throw $this->createNotFoundException("Voiture introuvable");
        }

        // Nouvelle réservation
        $reservation = new ReservationVoiture();
        $reservation->setVoiture($voiture);

        $form = $this->createForm(ReservationVoitureType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dateDebut = $reservation->getDateDebut();
            $dateFin = $reservation->getDateFin();

            
                // ======== CALCUL DU PRIX TOTAL ==========
                $nbJours = $dateDebut->diff($dateFin)->days;

                if ($nbJours >= 28 && $nbJours <= 31) {
                    $prixTotal = $voiture->getPrixMois(); // prix mensuel si plus de 25 jours
                } else {
                    $prixTotal = $nbJours * $voiture->getPrixJour(); // prix journalier sinon
                }

                $reservation->setPrixTotal($prixTotal);
                // ========================================

                $reservation->setCreatedAt(new \DateTime());
                $reservation->setUpdatedAt(new \DateTime());

                $em->persist($reservation);
                $em->flush();

                // Message de succès
                $this->addFlash('reservation_success', [
                    'nom' => $reservation->getNom(),
                    'prenom' => $reservation->getPrenom(),
                    'dateDebut' => $reservation->getDateDebut()->format('d/m/Y'),
                    'dateFin' => $reservation->getDateFin()->format('d/m/Y'),
                    'marque' => $voiture->getMarque(),
                    'modele' => $voiture->getModele(),
                    'prixJour' => $voiture->getPrixJour(),
                    'prixTotal' => $prixTotal,
                    'email' => $reservation->getEmail(),
                ]);

                return $this->redirectToRoute('app_reservation_voiture', [
                    'slug' => $voiture->getSlug()
                ]);
            
        }

        return $this->render('Front/reservation_voiture/form.html.twig', [
            'form' => $form->createView(),
            'voiture' => $voiture,
        ]);
    }


}
