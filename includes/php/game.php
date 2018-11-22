<?php
/**
 * Created by PhpStorm.
 * User: melvi
 * Date: 20/10/2018
 * Time: 21:39
 */

//function to deal cards to the players
function game(&$deck,&$players,&$stack)
{
    $end = false;
    $skip = false;
    $takeCards = 0;

    //now the turns will begin until the game ends
    while($end != true)
    {
        //loop through players
        foreach ($players as &$p)
        {
            //check last played card
            $stackIndex = count($stack)-1;
            $lastcard   = $stack[$stackIndex];

            if ($skip) {
                echo $p['name']." has to skip their turn.<br>";
                $skip = false;
                continue;
            }

            $index = 0;
            $played = false;
            $turn = true;

            while($turn)
            {
                //Loop through the players hand to find compatible card if the player hasn't played yet
                if ($takeCards > 0){
                    foreach ($p['hand'] as &$h)
                    {
                        //check if this card is compatible with the card on the stack
                        if($h['name'] == '2')
                        {
                            if($h['name'] === '2')
                            {
                                $takeCards = $takeCards+2;
                                echo $p['name'].' plays '.$h['name'].$h['symbol'].". Since it is a 2 the next player has to take " . $takeCards . " cards or play a 2.<br>";
                            } else{
                                echo $p['name'].' plays '.$h['name'].$h['symbol'].".<br>";
                            }
                            array_push($stack,$h);
                            array_splice($p['hand'],$index,1);
                            $played = true;
                            $turn = false;
                        }
                        $index++;
                    }
                    if (!$played) {
                        echo $p['name']." can't play, ";
                        dealCards($deck,$p,$stack,$takeCards);
                        $turn = false;
                        $takeCards = 0;
                    }
                } else {
                    foreach ($p['hand'] as &$h)
                    {
                        if(!$played && !$end)
                        {

                            //check if this card is compatible with the card on the stack
                            if($h['name'] == $lastcard['name']|| $h['symbol'] == $lastcard['symbol'])
                            {
                                if($h['name'] === '7')
                                {
                                    echo $p['name'].' plays '.$h['name'].$h['symbol'].". Since it is a 7 they can play again.<br>";
                                }else if($h['name'] === '8')
                                {
                                    echo $p['name'].' plays '.$h['name'].$h['symbol'].". Since it is a 8 the next player has to skip their turn.<br>";
                                    $skip = true;
                                }else if($h['name'] === '2')
                                {
                                    echo $p['name'].' plays '.$h['name'].$h['symbol'].". Since it is a 2 the next player has to take 2 cards or play a 2.<br>";
                                    $takeCards = $takeCards+2;
                                } else{
                                    echo $p['name'].' plays '.$h['name'].$h['symbol'].".<br>";
                                }
                                array_push($stack,$h);
                                array_splice($p['hand'],$index,1);
                                if($h['name'] != '7')
                                {
                                    $played = true;
                                    $turn = false;
                                }
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
                        $turn = false;
                    }
                }
            }
        }
    }
}