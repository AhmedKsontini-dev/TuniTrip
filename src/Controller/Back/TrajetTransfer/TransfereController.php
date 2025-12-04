<?php

namespace App\Controller\Back\TrajetTransfer;

use App\Entity\TrajetTransfert;
use App\Form\TransfereType;
use App\Repository\TransfereRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[Route('/transfere')]
final class TransfereController extends AbstractController
{
    #[Route(name: 'app_transfere_index', methods: ['GET'])]
    public function index(TransfereRepository $TransfereRepository): Response
    {
        return $this->render('Back/trajet_transfer/index.html.twig', [
            'transferes' => $TransfereRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_transfere_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
    {
        $transfere = new TrajetTransfert();
        $form = $this->createForm(TransfereType::class, $transfere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $imageTransfere */
            $imageTransfere = $form->get('image')->getData();

            if ($imageTransfere) {
                $imageTransfereName = $fileUploader->upload($imageTransfere);
                $transfere->setImage($imageTransfereName);
            }

            $entityManager->persist($transfere);
            $entityManager->flush();

            return $this->redirectToRoute('app_transfere_index');
        }

        return $this->render('Back/trajet_transfer/new.html.twig', [
            'transfere' => $transfere,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_transfere_show', methods: ['GET'])]
    public function show(TrajetTransfert $transfere): Response
    {
        return $this->render('Back/trajet_transfer/show.html.twig', [
            'transfere' => $transfere,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_transfere_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TrajetTransfert $transfere, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
    {
        $form = $this->createForm(TransfereType::class, $transfere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $imageTransfere */
            $imageTransfere = $form->get('image')->getData();

            if ($imageTransfere) {
                $imageTransfereName = $fileUploader->upload($imageTransfere);
                $transfere->setImage($imageTransfereName);
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_transfere_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Back/trajet_transfer/edit.html.twig', [
            'transfere' => $transfere,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_transfere_delete', methods: ['POST'])]
    public function delete(Request $request, TrajetTransfert $transfere, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$transfere->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($transfere);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_transfere_index', [], Response::HTTP_SEE_OTHER);
    }
}