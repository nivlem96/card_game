<link href="/includes/css/main.css" type="text/css" rel="stylesheet">
<?php
/**
 * Created by PhpStorm.
 * User: nivlem
 * Date: 07/06/17
 * Time: 09:37
 */
include "includes/php/deck_builder.php";
include "includes/php/deal_cards.php";

$end = false;

//creating players
$players = [
        0=>[
            'name'=>'Alice',
            'hand'=>[]
            ],
        1=>[
            'name'=>'Bob',
            'hand'=>[]
        ],
        2=>[
            'name'=>'Carol',
            'hand'=>[]
        ],
        3=>[
            'name'=>'Eve',
            'hand'=>[]
        ]
    ];
$stack = [];

//building deck
$deck    = buildDeck();
echo "Deck unpacked<br>";

//shuffle deck
shuffle($deck);
echo "shuffled deck<br>";

//deal cards to players
foreach ($players as &$p)
{
    dealCards($deck,$p,$stack,7);
}

//pull first card on th estack from the top of the deck
array_push($stack,$deck[0]);
echo "The first card is ".$deck[0]['name'].$deck[0]['symbol']."<br>";
array_splice($deck,0,1);

//now the turns will begin until the game ends
while($end != true)
{
    //loop through players
    foreach ($players as &$p)
    {
        $index = 0;
        $played = false;

        //Loop through the players hand to find compatible card if the player hasn't played yet
        foreach ($p['hand'] as &$h)
        {
            if(!$played && !$end)
            {
                //check last played card
                $stackIndex = count($stack)-1;
                $lastcard   = $stack[$stackIndex];

                //check if this card is compatible with the card on the stack
                if($h['name'] == $lastcard['name']|| $h['symbol'] == $lastcard['symbol'])
                {
                    echo $p['name'].' plays '.$h['name'].$h['symbol']."<br>";
                    array_push($stack,$h);
                    array_splice($p['hand'],$index,1);
                    $played = true;
                }
            }
            $index++;
        }

        //check if players hand is empty, if so game is over
        if(count($p['hand']) == 0)
        {
            echo $p['name'].' won<br>';
            $end = true;
            die();
        }

        //check if the players has played this turn, else take a card
        if (!$played)
        {
            echo $p['name']." can't play, ";
            dealCards($deck,$p,$stack);
        }
    }
}