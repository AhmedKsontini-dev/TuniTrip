<?php

namespace App\Controller\Back\Dashboard;

use App\Entity\ReservationVoiture;
use App\Entity\ReservationTransfert;
use App\Entity\AvisExcursion;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

#[Route('/admin')]
class DashboardController extends AbstractController
{
    #[Route('/statistics', name: 'admin_statistics')]
    public function statistics(EntityManagerInterface $em): Response
    {
        // Période actuelle (ce mois)
        $startDate = new \DateTime('first day of this month');
        $endDate = new \DateTime('last day of this month');
        
        // Période précédente (mois dernier)
        $prevStartDate = new \DateTime('first day of last month');
        $prevEndDate = new \DateTime('last day of last month');

        // 1. Statistiques de base
        $stats = $this->getBasicStats($em, $startDate, $endDate, $prevStartDate, $prevEndDate);
        
        // 2. Répartition des revenus
        $revenueDistribution = $this->getRevenueDistribution($em, $startDate, $endDate);
        
        // 3. Dernières réservations
        $recentBookings = $this->getRecentBookings($em, 5);

        return $this->render('Back/dashboard/statistics.html.twig', [
            'total_revenue' => $stats['current']['total_revenue'],
            'revenue_evolution' => $stats['revenue_evolution'],
            'total_bookings' => $stats['current']['total_bookings'],
            'booking_evolution' => $stats['booking_evolution'],
            'conversion_rate' => $stats['current']['conversion_rate'],
            'active_customers' => $stats['current']['active_customers'],
            'revenue_distribution' => $revenueDistribution,
            'recent_bookings' => $recentBookings
        ]);
    }
    
    private function getBasicStats(EntityManagerInterface $em, \DateTimeInterface $startDate, \DateTimeInterface $endDate, 
                                 \DateTimeInterface $prevStartDate, \DateTimeInterface $prevEndDate): array
    {
        // Requêtes pour la période actuelle
        $currentStats = [
            'total_revenue' => $this->getTotalRevenue($em, $startDate, $endDate),
            'total_bookings' => $this->getTotalBookings($em, $startDate, $endDate),
            'active_customers' => $this->getActiveCustomers($em, $startDate, $endDate),
            'conversion_rate' => $this->getConversionRate($em, $startDate, $endDate),
        ];
        
        // Requêtes pour la période précédente
        $previousStats = [
            'total_revenue' => $this->getTotalRevenue($em, $prevStartDate, $prevEndDate),
            'total_bookings' => $this->getTotalBookings($em, $prevStartDate, $prevEndDate),
        ];
        
        // Calcul des évolutions
        $revenueEvolution = $previousStats['total_revenue'] > 0 
            ? (($currentStats['total_revenue'] - $previousStats['total_revenue']) / $previousStats['total_revenue']) * 100 
            : 0;
            
        $bookingEvolution = $previousStats['total_bookings'] > 0
            ? (($currentStats['total_bookings'] - $previousStats['total_bookings']) / $previousStats['total_bookings']) * 100
            : 0;
        
        return [
            'current' => $currentStats,
            'previous' => $previousStats,
            'revenue_evolution' => $revenueEvolution,
            'booking_evolution' => $bookingEvolution
        ];
    }
    
