<?php

namespace App\Controller\Back\Calendar;

use App\Entity\ReservationExcursion;
use App\Entity\ReservationVoiture;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/calendar')]
class CalendarController extends AbstractController
{
    #[Route('/', name: 'admin_calendar_index')]
    public function index(EntityManagerInterface $em): Response
    {
        $events = [];

        // 1. Récupérer les réservations d'excursions acceptées
        $resExcursions = $em->getRepository(ReservationExcursion::class)->findBy(['statut' => 'acceptee']);
        foreach ($resExcursions as $res) {
            $excursionTitle = $res->getExcursion() ? $res->getExcursion()->getTitre() : 'Excursion inconnue';
            $clientName = $res->getPrenom() . ' ' . $res->getNom();
            
            $events[] = [
                'id' => 'exc_' . $res->getId(),
                'title' => "🏖️ " . $excursionTitle . " (" . $clientName . ")",
                'start' => $res->getDateHeure() ? $res->getDateHeure()->format('Y-m-d H:i:s') : null,
                'backgroundColor' => '#4e73df', // Bleu
                'borderColor' => '#4e73df',
                'textColor' => '#ffffff',
                'allDay' => false,
                'extendedProps' => [
                    'reservationId' => $res->getId(),
                    'type' => 'Excursion'
                ]
            ];
        }

        // 2. Récupérer les réservations de voitures acceptées
        $resVoitures = $em->getRepository(ReservationVoiture::class)->findBy(['statut' => 'acceptee']);
        foreach ($resVoitures as $res) {
            $voitureModel = $res->getVoiture() ? $res->getVoiture()->getModele() : 'Voiture inconnue';
            $clientName = $res->getPrenom() . ' ' . $res->getNom();

            $events[] = [
                'id' => 'voit_' . $res->getId(),
                'title' => "🚗 Loc: " . $voitureModel . " (" . $clientName . ")",
                'start' => $res->getDateDebut() ? $res->getDateDebut()->format('Y-m-d') : null,
                'end' => $res->getDateFin() ? $res->getDateFin()->format('Y-m-d') : null,
                'backgroundColor' => '#1cc88a', // Vert
                'borderColor' => '#1cc88a',
                'textColor' => '#ffffff',
                'allDay' => true,
                'extendedProps' => [
                    'reservationId' => $res->getId(),
                    'type' => 'Voiture'
                ]
            ];
        }

        // 3. Récupérer les réservations de transferts
        $resTransferts = $em->getRepository(\App\Entity\ReservationTransfert::class)->findBy(['statut' => 'confirmee']);
        foreach ($resTransferts as $res) {
            $clientName = $res->getFirstName() . ' ' . $res->getLastName();
            $trajet = $res->getPickupLocation() . ' -> ' . $res->getDropoffLocation();
            
            // Combine Date and Time for Pickup
            $startDateTime = null;
            if ($res->getPickupDate() && $res->getPickupTime()) {
                $startDateTime = $res->getPickupDate()->format('Y-m-d') . ' ' . $res->getPickupTime()->format('H:i:s');
            } elseif ($res->getPickupDate()) {
                $startDateTime = $res->getPickupDate()->format('Y-m-d');
            }

            if ($startDateTime) {
                $events[] = [
                    'id' => 'trans_' . $res->getId(),
                    'title' => "🚕 Transfert: " . $trajet . " (" . $clientName . ")",
                    'start' => $startDateTime,
                    'backgroundColor' => '#f6c23e', // Jaune/Orange
                    'borderColor' => '#f6c23e',
                    'textColor' => '#ffffff',
                    'allDay' => false,
                    'extendedProps' => [
                        'reservationId' => $res->getId(),
                        'type' => 'Transfert'
                    ]
                ];
            }

            // Handle Return Trip if exists
            if ($res->getReturnPickupDate()) {
                $returnStartDateTime = $res->getReturnPickupDate()->format('Y-m-d');
                if ($res->getReturnPickupTime()) {
                     $returnStartDateTime .= ' ' . $res->getReturnPickupTime()->format('H:i:s');
                }
                
                $events[] = [
                    'id' => 'trans_ret_' . $res->getId(),
                    'title' => "🚕 Retour: " . $res->getReturnPickupLocation() . " -> " . $res->getReturnDropoffLocation() . " (" . $clientName . ")",
                    'start' => $returnStartDateTime,
                    'backgroundColor' => '#f6c23e', 
                    'borderColor' => '#f6c23e',
                    'textColor' => '#ffffff',
                    'allDay' => false,
                    'extendedProps' => [
                        'reservationId' => $res->getId(),
                        'type' => 'Transfert (Retour)'
                    ]
                ];
            }
        }

        return $this->render('Back/Calendar/index.html.twig', [
            'events' => json_encode($events),
        ]);
    }
}
