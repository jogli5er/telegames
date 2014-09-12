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


    public function __construct(Game $game) {
        $this->connectFour = new ConnectFour($game);
        $this->grid = $this->connectFour->grid;
        $this->gridWidth = $this->connectFour->width;
        $this->gridHeight = $this->connectFour->height;

        $this->playerOnTurn = ($game->getCurrentTeam() === 1 ? 'x' : 'o');
        $this->playerOnHold = ($this->playerOnTurn === 'x' ? 'o' : 'x');
    }


    public function getFormat()
    {
        $separator = '    +- -+- -+- -+- -+- -+- -+- -+' . PHP_EOL;

        $str  = PHP_EOL;
        $str .= '          T E L E G A M E' . PHP_EOL;
        $str .= '======================================' . PHP_EOL;
        $str .= '    > Join on www.{IP_OF_SANDRO} <' . PHP_EOL;
        $str .= PHP_EOL;
        $str .= PHP_EOL;
        $str .= PHP_EOL;
        $str .= '      It\'s ' . $this->playerOnTurn . '\'s move (not ' . $this->playerOnHold . '\'s)' . PHP_EOL;
        $str .= PHP_EOL;
        $str .= '      1   2   3   4   5   6   7' . PHP_EOL;
        for ($i = ($this->gridHeight - 1); $i >= 0; $i--) {
            $str .= $separator;
            $str .= '    ';
            for ($j = 0; $j < $this->gridWidth; $j++) {
                $str .= ': ' . $this->getGridValue($this->grid[$j][$i]) . ' ';
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
        return ($val === 1 ? 'x' : 'o');
    }

}
