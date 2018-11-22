<link href="/includes/css/main.css" type="text/css" rel="stylesheet">
<?php
/**
 * Created by PhpStorm.
 * User: nivlem
 * Date: 07/06/17
 * Time: 09:37
 */
include "deck_builder.php";
include "deal_cards.php";
include "game.php";

//creating players
$players = [
    0=>[
        'name'=>$_POST['name'],
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


game($deck,$players,$stack);
