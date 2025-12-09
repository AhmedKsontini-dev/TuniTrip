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

        // 🔽 Récupère toutes les excursions avec filtres
        $excursions = $excursionRepository->findByFilters(
            $localisation,
            $categorie,
            $prix,
            $duree,
            $rating,
            $langue,
            $nbrPersonnes
        );

        // 🔽 Définir l'image principale pour Twig via une propriété virtuelle (optionnelle)
        // Ici on n'utilise pas setMainImagePath(), mais Twig fera l'affichage
        foreach ($excursions as $excursion) {
            // Si tu veux une propriété temporaire, tu peux la définir ainsi :
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

        return $this->render('Front/ExcursionsList/index.html.twig', [
            'excursions' => $excursions,
            'localisations' => $localisations,
            'categories' => $categories,
            'userFavorisIds' => $userFavorisIds, // <-- envoyer à Twig
        ]);
    }
}
