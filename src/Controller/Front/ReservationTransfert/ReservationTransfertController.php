<?php

namespace App\Controller\Front\ReservationTransfert;

use App\Entity\ReservationTransfert;
use App\Entity\TrajetTransfert;
use App\Enum\TransferType;
use App\Form\ReservationTransfertType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\TransferPriceCalculator;

#[Route('/reservation-transfert')]
class ReservationTransfertController extends AbstractController
{
    #[Route('/new/{id}', name: 'app_reservation_transfert_new', methods: ['GET', 'POST'])]
    public function new(
        TrajetTransfert $trajetTransfert,
        Request $request,
        EntityManagerInterface $em,
        TransferPriceCalculator $calculator
    ): Response {
        $reservation = new ReservationTransfert();
        $reservation->setTrajetTransfert($trajetTransfert);

        // 🟢 Lieux automatiques
        $reservation->setPickupLocation($trajetTransfert->getLieuDepart());
        $reservation->setDropoffLocation($trajetTransfert->getLieuArrivee());

        $form = $this->createForm(ReservationTransfertType::class, $reservation);
        $form->handleRequest($request);

        $showModal = false;

        if ($form->isSubmitted() && $form->isValid()) {
            // 🔹 Calcul du prix via le service
            $price = $calculator->calculate($reservation);
            $reservation->setPrixTotal($price);
            $reservation->setStatut('en_attente');
            $reservation->setCreatedAt(new \DateTime());

            $em->persist($reservation);
            $em->flush();

            // 🔹 Activer le modal dans le template
            $showModal = true;
        }

        return $this->render('Front/reservation_transfert/new.html.twig', [
            'form' => $form->createView(),
            'trajet' => $trajetTransfert,
            'reservation' => $reservation,
            'showModal' => $showModal,
        ]);
    }

}
