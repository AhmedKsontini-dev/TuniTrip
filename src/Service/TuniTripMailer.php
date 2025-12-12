<?php

namespace App\Service;

use App\Entity\ReservationTransfert;
use App\Entity\ReservationVoiture;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class TuniTripMailer
{
    public function __construct(
        private MailerInterface $mailer,
        private Environment $twig
    ) {}

    public function sendReservationConfirmation(ReservationTransfert $reservation)
    {
        $html = $this->twig->render('emails/reservation_transfer_confirmee.html.twig', [
            'reservation' => $reservation
        ]);

        $text = $this->twig->render('emails/reservation_transfer_confirmee.txt.twig', [
            'reservation' => $reservation
        ]);

        $email = (new Email())
            ->from('contact@tunitrip.com')
            ->to($reservation->getEmail())
            ->subject('Votre réservation de transfert est confirmée')
            ->html($html)
            ->text($text);

        $this->mailer->send($email);
    }

    public function sendCarReservationConfirmation(ReservationVoiture $reservation)
    {
        $html = $this->twig->render('emails/reservation_voiture_confirmee.html.twig', [
            'reservation' => $reservation
        ]);

        $email = (new Email())
            ->from('contact@tunitrip.com')
            ->to($reservation->getEmail())
            ->subject('Votre réservation de voiture est confirmée 🚗')
            ->html($html);

        $this->mailer->send($email);
    }



    public function sendExcursionReservationConfirmation(\App\Entity\ReservationExcursion $reservation)
    {
        $html = $this->twig->render('emails/reservation_excursion_confirmee.html.twig', [
            'reservation' => $reservation
        ]);

        $email = (new Email())
            ->from('contact@tunitrip.com')
            ->to($reservation->getEmail())
            ->subject('Votre réservation d\'excursion est confirmée 🏕️')
            ->html($html);

        $this->mailer->send($email);
    }
}
