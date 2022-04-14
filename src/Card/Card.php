<?php

namespace App\Card;

class Card
{
    protected $value;
    protected $color;
    protected $type;

    public function __construct($value, $color, $type)
    {
        $this->value = $value;
        $this->color = $color;
        $this->type = $type;
    }

    public function printCard(): string
    {
        return "{$this->type} of {$this->color}";
    }

    public function stringValue(): string
    {
        return "[{$this->type}]";
    }
}

// $card = new Card(5, "hearts", "five");
// echo $card->stringValue();
// echo $card->printCard();
// echo "Testing Card class\n";
// var_dump($card);
// $card.stringValue();
