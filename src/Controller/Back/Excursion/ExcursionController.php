<?php

namespace App\Controller\Back\Excursion;

use App\Entity\Excursion;
use App\Form\ExcursionType;
use App\Repository\ExcursionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\FileUploader;

#[Route('/admin/excursion')]
class ExcursionController extends AbstractController
{
    #[Route('/', name: 'admin_excursion_index', methods: ['GET'])]
    public function index(ExcursionRepository $repository): Response
    {
        return $this->render('Back/excursion/index.html.twig', [
            'excursions' => $repository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_excursion_new', methods: ['GET','POST'])]
    public function new(Request $request, EntityManagerInterface $em, FileUploader $fileUploader): Response
    {
        $excursion = new Excursion();
        $form = $this->createForm(ExcursionType::class, $excursion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Image principale
            $imageFile = $form->get('imagePrincipale')->getData();
            if ($imageFile) {
                $filename = $fileUploader->upload($imageFile);
                $excursion->setImagePrincipale($filename);
            }

            $excursion->setActif($form->get('actif')->getData() ?? true);
            $excursion->setCreatedAt(new \DateTimeImmutable());
            $excursion->setUpdatedAt(new \DateTimeImmutable());

            // ⚡ Liaisons inclus/non inclus/itinéraires
            foreach ($excursion->getInclusList() as $inclus) {
                $inclus->setExcursion($excursion);
                $em->persist($inclus);
            }

            foreach ($excursion->getNonInclusList() as $nonInclus) {
                $nonInclus->setExcursion($excursion);
                $em->persist($nonInclus);
            }

            foreach ($excursion->getItineraires() as $itineraire) {
                $itineraire->setExcursion($excursion);
                $em->persist($itineraire);
            }

            $em->persist($excursion);
            $em->flush();

            $this->addFlash('success', '✅ Excursion ajoutée avec succès.');
            return $this->redirectToRoute('admin_excursion_index');
        }

        return $this->render('Back/excursion/new.html.twig', [
            'form' => $form->createView(),
            'excursion' => $excursion,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_excursion_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Excursion $excursion, EntityManagerInterface $em, FileUploader $fileUploader): Response
    {
        $form = $this->createForm(ExcursionType::class, $excursion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Image principale
            $imageFile = $form->get('imagePrincipale')->getData();
            if ($imageFile) {
                $filename = $fileUploader->upload($imageFile);
                $excursion->setImagePrincipale($filename);
            }

            $excursion->setUpdatedAt(new \DateTimeImmutable());

            // ⚡ Liaisons inclus/non inclus/itinéraires
            foreach ($excursion->getInclusList() as $inclus) {
                $inclus->setExcursion($excursion);
                $em->persist($inclus);
            }

            foreach ($excursion->getNonInclusList() as $nonInclus) {
                $nonInclus->setExcursion($excursion);
                $em->persist($nonInclus);
            }

            foreach ($excursion->getItineraires() as $itineraire) {
                $itineraire->setExcursion($excursion);
                $em->persist($itineraire);
            }

            $em->flush();

            $this->addFlash('success', '✏️ Excursion modifiée avec succès.');
            return $this->redirectToRoute('admin_excursion_index');
        }

        return $this->render('Back/excursion/edit.html.twig', [
            'form' => $form->createView(),
            'excursion' => $excursion,
        ]);
    }

    #[Route('/{id}', name: 'admin_excursion_show', methods: ['GET'])]
    public function show(Excursion $excursion): Response
    {
        return $this->render('Back/excursion/show.html.twig', [
            'excursion' => $excursion,
        ]);
    }

    #[Route('/{id}', name: 'admin_excursion_delete', methods: ['POST'])]
    public function delete(Request $request, Excursion $excursion, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete'.$excursion->getId(), $request->request->get('_token'))) {
            $em->remove($excursion);
            $em->flush();
            $this->addFlash('success', '🗑️ Excursion supprimée avec succès.');
        }

        return $this->redirectToRoute('admin_excursion_index');
    }
}
