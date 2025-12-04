<?php
namespace App\Controller\Front\ReservationExcursion;

use App\Entity\ReservationExcursion;
use App\Form\ReservationExcursionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationExcursionController extends AbstractController
{
    #[Route('/excursion', name: 'reservation_excursion')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $reservation = new ReservationExcursion();
        $reservation->setDateCreation(new \DateTime());
        $reservation->setStatut('en attente');

        $form = $this->createForm(ReservationExcursionType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($reservation);
            $em->flush();

            $this->addFlash('success', 'Réservation effectuée avec succès !');
            return $this->redirectToRoute('reservation_excursion');
        }

        return $this->render('front/excursion/index.html.twig', [
            'reservationForm' => $form->createView(),
        ]);
    }
}
