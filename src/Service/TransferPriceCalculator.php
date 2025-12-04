<?php

namespace App\Service;

use App\Entity\ReservationTransfert;

class TransferPriceCalculator
{
    /**
     * Calcule le prix total d'une réservation selon :
     * - le nombre de personnes
     * - le type de transfert (aller simple / retour)
     * - le tarif du trajet
     */
    public function calculate(ReservationTransfert $reservation): float
    {
        $nb = $reservation->getPersons();
        $basePrice = $reservation->getTrajetTransfert()->getPrix();

        // 🔹 Calcul selon le nombre de personnes
        if ($nb <= 4) {
            $price = $basePrice;
        } elseif ($nb <= 7) {
            $price = $basePrice + 70;
        } else {
            $price = $basePrice + 120;
        }

        // 🔹 Multiplie par 2 si type retour
        if ($reservation->getTransferType() && $reservation->getTransferType()->value === 'return') {
            $price *= 2;
        }

        return $price;
    }
}
