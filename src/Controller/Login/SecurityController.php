<?php

namespace App\Controller\Login;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // Si l'utilisateur est déjà connecté, rediriger vers l'accueil
        if ($this->getUser()) {
            return $this->redirectToRoute('app_accueil');
        }

        // Récupérer l'erreur de connexion s'il y en a une
        $error = $authenticationUtils->getLastAuthenticationError();
        
        // Dernier nom d'utilisateur (email) saisi
        $lastUsername = $authenticationUtils->getLastUsername();

        // Rediriger vers la page précédente (referer) avec les variables d'erreur
        // Cela permet d'afficher le modal avec le message d'erreur
        $referer = $this->container->get('request_stack')->getCurrentRequest()->headers->get('referer');
        
        if ($referer && $error) {
            // Si erreur et referer existe, on redirige vers la page précédente
            // Les flash messages seront gérés par le LoginAuthenticator
            return $this->redirect($referer);
        }

        // Si pas de referer ou pas d'erreur, afficher la page de login classique
        return $this->render('security/login.html.twig', [
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'last_username' => $authenticationUtils->getLastUsername(),
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}