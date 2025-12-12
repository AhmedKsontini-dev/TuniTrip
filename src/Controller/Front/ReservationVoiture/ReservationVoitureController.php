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

class ReservationVoitureController extends AbstractController
{
    #[Route('/reserver-voiture/{id}', name: 'app_reservation_voiture')]
    public function reserver(int $id, Request $request, EntityManagerInterface $em): Response
    {
        // Récupérer la voiture
        $voiture = $em->getRepository(Voitures::class)->find($id);
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
                    'id' => $voiture->getId()
                ]);
            
        }

        return $this->render('Front/reservation_voiture/form.html.twig', [
            'form' => $form->createView(),
            'voiture' => $voiture,
        ]);
    }

    #[Route('/reservation-voiture/check-disponibilite', name: 'reservation_voiture_check_dispo', methods: ['POST'])]
    public function checkDisponibilite(Request $request, ReservationVoitureRepository $repo): JsonResponse
    {
        $voitureId = $request->request->get('voitureId');
        $dateDebut = new \DateTime($request->request->get('dateDebut'));
        $dateFin = new \DateTime($request->request->get('dateFin'));

        $existing = $repo->findOverlapReservation($voitureId, $dateDebut, $dateFin);

        if ($existing) {
            return new JsonResponse([
                'available' => false,
                'message' => sprintf(
                    "Cette voiture n’est pas disponible du %s au %s.",
                    $existing->getDateDebut()->format('d/m/Y'),
                    $existing->getDateFin()->format('d/m/Y')
                )
            ]);
        }

        return new JsonResponse([
            'available' => true
        ]);
    }
}
