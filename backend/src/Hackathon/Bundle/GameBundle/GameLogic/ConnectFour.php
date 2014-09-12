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

    public function addMove($column, $move) {
        $col = $this->grid[$column];
        foreach ($col as $key => $value){
            if($value == 0){
                $this->grid[$column][$key] = $move % 2 == 0 ? 1 : 2;
                break;
            }
        }
    }

    public function addMoves() {
        $turns = $this->game->getTurns();
        foreach ($turns as $key => $value){
            $this->addMove($value->getMove(), $key);
        }
    }
}
