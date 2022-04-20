<?php

namespace App\Card;

use App\Card\CardDeck;

class CardHand
{
    private $hand = [];

    // Gör allt i Player.php till att börja med.
    // Blev för många "steg" att få fram handen på ett snyggt sätt...
    public function __construct($deck, $number)
    {
        for ($i = 1; $i <= $number; $i++) {
            $card = $deck->drawCard();
            $deck->removeCard($card[0]);

            $this->hand[] = $card[1];
        };
    }
}
