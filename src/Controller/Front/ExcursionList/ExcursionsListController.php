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

        $prix = $prix !== null && $prix !== '' ? (float) $prix : null;

        // 🔽 Récupère toutes les excursions avec filtres
        $excursions = $excursionRepository->findByFilters($localisation, $categorie, $prix);

        // 🔽 Définir l'image principale pour Twig via une propriété virtuelle
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

        return $this->render('Front/ExcursionsList/index.html.twig', [
            'excursions' => $excursions,
            'localisations' => $localisations,
            'categories' => $categories,
            'userFavorisIds' => $userFavorisIds, // <-- envoyer à Twig
        ]);
    }
}
