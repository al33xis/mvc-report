<?php

// räkna bort hur många kort som finns i varje hand för att
// visa totalen av kort kvar

namespace App\Card;

// use \App\Card\CardHand; // Behövs denna??
use App\Card\CardDeck;

// param för hur många kort spelaren ska ha?
class Player
{
    private $hand = [];

    public function __construct($deck, $number)
    {
        for ($i = 1; $i <= $number; $i++) {
            $card = $deck->drawCard();
            $deck->removeCard($card[0]);

            $this->hand[] = $card[1];
        };

        // Behövs om jag ska använda CardHand
        // $this->hand[] = new CardHand($deck, $number);
    }

    // Funktion för att visa handen så det fungerar i twig
    public function showHand()
    {
        return $this->hand;
    }
}