    private function getTotalRevenue(EntityManagerInterface $em, \DateTimeInterface $startDate, \DateTimeInterface $endDate): float
    {
        // Revenus location voitures
        $carRevenue = $em->createQueryBuilder()
            ->select('COALESCE(SUM(r.prixTotal), 0)')
            ->from('App\Entity\ReservationVoiture', 'r')
            ->where('r.createdAt BETWEEN :start AND :end')
            ->andWhere('r.statut != :cancelled')
            ->setParameter('start', $startDate)
            ->setParameter('end', $endDate)
            ->setParameter('cancelled', 'annule')
            ->getQuery()
            ->getSingleScalarResult();
        
        // Revenus transferts
        $transferRevenue = $em->createQueryBuilder()
            ->select('COALESCE(SUM(r.prixTotal), 0)')
            ->from('App\Entity\ReservationTransfert', 'r')
            ->where('r.createdAt BETWEEN :start AND :end')
            ->andWhere('r.statut != :cancelled')
            ->setParameter('start', $startDate)
            ->setParameter('end', $endDate)
            ->setParameter('cancelled', 'annule')
            ->getQuery()
            ->getSingleScalarResult();
        
        // Revenus excursions (approximation basée sur les avis)
        $excursionRevenue = $em->createQueryBuilder()
            ->select('COALESCE(SUM(e.prixParPersonne), 0)')
            ->from('App\Entity\Excursion', 'e')
            ->innerJoin('App\Entity\AvisExcursion', 'ae', 'WITH', 'ae.excursion = e')
            ->where('ae.createdAt BETWEEN :start AND :end')
            ->setParameter('start', $startDate)
            ->setParameter('end', $endDate)
            ->getQuery()
            ->getSingleScalarResult() ?: 0;
        
        return $carRevenue + $transferRevenue + $excursionRevenue;
    }
    
    private function getTotalBookings(EntityManagerInterface $em, \DateTimeInterface $startDate, \DateTimeInterface $endDate): int
    {
        // Comptage des réservations de voitures
        $carBookings = $em->createQueryBuilder()
            ->select('COUNT(r.id)')
            ->from('App\Entity\ReservationVoiture', 'r')
            ->where('r.createdAt BETWEEN :start AND :end')
            ->andWhere('r.statut != :cancelled')
            ->setParameter('start', $startDate)
            ->setParameter('end', $endDate)
            ->setParameter('cancelled', 'annule')
            ->getQuery()
            ->getSingleScalarResult();
        
        // Comptage des réservations de transferts
        $transferBookings = $em->createQueryBuilder()
            ->select('COUNT(r.id)')
            ->from('App\Entity\ReservationTransfert', 'r')
            ->where('r.createdAt BETWEEN :start AND :end')
            ->andWhere('r.statut != :cancelled')
            ->setParameter('start', $startDate)
            ->setParameter('end', $endDate)
            ->setParameter('cancelled', 'annule')
            ->getQuery()
            ->getSingleScalarResult();
        
        // Comptage des réservations d'excursions (approximation basée sur les avis)
        $excursionBookings = $em->createQueryBuilder()
            ->select('COUNT(DISTINCT e.id)')
            ->from('App\Entity\Excursion', 'e')
            ->innerJoin('App\Entity\AvisExcursion', 'ae', 'WITH', 'ae.excursion = e')
            ->where('ae.createdAt BETWEEN :start AND :end')
            ->setParameter('start', $startDate)
            ->setParameter('end', $endDate)
            ->getQuery()
            ->getSingleScalarResult();
        
        return $carBookings + $transferBookings + $excursionBookings;
    }
    
    private function getActiveCustomers(EntityManagerInterface $em, \DateTimeInterface $startDate, \DateTimeInterface $endDate): int
    {
        // Comptage des clients uniques ayant effectué au moins une réservation
        $carCustomers = $em->createQueryBuilder()
            ->select('COUNT(DISTINCT r.email)')
            ->from('App\Entity\ReservationVoiture', 'r')
            ->where('r.createdAt BETWEEN :start AND :end')
            ->andWhere('r.statut != :cancelled')
            ->setParameter('start', $startDate)
            ->setParameter('end', $endDate)
            ->setParameter('cancelled', 'annule')
            ->getQuery()
            ->getSingleScalarResult();
        
        $transferCustomers = $em->createQueryBuilder()
            ->select('COUNT(DISTINCT r.email)')
            ->from('App\Entity\ReservationTransfert', 'r')
            ->where('r.createdAt BETWEEN :start AND :end')
            ->andWhere('r.statut != :cancelled')
            ->setParameter('start', $startDate)
            ->setParameter('end', $endDate)
            ->setParameter('cancelled', 'annule')
            ->getQuery()
            ->getSingleScalarResult();
        
        $excursionCustomers = $em->createQueryBuilder()
            ->select('COUNT(DISTINCT u.email)')
            ->from('App\Entity\AvisExcursion', 'ae')
            ->join('ae.user', 'u')
            ->where('ae.createdAt BETWEEN :start AND :end')
            ->andWhere('u IS NOT NULL')
            ->setParameter('start', $startDate)
            ->setParameter('end', $endDate)
            ->getQuery()
            ->getSingleScalarResult();
        
        return $carCustomers + $transferCustomers + $excursionCustomers;
    }
    
