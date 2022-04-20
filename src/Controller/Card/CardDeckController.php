<?php

namespace App\Controller\Card;

use App\Card\CardDeck;
use App\Card\CardHand;
use App\Card\Player;
use App\Card\DeckWith2Jokers;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CardDeckController extends AbstractController
{
    /**
     * @Route("/card/deck", name="card-deck")
     */
    public function deck(Request $request): Response
    {
        // $data = [
        //     'search' => $request->query->get('search'),
        // ];

        $deck = new CardDeck();

        $deck_list = $deck->showDeckList();

        $data = [
            'deck_list' => $deck_list,
        ];

        // return $this->render('card/carddeck.html.twig');
        return $this->render('card/carddeck.html.twig', $data);
    }

    /**
     * @Route("/card/deck2", name="card-deck2")
     */
    public function deck2(Request $request): Response
    {
        // $data = [
        //     'search' => $request->query->get('search'),
        // ];

        $deck = new DeckWith2Jokers();
        // $deck->addJokers();

        // var_dump($deck);

        $deck_list = $deck->showDeckList();

        // var_dump($deck_list);

        $data = [
            'deck_list' => $deck_list,
        ];



        // return $this->render('card/carddeck.html.twig');
        return $this->render('card/carddeck.html.twig', $data);
    }

    /**
     * @Route("/card/deck/shuffle", name="shuffle-deck")
     */
    public function deckShuffle(
        Request $request,
        SessionInterface $session
    ): Response {
        $session->clear();

        $deck = new CardDeck();

        $shuffle_list = $deck->shuffleDeck();

        $data = [
            'shuffle_list' => $shuffle_list,
        ];

        // return $this->render('card/carddeck.html.twig');
        return $this->render('card/cardshuffle.html.twig', $data);
    }

    /**
     * @Route(
     *      "/card/deck/draw",
     *      name="draw-card",
     *      methods={"GET", "HEAD"}
     * )
     */
    public function drawCardFromDeck(Request $request): Response
    {
        return $this->render('card/carddraw.html.twig');
    }

    /**
     * @Route(
     *      "/card/deck/draw",
     *      name="draw-card-process",
     *      methods={"POST"}
     * )
     */
    public function processDrawPost(
        Request $request,
        SessionInterface $session
    ): Response {
        $deck = $session->get("carddeck") ?? new CardDeck();

        $card = $deck->drawCard();

        if ($card == 0) {
            $this->addFlash("info", "Deck is empty");
            $cards_left = 0;
        } else {
            $cards_left = $deck->removeCard($card[0]);
            $this->addFlash("info", "Card: " . $card[1]);
        }

        $session->set("carddeck", $deck);

        $this->addFlash("info", "Cards left: " . $cards_left);


        // return $this->render('card/carddeck.html.twig');
        return $this->redirectToRoute('draw-card');
    }

    /**
     * @Route(
     *      "/card/deck/draw/{number}",
     *      name="draw-card-number",
     *      methods={"GET", "POST"}
     * )
     */
    public function processDrawGet(
        Request $request,
        SessionInterface $session
    ): Response {
        $deck = $session->get("carddeck") ?? new CardDeck();

        // Checks if it is a POST or GET-request
        if ($request->request->get("draw")) {
            $card = $deck->drawCard();

            $cards_left = $deck->removeCard($card[0]);

            $session->set("carddeck", $deck);

            $this->addFlash("info", "Card: " . $card[1]);
            $this->addFlash("info", "Cards left: " . $cards_left);
        } else {
            $number = $request->getPathInfo();
            $number = explode("/", $number);
            $number = intval($number[4]);

            for ($i = 1; $i <= $number; $i++) {
                $card = $deck->drawCard();

                if ($card == 0) {
                    $this->addFlash("info", "Deck is empty");
                    $cards_left = 0;
                    break;
                } else {
                    $cards_left = $deck->removeCard($card[0]);
                    $this->addFlash("info", "Card: " . $card[1]);
                }
            };
            $this->addFlash("info", "Cards left: " . $cards_left);
        }

        $session->set("carddeck", $deck);

        // return $this->render('card/carddeck.html.twig');
        return $this->render('card/carddraw.html.twig');
    }

    /**
     * @Route(
     *      "/card/deck/deal/{players}/{cards}",
     *      name="deal-card",
     *      methods={"GET", "HEAD"}
     * )
     */
    public function dealCard(
        Request $request,
        SessionInterface $session
    ): Response {
        $deck = new CardDeck();
        $game = [];

        // $test_player = new CardHand($deck, 5);
        // $test_player2 = new CardHand($deck, 5);

        $path = $request->getPathInfo();
        $path = explode("/", $path);
        $players = $path[4];
        $cards = $path[5];

        // Not implemented check for empty deck yet
        for ($i = 1; $i <= $players; $i++) {
            $game[] = new Player($deck, $cards);
        }

        $cards_left = count($deck->showDeckList());

        $data = [
            'game' => $game,
            'cards_left' => $cards_left,
        ];

        return $this->render('card/dealcard.html.twig', $data);
    }
}
