<?php

namespace App\Card;

use \App\Card\Card;

class CardDeck
{
    private $deck = [];

    
    public function __construct()
    {
        $rep_values = [
            1, 2, 3, 4, 5, 6, 7,
            8, 9, 10, 11, 12, 13,
        ];
        $rep_color = [
            "hearts", "tiles", "clovers", "pikes",
        ];
        $rep_type = [
            "ace", "two", "three", "four", "five", "six",
            "seven", "eight", "nine", "ten", "jack", "queen", "king",
        ];
        
        // Adding cards of Hearts
        for ($i = 0; $i < count($rep_values); $i++) {
            $this->deck[] = new Card($rep_values[$i], $rep_color[0], $rep_type[$i]);
        }

        // Adding cards of Tiles
        for ($i = 0; $i < count($rep_values); $i++) {
            $this->deck[] = new Card($rep_values[$i], $rep_color[1], $rep_type[$i]);
        }

        // Adding cards of Clovers
        for ($i = 0; $i < count($rep_values); $i++) {
            $this->deck[] = new Card($rep_values[$i], $rep_color[2], $rep_type[$i]);
        }

        // Adding cards of Pikes
        for ($i = 0; $i < count($rep_values); $i++) {
            $this->deck[] = new Card($rep_values[$i], $rep_color[3], $rep_type[$i]);
        }
    }

    public function showDeck()
    {
        return $this->deck;
    }
}

