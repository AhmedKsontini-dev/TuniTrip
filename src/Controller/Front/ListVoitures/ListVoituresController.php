<?php

namespace App\Controller\Front\ListVoitures;

use App\Repository\VoituresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ListVoituresController extends AbstractController
{
    #[Route('/list/voitures', name: 'app_front_list_voitures')]
    public function index(Request $request, VoituresRepository $voituresRepository): Response
    {
        $passengers = $request->query->get('passengers');
        $suitcases = $request->query->get('suitcases');
        $boiteVitesse = $request->query->get('boiteVitesse');

        $voitures = $voituresRepository->findFiltered($passengers, $suitcases, $boiteVitesse);

        return $this->render('Front/List_voitures/index.html.twig', [
            'controller_name' => 'Front/ListVoitures/ListVoituresController',
            'voitures' => $voitures,
        ]);
    }

}
