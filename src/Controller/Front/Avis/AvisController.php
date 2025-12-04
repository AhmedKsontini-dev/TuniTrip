<?php

namespace App\Controller\Front\Avis;

use App\Entity\Avis;
use App\Form\AvisType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class AvisController extends AbstractController
{
    #[Route('/avis', name: 'app_avis')]
    public function index(EntityManagerInterface $em): Response
    {
        $avisRepository = $em->getRepository(Avis::class);
        $avis = $avisRepository->findBy([], ['dateCreation' => 'DESC']); // derniers avis en premier

        return $this->render('Front/Home/index.html.twig', [
            'avis' => $avis
        ]);
    }

    #[Route('/ajouter-avis', name: 'ajouter_avis', methods: ['POST'])]
    public function ajouter(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $avis = new Avis();

        $avis->setNom($request->request->get('nom'));
        $avis->setPrenom($request->request->get('prenom'));
        $avis->setCommentaire($request->request->get('commentaire'));
        $avis->setEtoiles((int) $request->request->get('etoiles'));

        $em->persist($avis);
        $em->flush();

        return new JsonResponse([
            'success' => true,
            'message' => 'Merci pour votre avis !',
            'avis' => [
                'nom' => $avis->getNom(),
                'prenom' => $avis->getPrenom(),
                'commentaire' => $avis->getCommentaire(),
                'etoiles' => $avis->getEtoiles(),
                'dateCreation' => $avis->getDateCreation()->format('F d, Y')
            ]
        ]);
    }

}
