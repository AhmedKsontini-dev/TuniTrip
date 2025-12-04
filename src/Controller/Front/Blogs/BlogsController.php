<?php

namespace App\Controller\Front\Blogs;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BlogsController extends AbstractController
{
    #[Route('/blogs', name: 'app_front_blogs')]
    public function index(): Response
    {
        return $this->render('Front/Blogs/index.html.twig', [
            'controller_name' => 'AboutController',
        ]);
    }
}
