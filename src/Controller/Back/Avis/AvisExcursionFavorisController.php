<?php

namespace App\Controller\Back\Avis;

use App\Entity\AvisExcursion;
use App\Repository\AvisExcursionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/avis-excursion')]
class AvisExcursionFavorisController extends AbstractController
{
    #[Route('/', name: 'app_back_favoris_avis_excursion_index', methods: ['GET'])]
    public function index(AvisExcursionRepository $avisExcursionRepository): Response
    {
        return $this->render('Back/avis/avis_excursion/index.html.twig', [
            'avis_excursions' => $avisExcursionRepository->findBy([], ['createdAt' => 'DESC']),
        ]);
    }

    #[Route('/{id}', name: 'app_back_favoris_avis_excursion_delete', methods: ['POST'])]
    public function delete(Request $request, AvisExcursion $avisExcursion, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$avisExcursion->getId(), $request->request->get('_token'))) {
            $entityManager->remove($avisExcursion);
            $entityManager->flush();
            $this->addFlash('success', 'L\'avis d\'excursion a été supprimé avec succès.');
        }

        return $this->redirectToRoute('app_back_favoris_avis_excursion_index', [], Response::HTTP_SEE_OTHER);
    }
}
