<?php

namespace App\Controller\Back\ReservationExcur;

use App\Entity\ReservationExcursion;
use App\Form\ReservationExcursionType;
use App\Repository\ReservationExcursionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/back/reservation/excursion')]
final class BackReservationExcurController extends AbstractController
{
    #[Route(name: 'app_reservation_excursion_index', methods: ['GET'])]
    public function index(ReservationExcursionRepository $reservationExcursionRepository): Response
    {
        return $this->render('Back/reservation_excursion/index.html.twig', [
            'reservation_excursions' => $reservationExcursionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_reservation_excursion_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reservationExcursion = new ReservationExcursion();
        $form = $this->createForm(ReservationExcursionType::class, $reservationExcursion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservationExcursion);
            $entityManager->flush();

            return $this->redirectToRoute('app_reservation_excursion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Back/reservation_excursion/new.html.twig', [
            'reservation_excursion' => $reservationExcursion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reservation_excursion_show', methods: ['GET'])]
    public function show(ReservationExcursion $reservationExcursion): Response
    {
        return $this->render('Back/reservation_excursion/show.html.twig', [
            'reservation_excursion' => $reservationExcursion,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reservation_excursion_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ReservationExcursion $reservationExcursion, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReservationExcursionType::class, $reservationExcursion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reservation_excursion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Back/reservation_excursion/edit.html.twig', [
            'reservation_excursion' => $reservationExcursion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reservation_excursion_delete', methods: ['POST'])]
    public function delete(Request $request, ReservationExcursion $reservationExcursion, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservationExcursion->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($reservationExcursion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reservation_excursion_index', [], Response::HTTP_SEE_OTHER);
    }
}
