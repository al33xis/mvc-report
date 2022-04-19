<?php

namespace App\Card;

use App\Card\CardDeck;

require_once 'vendor/autoload.php';

$deck = new CardDeck();
// var_dump($deck);
// var_dump($deck->showDeckList());

// var_dump($deck->shuffleDeck());

var_dump($deck->drawCard());