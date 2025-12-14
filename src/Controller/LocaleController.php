<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LocaleController extends AbstractController
{
    #[Route('/change-locale/{_locale}', name: 'change_locale')]
    public function changeLocale(Request $request, string $_locale): Response
    {
        // Store chosen locale in the session
        $request->getSession()->set('_locale', $_locale);

        // Try to redirect back to the previous page, fallback to home
        $referer = $request->headers->get('referer');
        if ($referer) {
            return $this->redirect($referer);
        }

        return $this->redirectToRoute('app_accueil');
    }
}
