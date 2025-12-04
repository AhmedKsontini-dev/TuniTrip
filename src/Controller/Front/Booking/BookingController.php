<?php

namespace App\Controller\Front\Booking;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BookingController extends AbstractController
{
    #[Route('/booking', name: 'app_front_booking')]
    public function index(): Response
    {
        return $this->render('Front/Booking/index.html.twig', [
            'controller_name' => 'Front/Booking/BookingController',
        ]);
    }
}
