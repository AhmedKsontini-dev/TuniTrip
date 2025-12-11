<?php

namespace App\Controller\Back\ReservationTrans;

use App\Entity\ReservationTransfert;
use App\Repository\ReservationTransfertRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Service\TransferPriceCalculator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


#[Route('/back/reservation-transfert')]
class BackReservationTransfertController extends AbstractController
{
    #[Route('/', name: 'back_reservation_transfert_index')]
    public function index(ReservationTransfertRepository $repo): Response
    {
        $reservations = $repo->findBy([], ['createdAt' => 'DESC']);

        return $this->render('Back/reservation_trans/index.html.twig', [
            'reservations' => $reservations,
        ]);
    }

    #[Route('/{id}', name: 'admin_reservation_transfert_show', methods: ['GET'])]
    public function show(ReservationTransfert $reservation): Response
    {
        return $this->render('Back/reservation_trans/show.html.twig', [
            'reservation' => $reservation,
        ]);
    }

    #[Route('/{id}/statut/{statut}', name: 'admin_reservation_transfert_update_statut', methods: ['POST', 'GET'])]
    public function updateStatut(
        ReservationTransfert $reservation,
        string $statut,
        EntityManagerInterface $em,
        \App\Service\TuniTripMailer $mailer
    ): Response {
        $reservation->setStatut($statut);
        $em->flush();

        // 📩 Envoi automatique si confirmé
        if ($statut === 'confirmee') {
            $mailer->sendReservationConfirmation($reservation);
            $this->addFlash('success', "Réservation confirmée et email envoyé au client. ✅");
        } else {
            $this->addFlash('success', "Statut mis à jour en : $statut");
        }

        return $this->redirectToRoute('back_reservation_transfert_index');
    }


    #[Route('/{id}/recalculate-price', name: 'admin_reservation_transfert_recalculate_price', methods: ['POST'])]
    public function recalculatePrice(
        ReservationTransfert $reservation,
        Request $request,
        TransferPriceCalculator $priceCalculator,
        EntityManagerInterface $em
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);

        // Mise à jour temporaire des champs pour calcul
        if (isset($data['persons'])) {
            $reservation->setPersons((int) $data['persons']);
        }

        if (isset($data['transferType'])) {
            $reservation->setTransferType(\App\Enum\TransferType::from($data['transferType']));
        }

        $prixTotal = $priceCalculator->calculate($reservation);
        $reservation->setPrixTotal($prixTotal);
        $em->flush();

        return new JsonResponse(['prixTotal' => $prixTotal]);
    }

    #[Route('/{id}/update-fields', name: 'admin_reservation_transfert_update_fields', methods: ['POST'])]
    public function updateFields(
        ReservationTransfert $reservation,
        Request $request,
        TransferPriceCalculator $priceCalculator,
        EntityManagerInterface $em
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);

        $reservation->setFirstName($data['firstName'] ?? $reservation->getFirstName());
        $reservation->setLastName($data['lastName'] ?? $reservation->getLastName());
        $reservation->setEmail($data['email'] ?? $reservation->getEmail());
        $reservation->setTel($data['tel'] ?? $reservation->getTel());
        $reservation->setWhatsappNumber($data['whatsappNumber'] ?? $reservation->getWhatsappNumber());
        $reservation->setFlightNumber($data['flightNumber'] ?? $reservation->getFlightNumber());
        $reservation->setComments($data['comments'] ?? $reservation->getComments());

        $reservation->setPersons((int)($data['persons'] ?? $reservation->getPersons()));
        if(isset($data['transferType'])){
            $reservation->setTransferType(\App\Enum\TransferType::from($data['transferType']));
        }

        // Dates et lieux
        $reservation->setPickupDate(!empty($data['pickupDate']) ? new \DateTime($data['pickupDate']) : null);
        $reservation->setPickupTime(!empty($data['pickupTime']) ? new \DateTime($data['pickupTime']) : null);
        $reservation->setPickupLocation($data['pickupLocation'] ?? null);
        $reservation->setDropoffLocation($data['dropoffLocation'] ?? null);
        $reservation->setReturnPickupDate(!empty($data['returnPickupDate']) ? new \DateTime($data['returnPickupDate']) : null);
        $reservation->setReturnPickupTime(!empty($data['returnPickupTime']) ? new \DateTime($data['returnPickupTime']) : null);
        $reservation->setReturnPickupLocation($data['returnPickupLocation'] ?? null);
        $reservation->setReturnDropoffLocation($data['returnDropoffLocation'] ?? null);

        // Recalcul automatique du prix
        $reservation->setPrixTotal($priceCalculator->calculate($reservation));

        $em->flush();

        return new JsonResponse(['success' => true, 'prixTotal' => $reservation->getPrixTotal()]);
    }

    #[Route('/{id}/delete', name: 'admin_reservation_transfert_delete', methods: ['POST'])]
    public function delete(?ReservationTransfert $reservation, EntityManagerInterface $em): Response
    {
        if (!$reservation) {
            throw new NotFoundHttpException('Réservation introuvable.');
        }

        $em->remove($reservation);
        $em->flush();

        return $this->redirectToRoute('back_reservation_transfert_index');
    }

    




}
