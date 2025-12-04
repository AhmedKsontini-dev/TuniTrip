<?php

namespace App\Controller\Back\Excursion;

use App\Entity\ImageExcursion;
use App\Form\ImageExcursionType;
use App\Repository\ExcursionRepository;
use App\Repository\ImageExcursionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[Route('/admin/image_excursion')]
class ImageExcursionController extends AbstractController
{
    #[Route('/', name: 'admin_image_excursion_index', methods: ['GET'])]
    public function index(ImageExcursionRepository $repository): Response
    {
        return $this->render('Back/image_excursion/index.html.twig', [
            'images' => $repository->findAll(),
        ]);
    }

    #[Route('/new/{excursionId}', name: 'admin_image_excursion_new', methods: ['GET','POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $em,
        FileUploader $fileUploader,
        int $excursionId,
        ExcursionRepository $excursionRepository
    ): Response
    {
        $excursion = $excursionRepository->find($excursionId);
        if (!$excursion) {
            throw $this->createNotFoundException('Excursion non trouvée.');
        }

        $image = new ImageExcursion();
        $form = $this->createForm(ImageExcursionType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile[] $files */
            $files = $form->get('imageUrl')->getData();

            if ($files) {
                foreach ($files as $file) {
                    $filename = $fileUploader->upload($file);

                    $imageEntity = new ImageExcursion();
                    $imageEntity->setExcursion($excursion);
                    $imageEntity->setImageUrl($filename);

                    $em->persist($imageEntity);
                }
            }

            $em->flush();
            $this->addFlash('success', '✅ Images ajoutées avec succès.');

            return $this->redirectToRoute('admin_image_excursion_new', [
                'excursionId' => $excursionId
            ]);
        }

        return $this->render('Back/image_excursion/new.html.twig', [
            'form' => $form->createView(),
            'excursion' => $excursion,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_image_excursion_edit', methods: ['GET','POST'])]
    public function edit(Request $request, ImageExcursion $image, EntityManagerInterface $em, FileUploader $fileUploader): Response
    {
        $form = $this->createForm(ImageExcursionType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('imageUrl')->getData();
            if ($file) {
                $filename = $fileUploader->upload($file);
                $image->setImageUrl($filename);
            }

            $em->flush();
            $this->addFlash('success', '✏️ Image modifiée avec succès.');

            return $this->redirectToRoute('admin_image_excursion_new', [
                'excursionId' => $image->getExcursion()->getId()
            ]);
        }

        return $this->render('Back/image_excursion/edit.html.twig', [
            'form' => $form->createView(),
            'image' => $image,
        ]);
    }

    #[Route('/{id}', name: 'admin_image_excursion_delete', methods: ['POST'])]
    public function delete(Request $request, ImageExcursion $image, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete'.$image->getId(), $request->request->get('_token'))) {
            $excursionId = $image->getExcursion()->getId();
            $em->remove($image);
            $em->flush();
            $this->addFlash('success', '🗑️ Image supprimée avec succès.');

            return $this->redirectToRoute('admin_image_excursion_new', [
                'excursionId' => $excursionId
            ]);
        }

        $this->addFlash('error', '❌ CSRF invalide, suppression impossible.');
        return $this->redirectToRoute('admin_image_excursion_index');
    }
}
