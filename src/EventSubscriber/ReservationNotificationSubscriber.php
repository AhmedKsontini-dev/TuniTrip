<?php
namespace App\EventSubscriber;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Environment;

/**
 * EventSubscriber pour injecter les notifications de réservations récentes 
 * dans toutes les pages du backend.
 */
class ReservationNotificationSubscriber implements EventSubscriberInterface
{
    private Environment $twig;
    private EntityManagerInterface $em;
    private RequestStack $requestStack;

    public function __construct(
        Environment $twig, 
        EntityManagerInterface $em,
        RequestStack $requestStack
    ) {
        $this->twig = $twig;
        $this->em = $em;
        $this->requestStack = $requestStack;
    }

    public function onControllerEvent(ControllerEvent $event): void
    {
        // Ne s'exécute que sur la requête principale
        if (!$event->isMainRequest()) {
            return;
        }

        $request = $this->requestStack->getCurrentRequest();
        if (!$request) {
            return;
        }

        // Vérifier si on est dans le backend (routes commençant par /admin, app_reservation, app_contact, etc.)
        $routeName = $request->attributes->get('_route');
        if (!$routeName || !$this->isBackendRoute($routeName)) {
            return;
        }

        // Récupérer les réservations récentes pour les notifications
        $reservationsRecentes = $this->getReservationsRecentes();

        // Injecter dans Twig comme variable globale
        $this->twig->addGlobal('reservationsRecentes', $reservationsRecentes);
    }

    private function isBackendRoute(string $routeName): bool
    {
        $backendPrefixes = [
            'admin_',
            'app_reservation_',
            'app_voitures_',
            'app_contact_',
            'app_transfere_',
            'back_',
        ];

        foreach ($backendPrefixes as $prefix) {
            if (str_starts_with($routeName, $prefix)) {
                return true;
            }
        }

        return false;
    }

    private function getReservationsRecentes(): array
    {
        $session = $this->requestStack->getCurrentRequest()?->getSession();
        $seenNotifications = $session ? $session->get('seen_notifications', []) : [];

        // Réservations voitures récentes
        $reservationsRecentesVoitures = $this->em->createQuery(
            'SELECT r.id, r.nom, r.prenom, r.prixTotal, r.createdAt
             FROM App\Entity\ReservationVoiture r
             ORDER BY r.createdAt DESC'
        )
        ->setMaxResults(20)
        ->getResult();

        // Réservations transferts récentes
        $reservationsRecentesTransferts = $this->em->createQuery(
            'SELECT r.id, r.firstName, r.lastName, r.prixTotal, r.createdAt
             FROM App\Entity\ReservationTransfert r
             ORDER BY r.createdAt DESC'
        )
        ->setMaxResults(20)
        ->getResult();

        // Réservations excursions récentes
        $reservationsRecentesExcursions = $this->em->createQuery(
            'SELECT r.id, r.nom, r.prenom, r.prixTotal, r.dateCreation
             FROM App\Entity\ReservationExcursion r
             ORDER BY r.dateCreation DESC'
        )
        ->setMaxResults(20)
        ->getResult();

        // Combiner et formater
        $reservationsRecentes = [];
        
        foreach ($reservationsRecentesVoitures as $res) {
            $reservationsRecentes[] = [
                'id' => $res['id'],
                'type' => 'voiture',
                'nom' => $res['nom'],
                'prenom' => $res['prenom'],
                'prix_total' => $res['prixTotal'],
                'created_at' => $res['createdAt']
            ];
        }
        
        foreach ($reservationsRecentesTransferts as $res) {
            $reservationsRecentes[] = [
                'id' => $res['id'],
                'type' => 'transfert',
                'nom' => $res['lastName'],
                'prenom' => $res['firstName'],
                'prix_total' => $res['prixTotal'],
                'created_at' => $res['createdAt']
            ];
        }

        foreach ($reservationsRecentesExcursions as $res) {
            $reservationsRecentes[] = [
                'id' => $res['id'],
                'type' => 'excursion',
                'nom' => $res['nom'],
                'prenom' => $res['prenom'],
                'prix_total' => $res['prixTotal'],
                'created_at' => $res['dateCreation']
            ];
        }

        // Exclure les notifications déjà vues
        $reservationsRecentes = array_filter($reservationsRecentes, function ($res) use ($seenNotifications) {
            $key = $res['type'] . '-' . $res['id'];
            return !in_array($key, $seenNotifications);
        });

        // Trier par date décroissante
        usort($reservationsRecentes, function($a, $b) {
            return $b['created_at'] <=> $a['created_at'];
        });

        return $reservationsRecentes;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onControllerEvent',
        ];
    }
}
