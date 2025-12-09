<?php

namespace App\Service;

use App\Entity\ReservationExcursion;

class ExcursionPriceCalculator
{
    public function calculate(ReservationExcursion $reservation): float
    {
        $adultes = $reservation->getAdult();
        $enfants = $reservation->getChild();

        $prixAdulte = $reservation->getExcursion()->getPrixParPersonne();
        $prixEnfant = $prixAdulte * 0.8; // remise 20% pour les enfants

        $total = ($adultes * $prixAdulte) + ($enfants * $prixEnfant);

        return $total;
    }
}

