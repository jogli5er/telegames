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

    public function checkWin() {
        // $turns = $this->game->getTurns();
        // $last = end($turns)->getMove();
        // return intval(10000000000000000000000000000000000000000000000 + 10000000000000000000000000000000000000000000000);
        // return $this->grid[$last];
        // return $last;
        if ($this->grid[0][0] == 1 and  $this->grid[1][0] == 1 and  $this->grid[2][0] == 1 and  $this->grid[3][0] == 1){return 1;}
        if ($this->grid[0][0] == 2 and  $this->grid[1][0] == 2 and  $this->grid[2][0] == 2 and  $this->grid[3][0] == 2){return 2;}
        if ($this->grid[1][0] == 1 and  $this->grid[2][0] == 1 and  $this->grid[3][0] == 1 and  $this->grid[4][0] == 1){return 1;}
        if ($this->grid[1][0] == 2 and  $this->grid[2][0] == 2 and  $this->grid[3][0] == 2 and  $this->grid[4][0] == 2){return 2;}
        if ($this->grid[2][0] == 1 and  $this->grid[3][0] == 1 and  $this->grid[4][0] == 1 and  $this->grid[5][0] == 1){return 1;}
        if ($this->grid[2][0] == 2 and  $this->grid[3][0] == 2 and  $this->grid[4][0] == 2 and  $this->grid[5][0] == 2){return 2;}
        if ($this->grid[3][0] == 1 and  $this->grid[4][0] == 1 and  $this->grid[5][0] == 1 and  $this->grid[6][0] == 1){return 1;}
        if ($this->grid[3][0] == 2 and  $this->grid[4][0] == 2 and  $this->grid[5][0] == 2 and  $this->grid[6][0] == 2){return 2;}
        if ($this->grid[0][1] == 1 and  $this->grid[1][1] == 1 and  $this->grid[2][1] == 1 and  $this->grid[3][1] == 1){return 1;}
        if ($this->grid[0][1] == 2 and  $this->grid[1][1] == 2 and  $this->grid[2][1] == 2 and  $this->grid[3][1] == 2){return 2;}
        if ($this->grid[1][1] == 1 and  $this->grid[2][1] == 1 and  $this->grid[3][1] == 1 and  $this->grid[4][1] == 1){return 1;}
        if ($this->grid[1][1] == 2 and  $this->grid[2][1] == 2 and  $this->grid[3][1] == 2 and  $this->grid[4][1] == 2){return 2;}
        if ($this->grid[2][1] == 1 and  $this->grid[3][1] == 1 and  $this->grid[4][1] == 1 and  $this->grid[5][1] == 1){return 1;}
        if ($this->grid[2][1] == 2 and  $this->grid[3][1] == 2 and  $this->grid[4][1] == 2 and  $this->grid[5][1] == 2){return 2;}
        if ($this->grid[3][1] == 1 and  $this->grid[4][1] == 1 and  $this->grid[5][1] == 1 and  $this->grid[6][1] == 1){return 1;}
        if ($this->grid[3][1] == 2 and  $this->grid[4][1] == 2 and  $this->grid[5][1] == 2 and  $this->grid[6][1] == 2){return 2;}
        if ($this->grid[0][2] == 1 and  $this->grid[1][2] == 1 and  $this->grid[2][2] == 1 and  $this->grid[3][2] == 1){return 1;}
        if ($this->grid[0][2] == 2 and  $this->grid[1][2] == 2 and  $this->grid[2][2] == 2 and  $this->grid[3][2] == 2){return 2;}
        if ($this->grid[1][2] == 1 and  $this->grid[2][2] == 1 and  $this->grid[3][2] == 1 and  $this->grid[4][2] == 1){return 1;}
        if ($this->grid[1][2] == 2 and  $this->grid[2][2] == 2 and  $this->grid[3][2] == 2 and  $this->grid[4][2] == 2){return 2;}
        if ($this->grid[2][2] == 1 and  $this->grid[3][2] == 1 and  $this->grid[4][2] == 1 and  $this->grid[5][2] == 1){return 1;}
        if ($this->grid[2][2] == 2 and  $this->grid[3][2] == 2 and  $this->grid[4][2] == 2 and  $this->grid[5][2] == 2){return 2;}
        if ($this->grid[3][2] == 1 and  $this->grid[4][2] == 1 and  $this->grid[5][2] == 1 and  $this->grid[6][2] == 1){return 1;}
        if ($this->grid[3][2] == 2 and  $this->grid[4][2] == 2 and  $this->grid[5][2] == 2 and  $this->grid[6][2] == 2){return 2;}
        if ($this->grid[0][3] == 1 and  $this->grid[1][3] == 1 and  $this->grid[2][3] == 1 and  $this->grid[3][3] == 1){return 1;}
        if ($this->grid[0][3] == 2 and  $this->grid[1][3] == 2 and  $this->grid[2][3] == 2 and  $this->grid[3][3] == 2){return 2;}
        if ($this->grid[1][3] == 1 and  $this->grid[2][3] == 1 and  $this->grid[3][3] == 1 and  $this->grid[4][3] == 1){return 1;}
        if ($this->grid[1][3] == 2 and  $this->grid[2][3] == 2 and  $this->grid[3][3] == 2 and  $this->grid[4][3] == 2){return 2;}
        if ($this->grid[2][3] == 1 and  $this->grid[3][3] == 1 and  $this->grid[4][3] == 1 and  $this->grid[5][3] == 1){return 1;}
        if ($this->grid[2][3] == 2 and  $this->grid[3][3] == 2 and  $this->grid[4][3] == 2 and  $this->grid[5][3] == 2){return 2;}
        if ($this->grid[3][3] == 1 and  $this->grid[4][3] == 1 and  $this->grid[5][3] == 1 and  $this->grid[6][3] == 1){return 1;}
        if ($this->grid[3][3] == 2 and  $this->grid[4][3] == 2 and  $this->grid[5][3] == 2 and  $this->grid[6][3] == 2){return 2;}
        if ($this->grid[0][4] == 1 and  $this->grid[1][4] == 1 and  $this->grid[2][4] == 1 and  $this->grid[3][4] == 1){return 1;}
        if ($this->grid[0][4] == 2 and  $this->grid[1][4] == 2 and  $this->grid[2][4] == 2 and  $this->grid[3][4] == 2){return 2;}
        if ($this->grid[1][4] == 1 and  $this->grid[2][4] == 1 and  $this->grid[3][4] == 1 and  $this->grid[4][4] == 1){return 1;}
        if ($this->grid[1][4] == 2 and  $this->grid[2][4] == 2 and  $this->grid[3][4] == 2 and  $this->grid[4][4] == 2){return 2;}
        if ($this->grid[2][4] == 1 and  $this->grid[3][4] == 1 and  $this->grid[4][4] == 1 and  $this->grid[5][4] == 1){return 1;}
        if ($this->grid[2][4] == 2 and  $this->grid[3][4] == 2 and  $this->grid[4][4] == 2 and  $this->grid[5][4] == 2){return 2;}
        if ($this->grid[3][4] == 1 and  $this->grid[4][4] == 1 and  $this->grid[5][4] == 1 and  $this->grid[6][4] == 1){return 1;}
        if ($this->grid[3][4] == 2 and  $this->grid[4][4] == 2 and  $this->grid[5][4] == 2 and  $this->grid[6][4] == 2){return 2;}
        if ($this->grid[0][5] == 1 and  $this->grid[1][5] == 1 and  $this->grid[2][5] == 1 and  $this->grid[3][5] == 1){return 1;}
        if ($this->grid[0][5] == 2 and  $this->grid[1][5] == 2 and  $this->grid[2][5] == 2 and  $this->grid[3][5] == 2){return 2;}
        if ($this->grid[1][5] == 1 and  $this->grid[2][5] == 1 and  $this->grid[3][5] == 1 and  $this->grid[4][5] == 1){return 1;}
        if ($this->grid[1][5] == 2 and  $this->grid[2][5] == 2 and  $this->grid[3][5] == 2 and  $this->grid[4][5] == 2){return 2;}
        if ($this->grid[2][5] == 1 and  $this->grid[3][5] == 1 and  $this->grid[4][5] == 1 and  $this->grid[5][5] == 1){return 1;}
        if ($this->grid[2][5] == 2 and  $this->grid[3][5] == 2 and  $this->grid[4][5] == 2 and  $this->grid[5][5] == 2){return 2;}
        if ($this->grid[3][5] == 1 and  $this->grid[4][5] == 1 and  $this->grid[5][5] == 1 and  $this->grid[6][5] == 1){return 1;}
        if ($this->grid[3][5] == 2 and  $this->grid[4][5] == 2 and  $this->grid[5][5] == 2 and  $this->grid[6][5] == 2){return 2;}
        if ($this->grid[0][0] == 1 and  $this->grid[0][1] == 1 and  $this->grid[0][2] == 1 and  $this->grid[0][3] == 1){return 1;}
        if ($this->grid[0][0] == 2 and  $this->grid[0][1] == 2 and  $this->grid[0][2] == 2 and  $this->grid[0][3] == 2){return 2;}
        if ($this->grid[0][1] == 1 and  $this->grid[0][2] == 1 and  $this->grid[0][3] == 1 and  $this->grid[0][4] == 1){return 1;}
        if ($this->grid[0][1] == 2 and  $this->grid[0][2] == 2 and  $this->grid[0][3] == 2 and  $this->grid[0][4] == 2){return 2;}
        if ($this->grid[0][2] == 1 and  $this->grid[0][3] == 1 and  $this->grid[0][4] == 1 and  $this->grid[0][5] == 1){return 1;}
        if ($this->grid[0][2] == 2 and  $this->grid[0][3] == 2 and  $this->grid[0][4] == 2 and  $this->grid[0][5] == 2){return 2;}
        if ($this->grid[1][0] == 1 and  $this->grid[1][1] == 1 and  $this->grid[1][2] == 1 and  $this->grid[1][3] == 1){return 1;}
        if ($this->grid[1][0] == 2 and  $this->grid[1][1] == 2 and  $this->grid[1][2] == 2 and  $this->grid[1][3] == 2){return 2;}
        if ($this->grid[1][1] == 1 and  $this->grid[1][2] == 1 and  $this->grid[1][3] == 1 and  $this->grid[1][4] == 1){return 1;}
        if ($this->grid[1][1] == 2 and  $this->grid[1][2] == 2 and  $this->grid[1][3] == 2 and  $this->grid[1][4] == 2){return 2;}
        if ($this->grid[1][2] == 1 and  $this->grid[1][3] == 1 and  $this->grid[1][4] == 1 and  $this->grid[1][5] == 1){return 1;}
        if ($this->grid[1][2] == 2 and  $this->grid[1][3] == 2 and  $this->grid[1][4] == 2 and  $this->grid[1][5] == 2){return 2;}
        if ($this->grid[2][0] == 1 and  $this->grid[2][1] == 1 and  $this->grid[2][2] == 1 and  $this->grid[2][3] == 1){return 1;}
        if ($this->grid[2][0] == 2 and  $this->grid[2][1] == 2 and  $this->grid[2][2] == 2 and  $this->grid[2][3] == 2){return 2;}
        if ($this->grid[2][1] == 1 and  $this->grid[2][2] == 1 and  $this->grid[2][3] == 1 and  $this->grid[2][4] == 1){return 1;}
        if ($this->grid[2][1] == 2 and  $this->grid[2][2] == 2 and  $this->grid[2][3] == 2 and  $this->grid[2][4] == 2){return 2;}
        if ($this->grid[2][2] == 1 and  $this->grid[2][3] == 1 and  $this->grid[2][4] == 1 and  $this->grid[2][5] == 1){return 1;}
        if ($this->grid[2][2] == 2 and  $this->grid[2][3] == 2 and  $this->grid[2][4] == 2 and  $this->grid[2][5] == 2){return 2;}
        if ($this->grid[3][0] == 1 and  $this->grid[3][1] == 1 and  $this->grid[3][2] == 1 and  $this->grid[3][3] == 1){return 1;}
        if ($this->grid[3][0] == 2 and  $this->grid[3][1] == 2 and  $this->grid[3][2] == 2 and  $this->grid[3][3] == 2){return 2;}
        if ($this->grid[3][1] == 1 and  $this->grid[3][2] == 1 and  $this->grid[3][3] == 1 and  $this->grid[3][4] == 1){return 1;}
        if ($this->grid[3][1] == 2 and  $this->grid[3][2] == 2 and  $this->grid[3][3] == 2 and  $this->grid[3][4] == 2){return 2;}
        if ($this->grid[3][2] == 1 and  $this->grid[3][3] == 1 and  $this->grid[3][4] == 1 and  $this->grid[3][5] == 1){return 1;}
        if ($this->grid[3][2] == 2 and  $this->grid[3][3] == 2 and  $this->grid[3][4] == 2 and  $this->grid[3][5] == 2){return 2;}
        if ($this->grid[4][0] == 1 and  $this->grid[4][1] == 1 and  $this->grid[4][2] == 1 and  $this->grid[4][3] == 1){return 1;}
        if ($this->grid[4][0] == 2 and  $this->grid[4][1] == 2 and  $this->grid[4][2] == 2 and  $this->grid[4][3] == 2){return 2;}
        if ($this->grid[4][1] == 1 and  $this->grid[4][2] == 1 and  $this->grid[4][3] == 1 and  $this->grid[4][4] == 1){return 1;}
        if ($this->grid[4][1] == 2 and  $this->grid[4][2] == 2 and  $this->grid[4][3] == 2 and  $this->grid[4][4] == 2){return 2;}
        if ($this->grid[4][2] == 1 and  $this->grid[4][3] == 1 and  $this->grid[4][4] == 1 and  $this->grid[4][5] == 1){return 1;}
        if ($this->grid[4][2] == 2 and  $this->grid[4][3] == 2 and  $this->grid[4][4] == 2 and  $this->grid[4][5] == 2){return 2;}
        if ($this->grid[5][0] == 1 and  $this->grid[5][1] == 1 and  $this->grid[5][2] == 1 and  $this->grid[5][3] == 1){return 1;}
        if ($this->grid[5][0] == 2 and  $this->grid[5][1] == 2 and  $this->grid[5][2] == 2 and  $this->grid[5][3] == 2){return 2;}
        if ($this->grid[5][1] == 1 and  $this->grid[5][2] == 1 and  $this->grid[5][3] == 1 and  $this->grid[5][4] == 1){return 1;}
        if ($this->grid[5][1] == 2 and  $this->grid[5][2] == 2 and  $this->grid[5][3] == 2 and  $this->grid[5][4] == 2){return 2;}
        if ($this->grid[5][2] == 1 and  $this->grid[5][3] == 1 and  $this->grid[5][4] == 1 and  $this->grid[5][5] == 1){return 1;}
        if ($this->grid[5][2] == 2 and  $this->grid[5][3] == 2 and  $this->grid[5][4] == 2 and  $this->grid[5][5] == 2){return 2;}
        if ($this->grid[6][0] == 1 and  $this->grid[6][1] == 1 and  $this->grid[6][2] == 1 and  $this->grid[6][3] == 1){return 1;}
        if ($this->grid[6][0] == 2 and  $this->grid[6][1] == 2 and  $this->grid[6][2] == 2 and  $this->grid[6][3] == 2){return 2;}
        if ($this->grid[6][1] == 1 and  $this->grid[6][2] == 1 and  $this->grid[6][3] == 1 and  $this->grid[6][4] == 1){return 1;}
        if ($this->grid[6][1] == 2 and  $this->grid[6][2] == 2 and  $this->grid[6][3] == 2 and  $this->grid[6][4] == 2){return 2;}
        if ($this->grid[6][2] == 1 and  $this->grid[6][3] == 1 and  $this->grid[6][4] == 1 and  $this->grid[6][5] == 1){return 1;}
        if ($this->grid[6][2] == 2 and  $this->grid[6][3] == 2 and  $this->grid[6][4] == 2 and  $this->grid[6][5] == 2){return 2;}
        if ($this->grid[0][3] == 1 and  $this->grid[1][2] == 1 and  $this->grid[2][1] == 1 and  $this->grid[3][0] == 1){return 1;}
        if ($this->grid[0][3] == 2 and  $this->grid[1][2] == 2 and  $this->grid[2][1] == 2 and  $this->grid[3][0] == 2){return 2;}
        if ($this->grid[3][3] == 1 and  $this->grid[2][2] == 1 and  $this->grid[1][1] == 1 and  $this->grid[0][0] == 1){return 1;}
        if ($this->grid[3][3] == 2 and  $this->grid[2][2] == 2 and  $this->grid[1][1] == 2 and  $this->grid[0][0] == 2){return 2;}
        if ($this->grid[0][4] == 1 and  $this->grid[1][3] == 1 and  $this->grid[2][2] == 1 and  $this->grid[3][1] == 1){return 1;}
        if ($this->grid[0][4] == 2 and  $this->grid[1][3] == 2 and  $this->grid[2][2] == 2 and  $this->grid[3][1] == 2){return 2;}
        if ($this->grid[3][4] == 1 and  $this->grid[2][3] == 1 and  $this->grid[1][2] == 1 and  $this->grid[0][1] == 1){return 1;}
        if ($this->grid[3][4] == 2 and  $this->grid[2][3] == 2 and  $this->grid[1][2] == 2 and  $this->grid[0][1] == 2){return 2;}
        if ($this->grid[0][5] == 1 and  $this->grid[1][4] == 1 and  $this->grid[2][3] == 1 and  $this->grid[3][2] == 1){return 1;}
        if ($this->grid[0][5] == 2 and  $this->grid[1][4] == 2 and  $this->grid[2][3] == 2 and  $this->grid[3][2] == 2){return 2;}
        if ($this->grid[3][5] == 1 and  $this->grid[2][4] == 1 and  $this->grid[1][3] == 1 and  $this->grid[0][2] == 1){return 1;}
        if ($this->grid[3][5] == 2 and  $this->grid[2][4] == 2 and  $this->grid[1][3] == 2 and  $this->grid[0][2] == 2){return 2;}
        if ($this->grid[1][3] == 1 and  $this->grid[2][2] == 1 and  $this->grid[3][1] == 1 and  $this->grid[4][0] == 1){return 1;}
        if ($this->grid[1][3] == 2 and  $this->grid[2][2] == 2 and  $this->grid[3][1] == 2 and  $this->grid[4][0] == 2){return 2;}
        if ($this->grid[4][3] == 1 and  $this->grid[3][2] == 1 and  $this->grid[2][1] == 1 and  $this->grid[1][0] == 1){return 1;}
        if ($this->grid[4][3] == 2 and  $this->grid[3][2] == 2 and  $this->grid[2][1] == 2 and  $this->grid[1][0] == 2){return 2;}
        if ($this->grid[1][4] == 1 and  $this->grid[2][3] == 1 and  $this->grid[3][2] == 1 and  $this->grid[4][1] == 1){return 1;}
        if ($this->grid[1][4] == 2 and  $this->grid[2][3] == 2 and  $this->grid[3][2] == 2 and  $this->grid[4][1] == 2){return 2;}
        if ($this->grid[4][4] == 1 and  $this->grid[3][3] == 1 and  $this->grid[2][2] == 1 and  $this->grid[1][1] == 1){return 1;}
        if ($this->grid[4][4] == 2 and  $this->grid[3][3] == 2 and  $this->grid[2][2] == 2 and  $this->grid[1][1] == 2){return 2;}
        if ($this->grid[1][5] == 1 and  $this->grid[2][4] == 1 and  $this->grid[3][3] == 1 and  $this->grid[4][2] == 1){return 1;}
        if ($this->grid[1][5] == 2 and  $this->grid[2][4] == 2 and  $this->grid[3][3] == 2 and  $this->grid[4][2] == 2){return 2;}
        if ($this->grid[4][5] == 1 and  $this->grid[3][4] == 1 and  $this->grid[2][3] == 1 and  $this->grid[1][2] == 1){return 1;}
        if ($this->grid[4][5] == 2 and  $this->grid[3][4] == 2 and  $this->grid[2][3] == 2 and  $this->grid[1][2] == 2){return 2;}
        if ($this->grid[2][3] == 1 and  $this->grid[3][2] == 1 and  $this->grid[4][1] == 1 and  $this->grid[5][0] == 1){return 1;}
        if ($this->grid[2][3] == 2 and  $this->grid[3][2] == 2 and  $this->grid[4][1] == 2 and  $this->grid[5][0] == 2){return 2;}
        if ($this->grid[5][3] == 1 and  $this->grid[4][2] == 1 and  $this->grid[3][1] == 1 and  $this->grid[2][0] == 1){return 1;}
        if ($this->grid[5][3] == 2 and  $this->grid[4][2] == 2 and  $this->grid[3][1] == 2 and  $this->grid[2][0] == 2){return 2;}
        if ($this->grid[2][4] == 1 and  $this->grid[3][3] == 1 and  $this->grid[4][2] == 1 and  $this->grid[5][1] == 1){return 1;}
        if ($this->grid[2][4] == 2 and  $this->grid[3][3] == 2 and  $this->grid[4][2] == 2 and  $this->grid[5][1] == 2){return 2;}
        if ($this->grid[5][4] == 1 and  $this->grid[4][3] == 1 and  $this->grid[3][2] == 1 and  $this->grid[2][1] == 1){return 1;}
        if ($this->grid[5][4] == 2 and  $this->grid[4][3] == 2 and  $this->grid[3][2] == 2 and  $this->grid[2][1] == 2){return 2;}
        if ($this->grid[2][5] == 1 and  $this->grid[3][4] == 1 and  $this->grid[4][3] == 1 and  $this->grid[5][2] == 1){return 1;}
        if ($this->grid[2][5] == 2 and  $this->grid[3][4] == 2 and  $this->grid[4][3] == 2 and  $this->grid[5][2] == 2){return 2;}
        if ($this->grid[5][5] == 1 and  $this->grid[4][4] == 1 and  $this->grid[3][3] == 1 and  $this->grid[2][2] == 1){return 1;}
        if ($this->grid[5][5] == 2 and  $this->grid[4][4] == 2 and  $this->grid[3][3] == 2 and  $this->grid[2][2] == 2){return 2;}
        if ($this->grid[3][3] == 1 and  $this->grid[4][2] == 1 and  $this->grid[5][1] == 1 and  $this->grid[6][0] == 1){return 1;}
        if ($this->grid[3][3] == 2 and  $this->grid[4][2] == 2 and  $this->grid[5][1] == 2 and  $this->grid[6][0] == 2){return 2;}
        if ($this->grid[6][3] == 1 and  $this->grid[5][2] == 1 and  $this->grid[4][1] == 1 and  $this->grid[3][0] == 1){return 1;}
        if ($this->grid[6][3] == 2 and  $this->grid[5][2] == 2 and  $this->grid[4][1] == 2 and  $this->grid[3][0] == 2){return 2;}
        if ($this->grid[3][4] == 1 and  $this->grid[4][3] == 1 and  $this->grid[5][2] == 1 and  $this->grid[6][1] == 1){return 1;}
        if ($this->grid[3][4] == 2 and  $this->grid[4][3] == 2 and  $this->grid[5][2] == 2 and  $this->grid[6][1] == 2){return 2;}
        if ($this->grid[6][4] == 1 and  $this->grid[5][3] == 1 and  $this->grid[4][2] == 1 and  $this->grid[3][1] == 1){return 1;}
        if ($this->grid[6][4] == 2 and  $this->grid[5][3] == 2 and  $this->grid[4][2] == 2 and  $this->grid[3][1] == 2){return 2;}
        if ($this->grid[3][5] == 1 and  $this->grid[4][4] == 1 and  $this->grid[5][3] == 1 and  $this->grid[6][2] == 1){return 1;}
        if ($this->grid[3][5] == 2 and  $this->grid[4][4] == 2 and  $this->grid[5][3] == 2 and  $this->grid[6][2] == 2){return 2;}
        if ($this->grid[6][5] == 1 and  $this->grid[5][4] == 1 and  $this->grid[4][3] == 1 and  $this->grid[3][2] == 1){return 1;}
        if ($this->grid[6][5] == 2 and  $this->grid[5][4] == 2 and  $this->grid[4][3] == 2 and  $this->grid[3][2] == 2){return 2;}
        return null;
    }
}
