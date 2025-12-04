<?php

namespace App\Controller\Front\ExcursionDetails;

use App\Repository\ExcursionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ExcursionDetailsController extends AbstractController
{
    #[Route('/excursion/details/{id}', name: 'app_front_excursion_details')]
    public function index(int $id, ExcursionRepository $excursionRepository): Response
    {
        $excursion = $excursionRepository->find($id);

        if (!$excursion) {
            throw $this->createNotFoundException('Excursion non trouvée.');
        }

        // Image principale
        $imagePrincipale = $excursion->getImagePrincipale();
        $excursion->imagePrincipalePath = $imagePrincipale 
            ? '/uploads/images/' . $imagePrincipale
            : '/images/default-excursion.jpg';

        // Relations
        $images        = $excursion->getImages();
        $inclusList    = $excursion->getInclusList();
        $nonInclusList = $excursion->getNonInclusList();
        $itineraires   = $excursion->getItineraires();
        $avis          = $excursion->getAvis();


        // 🔹 Calculer la note moyenne
        $noteMoyenne = 0;

        if (count($avis) > 0) {
            $total = 0;
            foreach ($avis as $a) {
                $total += $a->getNote();
            }
            $noteMoyenne = $total / count($avis);
        }

        return $this->render('Front/ExcursionDetails/index.html.twig', [
            'excursion'     => $excursion,
            'images'        => $images,
            'inclusList'    => $inclusList,
            'nonInclusList' => $nonInclusList,
            'itineraires'   => $itineraires,
            'avis'          => $avis,
            'noteMoyenne'   => $noteMoyenne,
        ]);
    }
}