    private function getConversionRate(EntityManagerInterface $em, \DateTimeInterface $startDate, \DateTimeInterface $endDate): float
    {
        // Récupération du nombre total de visiteurs (approximation)
        // Note: Vous devrez implémenter un système de suivi des visiteurs pour une mesure précise
        $totalVisitors = $this->getTotalVisitors($em, $startDate, $endDate);
        
        if ($totalVisitors === 0) {
            return 0.0;
        }
        
        $totalBookings = $this->getTotalBookings($em, $startDate, $endDate);
        
        return ($totalBookings / $totalVisitors) * 100;
    }
    
    private function getTotalVisitors(EntityManagerInterface $em, \DateTimeInterface $startDate, \DateTimeInterface $endDate): int
    {
        // Cette méthode est un exemple et devrait être remplacée par votre propre logique de suivi des visiteurs
        // Par exemple, en utilisant Google Analytics ou un système de suivi personnalisé
        
        // Pour l'instant, nous retournons un nombre arbitraire basé sur les réservations
        // (ce n'est pas précis mais sert d'exemple)
        $bookings = $this->getTotalBookings($em, $startDate, $endDate);
        return max($bookings * 10, 100); // Au moins 100 visiteurs ou 10x le nombre de réservations
    }
    
    private function getRevenueDistribution(EntityManagerInterface $em, \DateTimeInterface $startDate, \DateTimeInterface $endDate): array
    {
        // Revenus par catégorie
        $carRevenue = $em->createQueryBuilder()
            ->select('COALESCE(SUM(r.prixTotal), 0)')
            ->from('App\Entity\ReservationVoiture', 'r')
            ->where('r.createdAt BETWEEN :start AND :end')
            ->andWhere('r.statut != :cancelled')
            ->setParameter('start', $startDate)
            ->setParameter('end', $endDate)
            ->setParameter('cancelled', 'annule')
            ->getQuery()
            ->getSingleScalarResult();
        
        $transferRevenue = $em->createQueryBuilder()
            ->select('COALESCE(SUM(r.prixTotal), 0)')
            ->from('App\Entity\ReservationTransfert', 'r')
            ->where('r.createdAt BETWEEN :start AND :end')
            ->andWhere('r.statut != :cancelled')
            ->setParameter('start', $startDate)
            ->setParameter('end', $endDate)
            ->setParameter('cancelled', 'annule')
            ->getQuery()
            ->getSingleScalarResult();
        
        $excursionRevenue = $em->createQueryBuilder()
            ->select('COALESCE(SUM(e.prixParPersonne), 0)')
            ->from('App\Entity\Excursion', 'e')
            ->innerJoin('App\Entity\AvisExcursion', 'ae', 'WITH', 'ae.excursion = e')
            ->where('ae.createdAt BETWEEN :start AND :end')
            ->setParameter('start', $startDate)
            ->setParameter('end', $endDate)
            ->getQuery()
            ->getSingleScalarResult() ?: 0;
        
        $totalRevenue = $carRevenue + $transferRevenue + $excursionRevenue;
        
        // Calcul des pourcentages
        $carPercentage = $totalRevenue > 0 ? ($carRevenue / $totalRevenue) * 100 : 0;
        $transferPercentage = $totalRevenue > 0 ? ($transferRevenue / $totalRevenue) * 100 : 0;
        $excursionPercentage = $totalRevenue > 0 ? ($excursionRevenue / $totalRevenue) * 100 : 0;
        
        return [
            'cars' => [
                'amount' => $carRevenue,
                'percentage' => $carPercentage
            ],
            'transfers' => [
                'amount' => $transferRevenue,
                'percentage' => $transferPercentage
            ],
            'excursions' => [
                'amount' => $excursionRevenue,
                'percentage' => $excursionPercentage
            ]
        ];
    }
    
