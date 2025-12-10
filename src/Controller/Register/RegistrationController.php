<?php

namespace App\Controller\Register;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var string $plainPassword */
            $plainPassword = $form->get('plainPassword')->getData();

            // encode the plain password
            $user->setPassword($userPasswordHasher->hashPassword($user, $plainPassword));

            $entityManager->persist($user);
            $entityManager->flush();

            // Message de succès et ouverture automatique du modal de connexion
            $this->addFlash('success_register', 'Votre compte a été créé avec succès.');
            $this->addFlash('open_login_after_register', true);

            // Tenter de revenir à la page d'origine (utilisée par les modales)
            $redirectData = $request->request->all('registration_form');
            $redirectTo = $redirectData['redirectTo'] ?? $request->headers->get('referer');

            if ($redirectTo) {
                return $this->redirect($redirectTo);
            }

            // Fallback vers la page d'accueil
            return $this->redirectToRoute('app_accueil');
        }

        // Si le formulaire est soumis mais invalide, collecter les erreurs
        if ($form->isSubmitted() && !$form->isValid()) {
            $errors = [];
            foreach ($form->getErrors(true) as $error) {
                $errors[] = $error->getMessage();
            }
            
            if (!empty($errors)) {
                $this->addFlash('error_register', implode(' ', $errors));
            } else {
                $this->addFlash('error_register', 'Veuillez corriger les erreurs dans le formulaire.');
            }
            
            // Marquer pour rouvrir le modal
            $this->addFlash('open_register_modal', true);
            
            // Rediriger vers la page précédente
            $referer = $request->headers->get('referer');
            if ($referer) {
                return $this->redirect($referer);
            }
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }
}