<?php

namespace App\Controller\Back\Dashboard;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

#[Route('/admin')]
class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'admin_dashboard')]
    public function index(EntityManagerInterface $em, SessionInterface $session): Response
    {
        // Période actuelle (ce mois)
        $dateDebut = new \DateTime('first day of this month');
        $dateFin = new \DateTime('last day of this month');
        
        // Période précédente (mois dernier)
        $dateDebutPrecedent = new \DateTime('first day of last month');
        $dateFinPrecedent = new \DateTime('last day of last month');

        // ============================================
        // STATISTIQUES FINANCIÈRES
        // ============================================
        
        // Revenus location voitures (période actuelle)
        $revenusVoitures = $em->createQuery(
            'SELECT COALESCE(SUM(r.prixTotal), 0) 
             FROM App\Entity\ReservationVoiture r 
             WHERE r.createdAt BETWEEN :debut AND :fin'
        )
        ->setParameter('debut', $dateDebut)
        ->setParameter('fin', $dateFin)
        ->getSingleScalarResult();

        // Revenus transferts (période actuelle)
        $revenusTransferts = $em->createQuery(
            'SELECT COALESCE(SUM(r.prixTotal), 0) 
             FROM App\Entity\ReservationTransfert r 
             WHERE r.createdAt BETWEEN :debut AND :fin 
             AND r.statut != :statut'
        )
        ->setParameter('debut', $dateDebut)
        ->setParameter('fin', $dateFin)
        ->setParameter('statut', 'annule')
        ->getSingleScalarResult();

        // Revenus excursions (approximation basée sur les avis)
        $revenusExcursions = $em->createQuery(
            'SELECT COALESCE(SUM(e.prixParPersonne), 0)
             FROM App\Entity\Excursion e
             INNER JOIN App\Entity\AvisExcursion ae WITH ae.excursion = e
             WHERE ae.createdAt BETWEEN :debut AND :fin'
        )
        ->setParameter('debut', $dateDebut)
        ->setParameter('fin', $dateFin)
        ->getSingleScalarResult() ?: 0;

        $revenusTotal = $revenusVoitures + $revenusTransferts + $revenusExcursions;

        // Calcul revenus période précédente pour évolution
        $revenusPrecedents = $em->createQuery(
            'SELECT COALESCE(SUM(r.prixTotal), 0) 
             FROM App\Entity\ReservationVoiture r 
             WHERE r.createdAt BETWEEN :debut AND :fin'
        )
        ->setParameter('debut', $dateDebutPrecedent)
        ->setParameter('fin', $dateFinPrecedent)
        ->getSingleScalarResult();

        $evolutionRevenu = $revenusPrecedents > 0 
            ? (($revenusTotal - $revenusPrecedents) / $revenusPrecedents) * 100 
            : 0;

        // ============================================
        // STATISTIQUES RÉSERVATIONS
        // ============================================
        
        $reservationsVoitures = $em->createQuery(
            'SELECT COUNT(r.id) 
             FROM App\Entity\ReservationVoiture r 
             WHERE r.createdAt BETWEEN :debut AND :fin'
        )
        ->setParameter('debut', $dateDebut)
        ->setParameter('fin', $dateFin)
        ->getSingleScalarResult();

        $reservationsTransferts = $em->createQuery(
            'SELECT COUNT(r.id) 
             FROM App\Entity\ReservationTransfert r 
             WHERE r.createdAt BETWEEN :debut AND :fin 
             AND r.statut != :statut'
        )
        ->setParameter('debut', $dateDebut)
        ->setParameter('fin', $dateFin)
        ->setParameter('statut', 'annule')
        ->getSingleScalarResult();

        // Approximation pour excursions (basé sur les avis)
        $reservationsExcursions = $em->createQuery(
            'SELECT COUNT(a.id) 
             FROM App\Entity\AvisExcursion a 
             WHERE a.createdAt BETWEEN :debut AND :fin'
        )
        ->setParameter('debut', $dateDebut)
        ->setParameter('fin', $dateFin)
        ->getSingleScalarResult();

        $totalReservations = $reservationsVoitures + $reservationsTransferts + $reservationsExcursions;

        // Réservations période précédente
        $reservationsPrecedentes = $em->createQuery(
            'SELECT COUNT(r.id) 
             FROM App\Entity\ReservationVoiture r 
             WHERE r.createdAt BETWEEN :debut AND :fin'
        )
        ->setParameter('debut', $dateDebutPrecedent)
        ->setParameter('fin', $dateFinPrecedent)
        ->getSingleScalarResult();

        $evolutionReservations = $reservationsPrecedentes > 0 
            ? (($totalReservations - $reservationsPrecedentes) / $reservationsPrecedentes) * 100 
            : 0;

        // ============================================
        // STATISTIQUES VÉHICULES
        // ============================================
        
        $totalVoitures = $em->createQuery(
            'SELECT COUNT(v.id) FROM App\Entity\Voitures v'
        )->getSingleScalarResult();

        $voituresDisponibles = $em->createQuery(
            'SELECT COUNT(v.id) FROM App\Entity\Voitures v WHERE v.disponible = true'
        )->getSingleScalarResult();

        $tauxOccupation = $totalVoitures > 0 
            ? (($totalVoitures - $voituresDisponibles) / $totalVoitures) * 100 
            : 0;

        // ============================================
        // STATISTIQUES CLIENTS
        // ============================================
        
        // Nouveaux clients ce mois (téléphones uniques)
        $nouveauxClients = $em->createQuery(
            'SELECT COUNT(DISTINCT r.tel) 
             FROM App\Entity\ReservationVoiture r 
             WHERE r.createdAt BETWEEN :debut AND :fin'
        )
        ->setParameter('debut', $dateDebut)
        ->setParameter('fin', $dateFin)
        ->getSingleScalarResult();

        // Clients récurrents (qui ont réservé plus d'une fois)
        $clientsRecurrentsData = $em->createQuery(
            'SELECT r.tel, COUNT(r.id) as nb 
             FROM App\Entity\ReservationVoiture r 
             GROUP BY r.tel 
             HAVING COUNT(r.id) > 1'
        )->getResult();
        
        $clientsRecurrents = count($clientsRecurrentsData);

        // ============================================
        // AVIS ET NOTES
        // ============================================
        
        $avisVoitures = $em->createQuery(
            'SELECT a FROM App\Entity\Avis a'
        )->getResult();

        $avisExcursions = $em->createQuery(
            'SELECT a FROM App\Entity\AvisExcursion a'
        )->getResult();
        
        $totalAvis = count($avisVoitures) + count($avisExcursions);
        
        $sommeNotes = 0;
        foreach ($avisVoitures as $avis) {
            $sommeNotes += $avis->getEtoiles();
        }
        foreach ($avisExcursions as $avis) {
            $sommeNotes += $avis->getNote();
        }
        
        $noteMoyenne = $totalAvis > 0 ? $sommeNotes / $totalAvis : 0;

        // ============================================
        // TAUX DE CONVERSION & PANIER MOYEN
        // ============================================
        
        // Taux de conversion (approximation: 5% standard)
        $tauxConversion = 5.2;
        
        // Panier moyen
        $panierMoyen = $totalReservations > 0 
            ? $revenusTotal / $totalReservations 
            : 0;

        // ============================================
        // TOP VÉHICULES
        // ============================================
        
        $topVoituresData = $em->createQuery(
            'SELECT v.id, v.marque, v.modele, v.immatriculation, v.disponible, COUNT(r.id) as nbReservations
             FROM App\Entity\Voitures v
             LEFT JOIN App\Entity\ReservationVoiture r WITH r.voiture = v
             GROUP BY v.id, v.marque, v.modele, v.immatriculation, v.disponible
             ORDER BY nbReservations DESC'
        )
        ->setMaxResults(5)
        ->getResult();

        // Formatter les données
        $topVoitures = [];
        foreach ($topVoituresData as $voiture) {
            $topVoitures[] = [
                'marque' => $voiture['marque'],
                'modele' => $voiture['modele'],
                'immatriculation' => $voiture['immatriculation'],
                'disponible' => $voiture['disponible'],
                'nbReservations' => $voiture['nbReservations']
            ];
        }

        // ============================================
        // RÉSERVATIONS RÉCENTES
        // ============================================
        
        $reservationsRecentesVoitures = $em->createQuery(
            'SELECT r.id, r.nom, r.prenom, r.prixTotal, r.createdAt
             FROM App\Entity\ReservationVoiture r
             ORDER BY r.createdAt DESC'
        )
        ->setMaxResults(3)
        ->getResult();

        $reservationsRecentesTransferts = $em->createQuery(
            'SELECT r.id, r.firstName, r.lastName, r.prixTotal, r.createdAt
             FROM App\Entity\ReservationTransfert r
             ORDER BY r.createdAt DESC'
        )
        ->setMaxResults(2)
        ->getResult();

        $reservationsRecentesExcursions = $em->createQuery(
            'SELECT r.id, r.nom, r.prenom, r.prixTotal, r.dateCreation
             FROM App\Entity\ReservationExcursion r
             ORDER BY r.dateCreation DESC'
        )
        ->setMaxResults(2)
        ->getResult();

        // Combiner et formatter
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

        // Exclure les notifications déjà vues (stockées en session)
        $seenNotifications = $session->get('seen_notifications', []);
        $reservationsRecentes = array_filter($reservationsRecentes, function ($res) use ($seenNotifications) {
            $key = $res['type'] . '-' . $res['id'];
            return !in_array($key, $seenNotifications, true);
        });

        // Trier par date décroissante
        usort($reservationsRecentes, function($a, $b) {
            return $b['created_at'] <=> $a['created_at'];
        });
        $reservationsRecentes = array_slice($reservationsRecentes, 0, 5);

        // ============================================
        // EXCURSIONS POPULAIRES
        // ============================================
        
        $excursionsPopulairesData = $em->createQuery(
            'SELECT e.id, e.titre, e.prixParPersonne, AVG(ae.note) as note_moyenne, COUNT(ae.id) as nb_reservations
             FROM App\Entity\Excursion e
             LEFT JOIN App\Entity\AvisExcursion ae WITH ae.excursion = e
             GROUP BY e.id, e.titre, e.prixParPersonne
             ORDER BY nb_reservations DESC'
        )
        ->setMaxResults(5)
        ->getResult();

        // Formatter les données
        $excursionsPopulaires = [];
        foreach ($excursionsPopulairesData as $excursion) {
            $excursionsPopulaires[] = [
                'titre' => $excursion['titre'],
                'prix_par_personne' => $excursion['prixParPersonne'],
                'note_moyenne' => $excursion['note_moyenne'] ?: 0,
                'nb_reservations' => $excursion['nb_reservations']
            ];
        }

        // ============================================
        // MESSAGES CLIENTS
        // ============================================
        
        $messagesRecents = $em->createQuery(
            'SELECT m FROM App\Entity\ContactMessage m
             ORDER BY m.dateEnvoi DESC'
        )
        ->setMaxResults(5)
        ->getResult();

        $messagesNonLus = $em->createQuery(
            'SELECT COUNT(m.id) FROM App\Entity\ContactMessage m WHERE m.lus = false'
        )->getSingleScalarResult();

        // ============================================
        // RENDU DE LA VUE
        // ============================================
        
        return $this->render('Back/dashboard/dashboard.html.twig', [
            // Statistiques financières
            'revenusTotal' => $revenusTotal,
            'revenusVoitures' => $revenusVoitures,
            'revenusTransferts' => $revenusTransferts,
            'revenusExcursions' => $revenusExcursions,
            'evolutionRevenu' => $evolutionRevenu,
            
            // Statistiques réservations
            'totalReservations' => $totalReservations,
            'reservationsVoitures' => $reservationsVoitures,
            'reservationsTransferts' => $reservationsTransferts,
            'reservationsExcursions' => $reservationsExcursions,
            'evolutionReservations' => $evolutionReservations,
            
            // Statistiques véhicules
            'totalVoitures' => $totalVoitures,
            'voituresDisponibles' => $voituresDisponibles,
            'tauxOccupation' => $tauxOccupation,
            
            // Statistiques clients
            'nouveauxClients' => $nouveauxClients,
            'clientsRecurrents' => $clientsRecurrents,
            
            // Avis et qualité
            'noteMoyenne' => $noteMoyenne,
            'totalAvis' => $totalAvis,
            
            // Conversion et panier
            'tauxConversion' => $tauxConversion,
            'panierMoyen' => $panierMoyen,
            
            // Données détaillées
            'topVoitures' => $topVoitures,
            'reservationsRecentes' => $reservationsRecentes,
            'excursionsPopulaires' => $excursionsPopulaires,
            'messagesRecents' => $messagesRecents,
            'messagesNonLus' => $messagesNonLus,
        ]);
    }

    #[Route('/dashboard/notification/{type}/{id}', name: 'admin_notification_open', requirements: ['id' => '\\d+'])]
    public function openNotification(string $type, int $id, SessionInterface $session): Response
    {
        // Marquer la notification comme vue dans la session
        $seenNotifications = $session->get('seen_notifications', []);
        $key = $type . '-' . $id;
        if (!in_array($key, $seenNotifications, true)) {
            $seenNotifications[] = $key;
            $session->set('seen_notifications', $seenNotifications);
        }

        // Rediriger vers la page de détail correspondante
        if ($type === 'voiture') {
            return $this->redirectToRoute('app_reservation_voiture_show', ['id' => $id]);
        }

        if ($type === 'transfert') {
            return $this->redirectToRoute('admin_reservation_transfert_show', ['id' => $id]);
        }

        if ($type === 'excursion') {
            return $this->redirectToRoute('app_reservation_excursion_show', ['id' => $id]);
        }

        // Par défaut, retour au dashboard
        return $this->redirectToRoute('admin_dashboard');
    }
}