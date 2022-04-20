<?php

namespace App\Card;

use App\Card\CardDeck;

class DeckWith2Jokers extends CardDeck
{
    public function __construct()
    {
        parent::__construct();

        array_push($this->deck, new Card(0, "clovers", "joker"));
        array_push($this->deck, new Card(0, "pikes", "joker"));
    }
}
