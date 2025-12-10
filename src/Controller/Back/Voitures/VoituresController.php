<?php

namespace App\Controller\Back\Voitures;

use App\Entity\Voitures;
use App\Form\VoituresType;
use App\Repository\VoituresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[Route('/voitures')]
final class VoituresController extends AbstractController
{
    #[Route(name: 'app_voitures_index', methods: ['GET'])]
    public function index(VoituresRepository $voituresRepository): Response
    {
        return $this->render('Back/voitures/index.html.twig', [
            'voitures' => $voituresRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_voitures_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
    {
        $voiture = new Voitures();
        $form = $this->createForm(VoituresType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $imageVoiture */
            $imageVoiture = $form->get('image')->getData();

            if ($imageVoiture) {
                $imageVoitureName = $fileUploader->upload($imageVoiture);
                $voiture->setImage($imageVoitureName);
            }


            $entityManager->persist($voiture);
            $entityManager->flush();

            return $this->redirectToRoute('app_voitures_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Back/voitures/new.html.twig', [
            'voiture' => $voiture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_voitures_show', methods: ['GET'])]
    public function show(Voitures $voiture): Response
    {
        return $this->render('Back/voitures/show.html.twig', [
            'voiture' => $voiture,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_voitures_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        Voitures $voiture,
        EntityManagerInterface $entityManager,
        FileUploader $fileUploader // 🔹 injecter le service FileUploader
    ): Response
    {
        $form = $this->createForm(VoituresType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $imageVoiture */
            $imageVoiture = $form->get('image')->getData();

            if ($imageVoiture) {
                // Supprimer l’ancienne image si nécessaire
                if ($voiture->getImage()) {
                    $oldImagePath = $this->getParameter('images_directory') . '/' . $voiture->getImage();
                    if (file_exists($oldImagePath)) {
                        @unlink($oldImagePath);
                    }
                }

                // Upload de la nouvelle image
                $imageVoitureName = $fileUploader->upload($imageVoiture);
                $voiture->setImage($imageVoitureName);
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_voitures_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Back/voitures/edit.html.twig', [
            'voiture' => $voiture,
            'form' => $form,
        ]);
    }


    #[Route('/{id}', name: 'app_voitures_delete', methods: ['POST'])]
    public function delete(Request $request, Voitures $voiture, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voiture->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($voiture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_voitures_index', [], Response::HTTP_SEE_OTHER);
    }
}
