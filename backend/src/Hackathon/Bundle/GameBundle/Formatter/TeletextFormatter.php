<?php

namespace Hackathon\Bundle\GameBundle\Formatter;

use Hackathon\Bundle\GameBundle\Entity\Game;
use Hackathon\Bundle\GameBundle\GameLogic\ConnectFour;

class TeletextFormatter
{

    private $connectFour;
    private $grid = array();
    private $gridWidth = array();
    private $gridHeight = array();
    private $playerOnTurn = false;
    private $playerOnHold = false;
    private $lastMove = false;
    private $lastMoveIsDrawn = false;
    private $winnerTeam = false;
    private $teamNames = array(1 => 'x', 2 => 'o');


    public function __construct(Game $game) {
        $this->connectFour = new ConnectFour($game);
        $this->grid = $this->connectFour->grid;
        $this->gridWidth = $this->connectFour->width;
        $this->gridHeight = $this->connectFour->height;

        $this->playerOnTurn = ($game->getCurrentTeam() === 1 ? $this->teamNames[1] : $this->teamNames[2]);
        $this->playerOnHold = ($this->playerOnTurn === $this->teamNames[1] ? $this->teamNames[2] : $this->teamNames[1]);

        $turns = $game->getTurns();
        if (count($turns)) {
            $lastTurn = $turns[count($turns) - 1];
            $this->lastMove = $lastTurn->getMove();
        }


        if ($game->getIsFinished()) {
            $this->winnerTeam = $game->getWinnerTeam();
        }

    }


    public function getFormat()
    {
        $separator = '    +- -+- -+- -+- -+- -+- -+- -+' . PHP_EOL;

        $str  = PHP_EOL;
        $str .= '          T E L E G A M E' . PHP_EOL;
        $str .= '======================================' . PHP_EOL;
        $str .= '    > Join on http://10.201.3.43 <' . PHP_EOL;
        if ($this->winnerTeam) {
            $str .= PHP_EOL;
            $str .= '              * * *' . PHP_EOL;
            $str .= '         WE HAVE A WINNER: ' . $this->teamNames[$this->winnerTeam] . PHP_EOL;
            $str .= '    C O N G R A T U L A T I O N S !' . PHP_EOL;
            $str .= '              * * *' . PHP_EOL;
            $str .= PHP_EOL;
            $str .= PHP_EOL;
        } else {
            $str .= PHP_EOL;
            $str .= PHP_EOL;
            $str .= PHP_EOL;
            $str .= '      It\'s ' . $this->playerOnTurn . '\'s move (not ' . $this->playerOnHold . '\'s)' . PHP_EOL;
            $str .= PHP_EOL;
        }
        if ($this->lastMove) {

        }

        $str .= '    ';
        for ($i = 1; $i <=7; $i++) {
            if ($this->lastMove !== false && $i === ($this->lastMove + 1)) {
                $str .= ' *' . $i . '*';
            } else {
                $str .= '  ' . $i . ' ';
            }
        }
        $str .= PHP_EOL;

        for ($i = ($this->gridHeight - 1); $i >= 0; $i--) {

            $str .= $separator;
            $str .= '    ';

            for ($j = 0; $j < $this->gridWidth; $j++) {

                $isLastMove = false;
                if (!$this->lastMoveIsDrawn && $j === $this->lastMove) {
                    if ($this->grid[$j][$i] != 0) {
                        $isLastMove = true;
                        $this->lastMoveIsDrawn = true;
                    }
                }

                if ($isLastMove) {
                    $str .= ':*' . $this->getGridValue($this->grid[$j][$i]) . '*';
                } else {
                    $str .= ': ' . $this->getGridValue($this->grid[$j][$i]) . ' ';
                }

            }
            $str .= ':' . PHP_EOL;
        }
        $str .= '    +---+---+---+---+---+---+---+';
        return $str;
    }


    private function getGridValue($val)
    {
        if ($val === 0) {
            return ' ';
        }
        return ($val === 1 ? $this->teamNames[1] : $this->teamNames[2]);
    }

}
