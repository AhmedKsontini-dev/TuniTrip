<?php

namespace App\Controller\Back\Excursion;

use App\Entity\Excursion;
use App\Entity\ExcursionDetail;
use App\Entity\InclusExcursion;
use App\Entity\NonInclusExcursion;
use App\Repository\DetailsExcursionRepository;
use App\Repository\ExcursionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/details_excursion')]
class DetailsExcursionController extends AbstractController
{
    #[Route('/', name: 'excursion_details_list', methods: ['GET'])]
    public function index(DetailsExcursionRepository $repository): Response
    {
        return $this->render('Back/excursion_details/index.html.twig', [
            'details' => $repository->findAll(),
        ]);
    }

    #[Route('/add/{id}', name: 'excursion_details_add', methods: ['GET'])]
    public function add(int $id, ExcursionRepository $excRepo): Response
    {
        $excursion = $excRepo->find($id);

        if (!$excursion) {
            throw $this->createNotFoundException("Excursion introuvable");
        }

        return $this->render('Back/excursion_details/new.html.twig', [
            'excursion' => $excursion
        ]);
    }


    // ⭐ TRAITEMENT FORMULAIRE
    #[Route('/create', name: 'excursion_details_create', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        // --- Excursion associée ---
        $excursion = $em->getRepository(Excursion::class)->find(
            $request->request->get('excursion_id')
        );

        if (!$excursion) {
            $this->addFlash('error', 'Excursion introuvable.');
            return $this->redirectToRoute('excursion_details_list');
        }


        // -------------------- 1️⃣ Sauvegarde du Détail Excursion --------------------
        $detail = new ExcursionDetail();
        $detail->setExcursion($excursion);
        $detail->setTitre($request->request->get('titre'));
        $detail->setDescription($request->request->get('description'));
        $detail->setOrdre($request->request->get('ordre'));

        $em->persist($detail);


        // -------------------- 2️⃣ Sauvegarde des éléments INCLUS --------------------
        $inclusItems = $request->request->all('inclus_items');
        $inclusOrdres = $request->request->all('inclus_ordres');

        if (!empty($inclusItems)) {
            foreach ($inclusItems as $index => $item) {
                if (trim($item) === '') continue;

                $inclus = new InclusExcursion();
                $inclus->setExcursion($excursion);
                $inclus->setItem($item);
                $inclus->setOrdre($inclusOrdres[$index] ?? 1);

                $em->persist($inclus);
            }
        }


        // -------------------- 3️⃣ Sauvegarde des éléments NON INCLUS --------------------
        $nonInclusItems = $request->request->all('non_inclus_items');
        $nonInclusOrdres = $request->request->all('non_inclus_ordres');

        if (!empty($nonInclusItems)) {
            foreach ($nonInclusItems as $index => $item) {
                if (trim($item) === '') continue;

                $nonInclus = new NonInclusExcursion();
                $nonInclus->setExcursion($excursion);
                $nonInclus->setItem($item);
                $nonInclus->setOrdre($nonInclusOrdres[$index] ?? 1);

                $em->persist($nonInclus);
            }
        }


        // -------------------- ENREGISTREMENT --------------------
        $em->flush();


        $this->addFlash('success', 'Détail ajouté avec succès (inclus et non inclus aussi) !');

        return $this->redirectToRoute('excursion_details_list');
    }
}
