<?php
/**
 * Created by PhpStorm.
 * User: nivlem
 * Date: 07/06/17
 * Time: 10:15
 */

//function to deal cards to the players
function dealCards(&$deck,&$player,&$stack,$amount=1)
{
    $cards = 0;
    $stackCardsIndex = count($stack);
    $dealtCards = [];

    //check if deck is empty
    if(empty($deck))
    {
        echo "empty deck<br>";
        $temporaryCard = $stack[$stackCardsIndex];
        array_splice($stack,$stackCardsIndex,1);
        $deck = $stack;
        shuffle($deck);
        $stack[0]= $temporaryCard;
        echo "shuffled deck<br>";
    }

    //take cards untill you you have the given amount
    while($cards < $amount)
    {
        array_push($player['hand'],$deck[0]);
        array_push($dealtCards,$deck[0]);
        array_splice($deck,0,1);
        $cards++;
    }

    //Display the cards that are raken from the deck
    echo $player['name'].' was dealt ';foreach($dealtCards as $c){echo $c['name'].$c['symbol'].' ';}echo '<br>';
}