    private function getRecentBookings(EntityManagerInterface $em, int $limit = 5): array
    {
        // Récupération des réservations de voitures récentes
        $carBookings = $em->createQueryBuilder()
            ->select([
                'r.id',
                'CONCAT(r.nom, \' \', r.prenom) as client',
                'r.email as email',
                'r.createdAt as date',
                'r.prixTotal as amount',
                'r.statut as status',
                '\'Voiture\' as service'
            ])
            ->from('App\Entity\ReservationVoiture', 'r')
            ->where('r.statut != :cancelled')
            ->orderBy('r.createdAt', 'DESC')
            ->setMaxResults($limit)
            ->setParameter('cancelled', 'annule')
            ->getQuery()
            ->getArrayResult();
        
        // Récupération des réservations de transferts récentes
        $transferBookings = $em->createQueryBuilder()
            ->select([
                'r.id',
                'CONCAT(r.firstName, \' \', r.lastName) as client',
                'r.email as email',
                'r.createdAt as date',
                'r.prixTotal as amount',
                'r.statut as status',
                '\'Transfert\' as service'
            ])
            ->from('App\Entity\ReservationTransfert', 'r')
            ->where('r.statut != :cancelled')
            ->orderBy('r.createdAt', 'DESC')
            ->setMaxResults($limit)
            ->setParameter('cancelled', 'annule')
            ->getQuery()
            ->getArrayResult();
        
        // Récupération des réservations d'excursions récentes (basées sur les avis)
        $excursionBookings = $em->createQueryBuilder()
            ->select([
                'e.id as id',
                'CONCAT(u.prenom, \' \', u.nom) as client',
                'u.email as email',
                'ae.createdAt as date',
                'e.prixParPersonne as amount',
                '\'Confirmée\' as status',
                '\'Excursion\' as service'
            ])
            ->from('App\Entity\AvisExcursion', 'ae')
            ->innerJoin('ae.excursion', 'e')
            ->innerJoin('ae.user', 'u')
            ->orderBy('ae.createdAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getArrayResult();
        
        // Fusion et tri des résultats
        $allBookings = array_merge($carBookings, $transferBookings, $excursionBookings);
        
        // Fonction de comparaison pour le tri par date
        usort($allBookings, function($a, $b) {
            return $b['date'] <=> $a['date']; // Tri décroissant par date
        });
        
        // Limiter le nombre de résultats et formater les données
        return array_slice(array_map(function($booking) {
            return [
                'id' => $booking['id'],
                'client' => $booking['client'],
                'email' => $booking['email'] ?? null,
                'date' => $booking['date'],
                'amount' => $booking['amount'],
                'status' => $booking['status'],
                'service' => $booking['service']
            ];
        }, $allBookings), 0, $limit);
    }
    
    #[Route('/api/statistics', name: 'api_statistics')]
    public function getStatistics(Request $request, EntityManagerInterface $em): JsonResponse
    {
        // Récupération des paramètres de requête
        $period = $request->query->get('period', 'month');
        $startDate = $request->query->get('start');
        $endDate = $request->query->get('end');
        
        // Définition de la période en fonction des paramètres
        if ($startDate && $endDate) {
            // Période personnalisée
            $start = new \DateTime($startDate);
            $end = new \DateTime($endDate);
        } else {
            // Période prédéfinie
            switch ($period) {
                case 'day':
                    $start = new \DateTime('today');
                    $end = new \DateTime('tomorrow - 1 second');
                    break;
                case 'week':
                    $start = new \DateTime('monday this week');
                    $end = new \DateTime('sunday this week 23:59:59');
                    break;
                case 'year':
                    $start = new \DateTime('first day of january this year');
                    $end = new \DateTime('last day of december this year 23:59:59');
                    break;
                case 'month':
                default:
                    $start = new \DateTime('first day of this month');
                    $end = new \DateTime('last day of this month 23:59:59');
                    break;
            }
        }
        
        // Récupération des données statistiques
        $stats = $this->getBasicStats($em, $start, $end, 
            (clone $start)->modify('-1 month'), 
            (clone $end)->modify('-1 month')
        );
        
        $revenueDistribution = $this->getRevenueDistribution($em, $start, $end);
        $recentBookings = $this->getRecentBookings($em, 5);
        
        // Données pour les graphiques
        $chartData = $this->getChartData($em, $period, $start, $end);
        
        return $this->json([
            'success' => true,
            'period' => [
                'start' => $start->format('Y-m-d H:i:s'),
                'end' => $end->format('Y-m-d H:i:s'),
                'label' => $this->getPeriodLabel($period, $start, $end)
            ],
            'stats' => [
                'total_revenue' => $stats['current']['total_revenue'],
                'revenue_evolution' => $stats['revenue_evolution'],
                'total_bookings' => $stats['current']['total_bookings'],
                'booking_evolution' => $stats['booking_evolution'],
                'conversion_rate' => $stats['current']['conversion_rate'],
                'active_customers' => $stats['current']['active_customers']
            ],
            'revenue_distribution' => $revenueDistribution,
            'recent_bookings' => $recentBookings,
            'charts' => $chartData
        ]);
    }
    
    private function getChartData(EntityManagerInterface $em, string $period, \DateTimeInterface $start, \DateTimeInterface $end): array
    {
        // Cette méthode génère les données pour les graphiques en fonction de la période
        // Pour simplifier, nous allons générer des données factices
        // Dans une application réelle, vous devriez interroger votre base de données
        
        $labels = [];
        $carData = [];
        $transferData = [];
        $excursionData = [];
        
        $interval = new \DateInterval('P1D'); // Par défaut, intervalle quotidien
        $dateFormat = 'd M';
        
        // Ajustement de l'intervalle en fonction de la période
        switch ($period) {
            case 'year':
                $interval = new \DateInterval('P1M'); // Mensuel pour une année
                $dateFormat = 'M Y';
                break;
            case 'month':
                $interval = new \DateInterval('P1W'); // Hebdomadaire pour un mois
                $dateFormat = 'd M';
                break;
            case 'week':
            case 'day':
            default:
                $interval = new \DateInterval('P1D'); // Quotidien pour une semaine ou un jour
                $dateFormat = 'd M';
                break;
        }
        
        // Génération des étiquettes et des données factices
        $periods = new \DatePeriod($start, $interval, $end);
        $i = 0;
        
        foreach ($periods as $date) {
            $labels[] = $date->format($dateFormat);
            
            // Données factices (à remplacer par des requêtes réelles)
            $carData[] = rand(500, 3000);
            $transferData[] = rand(300, 2500);
            $excursionData[] = rand(200, 1500);
            
            $i++;
            if ($i >= 12) break; // Limiter à 12 points de données maximum
        }
        
        return [
            'revenue' => [
                'labels' => $labels,
                'datasets' => [
                    [
                        'label' => 'Locations',
                        'data' => $carData,
                        'borderColor' => '#667eea',
                        'backgroundColor' => 'rgba(102, 126, 234, 0.1)',
                        'tension' => 0.4,
                        'fill' => true
                    ],
                    [
                        'label' => 'Transferts',
                        'data' => $transferData,
                        'borderColor' => '#19c37d',
                        'backgroundColor' => 'rgba(25, 195, 125, 0.1)',
                        'tension' => 0.4,
                        'fill' => true
                    ],
                    [
                        'label' => 'Excursions',
                        'data' => $excursionData,
                        'borderColor' => '#f7b731',
                        'backgroundColor' => 'rgba(247, 183, 49, 0.1)',
                        'tension' => 0.4,
                        'fill' => true
                    ]
                ]
            ],
            'distribution' => [
                'labels' => ['Locations', 'Transferts', 'Excursions'],
                'datasets' => [
                    [
                        'data' => [
                            array_sum($carData),
                            array_sum($transferData),
                            array_sum($excursionData)
                        ],
                        'backgroundColor' => [
                            'rgba(102, 126, 234, 0.8)',
                            'rgba(25, 195, 125, 0.8)',
                            'rgba(247, 183, 49, 0.8)'
                        ],
                        'borderColor' => [
                            'rgba(102, 126, 234, 1)',
                            'rgba(25, 195, 125, 1)',
                            'rgba(247, 183, 49, 1)'
                        ],
                        'borderWidth' => 1
                    ]
                ]
            ]
        ];
    }
    
    private function getPeriodLabel(string $period, \DateTimeInterface $start, \DateTimeInterface $end): string
    {
        switch ($period) {
            case 'day':
                return $start->format('d F Y');
            case 'week':
                return 'Semaine du ' . $start->format('d/m/Y') . ' au ' . $end->format('d/m/Y');
            case 'month':
                return $start->format('F Y');
            case 'year':
                return $start->format('Y');
            default:
                if ($start && $end) {
                    return 'Du ' . $start->format('d/m/Y') . ' au ' . $end->format('d/m/Y');
                }
                return 'Période personnalisée';
        }
    }
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
            'SELECT v.id, v.marque, v.modele, v.disponible, COUNT(r.id) as nbReservations
             FROM App\Entity\Voitures v
             LEFT JOIN App\Entity\ReservationVoiture r WITH r.voiture = v
             GROUP BY v.id, v.marque, v.modele, v.disponible
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
        ->setMaxResults(20)
        ->getResult();

        $reservationsRecentesTransferts = $em->createQuery(
            'SELECT r.id, r.firstName, r.lastName, r.prixTotal, r.createdAt
             FROM App\Entity\ReservationTransfert r
             ORDER BY r.createdAt DESC'
        )
        ->setMaxResults(20)
        ->getResult();

        $reservationsRecentesExcursions = $em->createQuery(
            'SELECT r.id, r.nom, r.prenom, r.prixTotal, r.dateCreation
             FROM App\Entity\ReservationExcursion r
             ORDER BY r.dateCreation DESC'
        )
        ->setMaxResults(20)
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
        //$reservationsRecentes = array_slice($reservationsRecentes, 0, 5);

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
        if (!in_array($key, $seenNotifications)) {
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

    /**
     * Endpoint AJAX pour marquer une notification de réservation comme vue
     */
    #[Route('/dashboard/notification/mark-seen', name: 'admin_notification_mark_seen', methods: ['POST'])]
    public function markNotificationSeen(SessionInterface $session): Response
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        $type = $request->request->get('type');
        $id = $request->request->get('id');

        if ($type && $id) {
            $seenNotifications = $session->get('seen_notifications', []);
            $key = $type . '-' . $id;
            if (!in_array($key, $seenNotifications)) {
                $seenNotifications[] = $key;
                $session->set('seen_notifications', $seenNotifications);
            }
        }

        return $this->json(['success' => true]);
    }

    /**
     * Endpoint AJAX pour marquer un message comme lu
     */
    #[Route('/dashboard/message/mark-read', name: 'admin_message_mark_read', methods: ['POST'])]
    public function markMessageRead(EntityManagerInterface $em): Response
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        $id = $request->request->get('id');

        if ($id) {
            $message = $em->getRepository(\App\Entity\ContactMessage::class)->find($id);
            if ($message) {
                $message->setLus(true);
                $em->flush();
            }
        }

        return $this->json(['success' => true]);
    }

