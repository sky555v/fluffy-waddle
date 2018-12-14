<?php

namespace Hackathon\PlayerIA;

use Hackathon\Game\Result;

/**
 * Class LovePlayer
 * @package Hackathon\PlayerIA
 * @author Vivien D'ESTE
 */
class Sky555vPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    public function getChoice()
    {
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Choice           ?    $this->result->getLastChoiceFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Choice ?    $this->result->getLastChoiceFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get all the Choices          ?    $this->result->getChoicesFor($this->mySide)
        // How to get the opponent Last Choice ?    $this->result->getChoicesFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get the stats                ?    $this->result->getStats()
        // How to get the stats for me         ?    $this->result->getStatsFor($this->mySide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // How to get the stats for the oppo   ?    $this->result->getStatsFor($this->opponentSide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // -------------------------------------    -----------------------------------------------------
        // How to get the number of round      ?    $this->result->getNbRound()
        // -------------------------------------    -----------------------------------------------------
        // How can i display the result of each round ? $this->prettyDisplay()
        // -------------------------------------    -----------------------------------------------------

        //Get the result of all my choice
        $myChoice = $this->result->getChoicesFor($this->mySide);

        //Get the result of all the opponent choice
        $opponentChoice = $this->result->getChoicesFor($this->opponentSide);

        //Variable to save the number of time opponent play not like me
        $playOpposite = 0;

        //Variable to save the number of time opponent play not like me
        $playEqual = 0;

        //If it is the first round I play foe
        //else if it is the second round I play friend
        //else I see if the opponent play the opposite of me or the same as me
        if (sizeof($myChoice) === 0) {
            return parent::friendChoice();
        } else if (sizeof($myChoice) === 1) {
            return parent::foeChoice();
        } else {
            for ($i = 0; $i < sizeof($myChoice) - 1; $i++) {
                if ($myChoice[$i] != $opponentChoice[$i+1]) {
                    $playOpposite = $playOpposite + 1;
                } else {
                    $playEqual = $playEqual + 1;
                }
            }
            if ($playOpposite > $playEqual) {
                if ($this->result->getLastChoiceFor($this->mySide) === parent::foeChoice()) {
                    return parent::friendChoice();
                } else {
                    return parent::foeChoice();
                }
            } else {
                return parent::foeChoice();
            }
        }
    }
};