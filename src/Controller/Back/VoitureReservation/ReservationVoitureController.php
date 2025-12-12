<?php

namespace App\Controller\Back\VoitureReservation;

use App\Entity\ReservationVoiture;
use App\Form\ReservationVoitureType;
use App\Repository\ReservationVoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/reservation/voiture')]
final class ReservationVoitureController extends AbstractController
{
    #[Route(name: 'app_reservation_voiture_index', methods: ['GET'])]
    public function index(ReservationVoitureRepository $reservationVoitureRepository): Response
    {
        return $this->render('Back/reservation_voitu/index.html.twig', [
            'reservation_voitures' => $reservationVoitureRepository->findBy([], ['createdAt' => 'DESC']),
        ]);
    }

    #[Route('/{id}/statut/{statut}', name: 'app_reservation_voiture_update_statut', methods: ['POST', 'GET'])]
    public function updateStatut(
        ReservationVoiture $reservation,
        string $statut,
        EntityManagerInterface $entityManager,
        \App\Service\TuniTripMailer $mailer
    ): Response {
        $reservation->setStatut($statut);
        $entityManager->flush();

        if ($statut === 'confirmee') {
            $mailer->sendCarReservationConfirmation($reservation);
            $this->addFlash('success', "Réservation confirmée et email envoyé. ✅");
        } else {
            $this->addFlash('success', "Statut mis à jour en : $statut");
        }

        return $this->redirectToRoute('app_reservation_voiture_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/new', name: 'app_reservation_voiture_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reservationVoiture = new ReservationVoiture();
        $form = $this->createForm(ReservationVoitureType::class, $reservationVoiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservationVoiture);
            $entityManager->flush();

            return $this->redirectToRoute('app_reservation_voiture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Back/reservation_voitu/new.html.twig', [
            'reservation_voiture' => $reservationVoiture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reservation_voiture_show', methods: ['GET'])]
    public function show(ReservationVoiture $reservationVoiture): Response
    {
        return $this->render('Back/reservation_voitu/show.html.twig', [
            'reservation_voiture' => $reservationVoiture,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reservation_voiture_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ReservationVoiture $reservationVoiture, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReservationVoitureType::class, $reservationVoiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reservation_voiture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Back/reservation_voitu/edit.html.twig', [
            'reservation_voiture' => $reservationVoiture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/voucher', name: 'app_reservation_voiture_voucher', methods: ['GET'])]
    public function voucher(ReservationVoiture $reservationVoiture): Response
    {
        return $this->render('Back/reservation_voitu/voucher.html.twig', [
            'reservation_voiture' => $reservationVoiture,
        ]);
    }

    #[Route('/{id}', name: 'app_reservation_voiture_delete', methods: ['POST'])]
    public function delete(Request $request, ReservationVoiture $reservationVoiture, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservationVoiture->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($reservationVoiture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reservation_voiture_index', [], Response::HTTP_SEE_OTHER);
    }
}
