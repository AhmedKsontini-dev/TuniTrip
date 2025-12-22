<?php

namespace App\Controller\Front\ExcursionList;

use App\Repository\ExcursionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ExcursionsListController extends AbstractController
{
    #[Route('/excursions/list', name: 'app_front_excursions_list')]
    public function index(Request $request, ExcursionRepository $excursionRepository): Response
    {
        $localisation = $request->query->get('localisation');
        $categorie = $request->query->get('categorie');
        $prix = $request->query->get('prix');
        $duree = $request->query->get('duree');
        $rating = $request->query->get('rating');
        $langue = $request->query->get('langue');
        $nbrPersonnes = $request->query->get('nbr_personnes');

        $prix = $prix !== null && $prix !== '' ? (float) $prix : null;
        $rating = $rating !== null && $rating !== '' ? (int) $rating : null;
        $nbrPersonnes = $nbrPersonnes !== null && $nbrPersonnes !== '' ? (int) $nbrPersonnes : null;

        $page = max(1, (int) $request->query->get('page', 1));
        $limit = 2;
        $offset = ($page - 1) * $limit;

        // 🔽 Récupère les excursions paginées avec filtres
        $excursions = $excursionRepository->findByFilters(
            $localisation,
            $categorie,
            $prix,
            $duree,
            $rating,
            $langue,
            $nbrPersonnes,
            $limit,
            $offset
        );

        // 🔽 Définir l'image principale pour Twig via une propriété virtuelle (optionnelle)
        foreach ($excursions as $excursion) {
            $imagePrincipale = $excursion->getImagePrincipale();
            $excursion->imagePrincipalePath = $imagePrincipale 
                ? '/uploads/images/' . $imagePrincipale
                : '/images/default-excursion.jpg';
        }

        $localisations = $excursionRepository->findDistinctLocalisations();
        $categories = $excursionRepository->findDistinctCategories();

        // 🔽 Récupérer les ids d'excursions favorites pour l'utilisateur connecté
        $userFavorisIds = [];
        $user = $this->getUser();
        if ($user) {
            $userFavorisIds = $user->getFavoris()->map(fn($f) => $f->getExcursion()->getId())->toArray();
        }

        // 🔽 Calculer le nombre total d'excursions pour pagination
        $totalExcursions = count($excursionRepository->findByFilters(
            $localisation,
            $categorie,
            $prix,
            $duree,
            $rating,
            $langue,
            $nbrPersonnes
        ));

        $totalPages = (int) ceil($totalExcursions / $limit);

        return $this->render('Front/ExcursionsList/index.html.twig', [
            'excursions' => $excursions,
            'localisations' => $localisations,
            'categories' => $categories,
            'userFavorisIds' => $userFavorisIds,
            'currentPage' => $page,
            'totalPages' => $totalPages,
        ]);
    }
}
