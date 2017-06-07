<?php
/**
 * Created by PhpStorm.
 * User: nivlem
 * Date: 07/06/17
 * Time: 09:44
 */

//Builds the deck out of symbols and letters/numbers
function buildDeck()
{
    $deck     = array();
    $symbols  = ['&spades;', '&clubs;', '<span class="red">&hearts;</span>', '<span class="red">&diams;</span>'];
    $cardName = ['A','2','3','4','5','6','7','8','9','10','J','Q','K'];

    foreach ($symbols as $s)
    {
        foreach ($cardName as $c)
        {
            $card['name']   = $c;
            $card['symbol'] = $s;

            array_push($deck,$card);
        }
    }
    return $deck;
}