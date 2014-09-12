<?php

namespace Hackathon\Bundle\GameBundle\GameLogic;

use Hackathon\Bundle\GameBundle\Entity\Game;
use Hackathon\Bundle\GameBundle\Entity\GameTurn;

/**
 * Gamelogic for ConnectFour
 */
class ConnectFour
{
    public $game;
    public $width  = 7;
    public $height = 6;
    public $grid;
    // e.g. 7x6: [[0,0,0,0,0,0],[0,0,0,0,0,0],[0,0,0,0,0,0],[0,0,0,0,0,0],[0,0,0,0,0,0],[0,0,0,0,0,0],[0,0,0,0,0,0]];

    public function __construct(Game $game) {
        $this->game = $game;
        for ($i = 0; $i < $this->width; $i++) {
            for ($j = 0; $j < $this->height; $j++) {
                $this->grid[$i][$j] = 0;
            }
        }
    }

    public function getOptions() {
        $options;
        for ($i = 0; $i < $this->width; $i++) {
            if($this->grid[$i][$this->height-1] == 0){
                $options[] = $i;
            }
        }
        return $options;
    }

    public function addMoves() {
        $test = $this->game->getTurns();
        return $test[0]->getMove();
    }
}
