<?php

namespace App\Controller\Card;

use App\Card\CardDeck;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CardDeckControllerJson
{
    private $deck;

    /**
     * @Route(
     *      "/card/api/deck",
     *      name="card-json",
     *      methods={"GET"}
     * )
     */
    public function cardDeckJson(): Response
    {
        $this->deck = new CardDeck();

        $this->deck = $this->deck->showDeckList();

        $data = [
            'deck' => $this->deck,
        ];

        return new JsonResponse($data);
    }

    /**
     * @Route(
     *      "/card/api/deck/shuffle",
     *      name="shuffle-json",
     *      methods={"GET", "POST"}
     * )
     */
    public function shuffleDeckJson(): Response
    {
        $this->deck = new CardDeck();

        $this->deck = $this->deck->shuffleDeck();

        $data = [
            'deck' => $this->deck,
        ];

        return new JsonResponse($data);
    }
}
