<?php
namespace App\Controller\Front\Chat;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ChatMessage;

class ChatController extends AbstractController
{
    #[Route('/chat/send', name: 'chat_send', methods: ['POST'])]
    public function send(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        $userPhone = $user->getTel();
        if (empty($userPhone)) {
            return new JsonResponse([
                'status' => 'error',
                'message' => "Veuillez ajouter un numéro de téléphone dans votre profil."
            ], 400);
        }

        $message = trim($request->request->get('message', ''));
        if ($message === '') {
            return new JsonResponse([
                'status' => 'error',
                'message' => "Message vide."
            ], 400);
        }

        // Sauvegarde du message
        $chat = new ChatMessage();
        $chat->setUser($user);
        $chat->setMessage($message);
        $chat->setCreatedAt(new \DateTime());
        $em->persist($chat);
        $em->flush();

        // Génération lien WhatsApp
        $adminNumber = "21626341186"; // numéro admin sans +
        $text = "$message";
        $waLink = "https://wa.me/$adminNumber?text=" . rawurlencode($text);

        return new JsonResponse([
            'status' => 'ok',
            'wa_link' => $waLink
        ]);
    }


}
