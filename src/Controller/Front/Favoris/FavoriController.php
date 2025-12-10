<?php
namespace App\Controller\Front\Favoris;

use App\Entity\Favori;
use App\Entity\Excursion;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FavoriController extends AbstractController
{
    #[Route('/favoris', name: 'app_front_favoris_index')]
    public function index(): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login'); // Rediriger vers login si non connecté
        }

        return $this->render('Front/Favoris/index.html.twig', [
            'favoris' => $user->getFavoris(),
        ]);
    }
    #[Route('/favori/toggle/{id}', name: 'favori_toggle', methods: ['POST'])]
    public function toggle(Excursion $excursion, EntityManagerInterface $em): JsonResponse
    {
        $user = $this->getUser();
        if (!$user) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Vous devez être connecté.'
            ], 403);
        }

        $favoriRepo = $em->getRepository(Favori::class);

        // Vérifier si l’excursion est déjà en favoris
        $favori = $favoriRepo->findOneBy([
            'user' => $user,
            'excursion' => $excursion
        ]);

        if ($favori) {
            $em->remove($favori);
            $em->flush();

            return new JsonResponse(['success' => true, 'favori' => false]);
        }

        // Sinon créer le favori
        $favori = new Favori();
        $favori->setUser($user);
        $favori->setExcursion($excursion);
        $favori->setDateAjout(new \DateTime());

        $em->persist($favori);
        $em->flush();

        return new JsonResponse(['success' => true, 'favori' => true]);
    }
}
