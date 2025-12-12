<?php

namespace App\Controller\Back\ContactMessage;

use App\Entity\ContactMessage;
use App\Form\ContactMessageType;
use App\Repository\ContactMessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;


#[Route('/contact/message', name: 'app_contact_message_')]
final class ContactMessageController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(ContactMessageRepository $contactMessageRepository): Response
    {
        return $this->render('Back/contact_message/index.html.twig', [
            'contact_messages' => $contactMessageRepository->findBy([], ['dateEnvoi' => 'DESC']),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $contactMessage = new ContactMessage();
        $form = $this->createForm(ContactMessageType::class, $contactMessage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contactMessage);
            $entityManager->flush();

            return $this->redirectToRoute('app_contact_message_index');
        }

        return $this->render('Back/contact_message/new.html.twig', [
            'contact_message' => $contactMessage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(ContactMessage $contactMessage): Response
    {
        return $this->render('Back/contact_message/show.html.twig', [
            'contact_message' => $contactMessage,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ContactMessage $contactMessage, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ContactMessageType::class, $contactMessage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_contact_message_index');
        }

        return $this->render('Back/contact_message/edit.html.twig', [
            'contact_message' => $contactMessage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, ContactMessage $contactMessage, EntityManagerInterface $entityManager): Response
    {
        $csrfToken = $request->headers->get('X-CSRF-TOKEN');

        if ($this->isCsrfTokenValid('delete_message', $csrfToken)) {
            $entityManager->remove($contactMessage);
            $entityManager->flush();

            return $this->json(['success' => true]);
        }

        return $this->json(['success' => false, 'error' => 'Token CSRF invalide']);
    }


    // Route pour marquer un message comme lu via AJAX
    #[Route('/{id}/mark-as-read', name: 'mark_as_read', methods: ['POST'])]
    public function markAsRead(ContactMessage $contactMessage, EntityManagerInterface $em): Response
    {
        $contactMessage->setLus(true);
        $em->flush();

        return $this->json(['success' => true]);
    }

    #[Route('/{id}/reply', name: 'reply', methods: ['POST'])]
    public function reply(
        ContactMessage $contactMessage,
        Request $request,
        MailerInterface $mailer
    ): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $reply = $data['reply'] ?? null;
        $emailClient = $data['email'] ?? null;

        if (!$reply || !$emailClient) {
            return new JsonResponse(['success' => false, 'message' => 'Données manquantes.'], 400);
        }

        try {
            $email = (new Email())
                ->from('votre-agence@example.com') // mettre ton email expéditeur
                ->to($emailClient)
                ->subject('Réponse à votre message : ' . $contactMessage->getSujet())
                ->html("<p>Bonjour {$contactMessage->getNom()},</p><p>{$reply}</p><hr><p>Message original :<br>{$contactMessage->getMessage()}</p>");

            $mailer->send($email);

            return new JsonResponse(['success' => true]);
        } catch (\Exception $e) {
            return new JsonResponse(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