    /**
     * Endpoint API pour le polling des notifications en temps réel
     * Retourne les compteurs et les dernières notifications
     */
    #[Route('/dashboard/notifications/poll', name: 'admin_notifications_poll', methods: ['GET'])]
    public function pollNotifications(EntityManagerInterface $em, SessionInterface $session): Response
    {
        // Récupérer les notifications vues
        $seenNotifications = $session->get('seen_notifications', []);

        // Récupérer les réservations récentes (non vues)
        $reservationsRecentes = $this->getReservationsRecentesForPoll($em, $seenNotifications);

        // Récupérer les messages non lus
        $unreadMessages = $em->createQuery(
            'SELECT m.id, m.email, m.sujet, m.dateEnvoi
             FROM App\Entity\ContactMessage m
             WHERE m.lus = false
             ORDER BY m.dateEnvoi DESC'
        )
        ->setMaxResults(5)
        ->getResult();

        $unreadCount = $em->createQuery(
            'SELECT COUNT(m.id) FROM App\Entity\ContactMessage m WHERE m.lus = false'
        )->getSingleScalarResult();

        // Formater les messages
        $messagesFormatted = [];
        foreach ($unreadMessages as $msg) {
            $messagesFormatted[] = [
                'id' => $msg['id'],
                'email' => $msg['email'],
                'sujet' => $msg['sujet'],
                'dateEnvoi' => $msg['dateEnvoi']->format('Y-m-d H:i')
            ];
        }

        return $this->json([
            'reservationsCount' => count($reservationsRecentes),
            'reservations' => $reservationsRecentes,
            'messagesCount' => (int)$unreadCount,
            'messages' => $messagesFormatted,
            'timestamp' => (new \DateTime())->format('Y-m-d H:i:s')
        ]);
    }

