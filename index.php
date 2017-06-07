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

$deck    = buildDeck();
echo "Deck unpacked<br>";
shuffle($deck);
echo "shuffled deck<br>";
foreach ($players as &$p)
{
    dealCards($deck,$p,$stack,7);
}
array_push($stack,$deck[0]);
echo "The first card is ".$deck[0]['name'].$deck[0]['symbol']."<br>";
array_splice($deck,0,1);
while($end != true)
{
    foreach ($players as &$p)
    {
        $index = 0;
        $played = false;
        foreach ($p['hand'] as &$h)
        {
            if(!$played && !$end)
            {
                $stackIndex = count($stack)-1;
                $lastcard   = $stack[$stackIndex];
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
        $countCards = $p['hand'];
        if(count($countCards) == 0)
        {
            echo $p['name'].' won<br>';
            $end = true;
            die();
        }
        if (!$played)
        {
            echo $p['name']." can't play, ";
            dealCards($deck,$p,$stack);
        }
    }
}