<?php

namespace App\Controller\Front\Contact;

use App\Entity\ContactMessage;
use App\Form\ContactMessageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_front_contact')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $contact = new ContactMessage();
        $form = $this->createForm(ContactMessageType::class, $contact);
        $form->handleRequest($request);

        // 🧩 Vérifie si le formulaire est soumis
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                // ✅ Enregistrement du message
                $contact->setDateEnvoi(new \DateTime());
                $em->persist($contact);
                $em->flush();

                // 🚀 Si la requête vient d’AJAX, renvoyer du JSON (pas de rechargement)
                if ($request->isXmlHttpRequest()) {
                    return $this->json([
                        'success' => true,
                        'message' => '✅ Votre message a été envoyé avec succès !'
                    ]);
                }

                // Sinon, affichage classique + redirection pour vider le formulaire
                $this->addFlash('success', '✅ Votre message a été envoyé avec succès !');
                return $this->redirectToRoute('app_front_contact');
            } else {
                // ❌ En cas d’erreurs de validation
                if ($request->isXmlHttpRequest()) {
                    $errors = [];
                    foreach ($form->getErrors(true) as $error) {
                        $errors[] = $error->getMessage();
                    }

                    return $this->json([
                        'success' => false,
                        'message' => '❌ Le formulaire contient des erreurs.',
                        'errors' => $errors,
                    ]);
                } else {
                    $this->addFlash('error', '❌ Le formulaire contient des erreurs. Merci de vérifier les champs.');
                }
            }
        }

        // 🎨 Rendu de la page (formulaire visible)
        return $this->render('Front/Contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