    /**
     * Helper pour récupérer les réservations récentes pour le polling
     */
    private function getReservationsRecentesForPoll(EntityManagerInterface $em, array $seenNotifications): array
    {
        // Réservations voitures récentes
        $reservationsVoitures = $em->createQuery(
            'SELECT r.id, r.nom, r.prenom, r.prixTotal, r.createdAt
             FROM App\Entity\ReservationVoiture r
             ORDER BY r.createdAt DESC'
        )
        ->setMaxResults(20)
        ->getResult();

        // Réservations transferts récentes
        $reservationsTransferts = $em->createQuery(
            'SELECT r.id, r.firstName, r.lastName, r.prixTotal, r.createdAt
             FROM App\Entity\ReservationTransfert r
             ORDER BY r.createdAt DESC'
        )
        ->setMaxResults(20)
        ->getResult();

        // Réservations excursions récentes
        $reservationsExcursions = $em->createQuery(
            'SELECT r.id, r.nom, r.prenom, r.prixTotal, r.dateCreation
             FROM App\Entity\ReservationExcursion r
             ORDER BY r.dateCreation DESC'
        )
        ->setMaxResults(20)
        ->getResult();

        // Combiner et formater
        $reservationsRecentes = [];
        
        foreach ($reservationsVoitures as $res) {
            $reservationsRecentes[] = [
                'id' => $res['id'],
                'type' => 'voiture',
                'nom' => $res['nom'],
                'prenom' => $res['prenom'],
                'prix_total' => $res['prixTotal'],
                'created_at' => $res['createdAt']->format('d/m/Y H:i')
            ];
        }
        
        foreach ($reservationsTransferts as $res) {
            $reservationsRecentes[] = [
                'id' => $res['id'],
                'type' => 'transfert',
                'nom' => $res['lastName'],
                'prenom' => $res['firstName'],
                'prix_total' => $res['prixTotal'],
                'created_at' => $res['createdAt']->format('d/m/Y H:i')
            ];
        }

        foreach ($reservationsExcursions as $res) {
            $reservationsRecentes[] = [
                'id' => $res['id'],
                'type' => 'excursion',
                'nom' => $res['nom'],
                'prenom' => $res['prenom'],
                'prix_total' => $res['prixTotal'],
                'created_at' => $res['dateCreation']->format('d/m/Y H:i')
            ];
        }

        // Exclure les notifications déjà vues
        $reservationsRecentes = array_filter($reservationsRecentes, function ($res) use ($seenNotifications) {
            $key = $res['type'] . '-' . $res['id'];
            return !in_array($key, $seenNotifications);
        });

        // Trier par date décroissante et limiter
        usort($reservationsRecentes, function($a, $b) {
            return strcmp($b['created_at'], $a['created_at']);
        });

        return array_values($reservationsRecentes);
    }
}

