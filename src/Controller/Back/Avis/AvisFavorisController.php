<?php

namespace App\Controller\Back\Avis;

use App\Entity\Avis;
use App\Repository\AvisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/avis')]
class AvisFavorisController extends AbstractController
{
    #[Route('/', name: 'app_back_favoris_avis_index', methods: ['GET'])]
    public function index(AvisRepository $avisRepository): Response
    {
        return $this->render('Back/avis/avis_complet/index.html.twig', [
            'avis' => $avisRepository->findBy([], ['dateCreation' => 'DESC']),
        ]);
    }

    #[Route('/{id}', name: 'app_back_favoris_avis_delete', methods: ['POST'])]
    public function delete(Request $request, Avis $avi, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$avi->getId(), $request->request->get('_token'))) {
            $entityManager->remove($avi);
            $entityManager->flush();
            $this->addFlash('success', 'L\'avis a été supprimé avec succès.');
        }

        return $this->redirectToRoute('app_back_favoris_avis_index', [], Response::HTTP_SEE_OTHER);
    }
}
