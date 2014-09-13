<?php

namespace Hackathon\Bundle\GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Game
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Hackathon\Bundle\GameBundle\Entity\GameRepository")
 */
class Game
{
    static public $turnLength = 20;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isFinished", type="boolean")
     */
    private $isFinished = false;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="firstTeam", type="integer")
     */
    private $firstTeam;

    /**
     * @var integer
     *
     *
     * @ORM\Column(name="winnerTeam", type="integer")
     */
    private $winnerTeam = -1;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type = "connect4";

    /**
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * The time when the next turn ends.
     * @ORM\Column(type="datetime")
     */
    private $nextTurnEndTime;

    /**
     * @ORM\OneToMany(targetEntity="GameTurn", mappedBy="game")
     * @ORM\OrderBy({"id" = "ASC"})
     */
    private $turns;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="game")
     */
    private $users;

    public function __construct() 
    {
	$this->created = new \DateTime();
	$this->firstTeam = rand(1,2);

	// Start a little bit later
	$this->startNewTurn(2);

	$this->users = new ArrayCollection();
	$this->turns = new ArrayCollection();
    }

    /**
     * Checks if the game already started
     */
    public function isStarted()
    {
	$currentDate = new \DateTime();
	$currentDateTimestamp = $currentDate->getTimestamp();
	$nextRoundEndTimestamp = $this->getNextTurnEndTime()->getTimestamp();

	$difference = $nextRoundEndTimestamp - $currentDateTimestamp;

	// Check if the difference to the next turn length is bigger then 
	// the turn length. If it is like this, we didn't start yet
	return ($difference > self::$turnLength);
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Game
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add a user to the game. 
     *
     * Inverse side will be set.
     */
    public function addUser($user)
    {
	$this->users[] =  $user;
	$user->setGame($this);
    }

    public function getUsers()
    {
	return $this->users->toArray();
    }

    /*
     * Getter for turns
     */
    public function getTurns()
    {
        return $this->turns->toArray();
    }

    /**
     * Creats and adds a turn. 
     *
     * Returns the created turn. You need to persist it.
     */
    public function addTurnWithNumber($column)
    {
	$turn = new GameTurn();
	$turn->setMove($column);
	$this->addTurn($turn);

	return $turn;
    }

    /**
     * Add a turn. 
     *
     * Inverse side will be set.
     */
    public function addTurn($turn)
    {
	$this->turns[] =  $turn;
	$turn->setGame($this);
    }

    public function startNewTurn($times = 1)
    {
	// We update the nextTurnEndTime
	$turnEndTime = new \DateTime();
	$turnEndTime->add(new \DateInterval("PT". (self::$turnLength * $times) ."S"));
	$this->nextTurnEndTime = $turnEndTime;
    }

    /*
     * Setter for nextTurnEndTime
     */
    public function setNextTurnEndTime($nextTurnEndTime)
    {
        $this->nextTurnEndTime = $nextTurnEndTime;
        return $this;
    }
     
    /*
     * Getter for nextTurnEndTime
     */
    public function getNextTurnEndTime()
    {
        return $this->nextTurnEndTime;
    }

    /*
     * Setter for isFinished
     */
    public function setIsFinished($isFinished)
    {
        $this->isFinished = $isFinished;
        return $this;
    }
     
    /*
     * Getter for isFinished
     */
    public function getIsFinished()
    {
        return $this->isFinished;
    }
     
    /*
     * Getter for firstTeam
     */
    public function getFirstTeam()
    {
        return $this->firstTeam;
    }

    /*
     * Setter for winnerTeam
     */
    public function setWinnerTeam($winnerTeam)
    {
        $this->winnerTeam = $winnerTeam;
        return $this;
    }

    /*
     * Getter for winnerTeam
     */
    public function getWinnerTeam()
    {
        return $this->winnerTeam;
    }
    
    

    /*
     * Getter for getCurrentTeam
     */
    public function getCurrentTeam()
    {
        $turns = count($this->getTurns());
        return ($turns+$this->getFirstTeam()) % 2 == 0 ? 2 : 1;
    }

    public function getCurrentOptionSelection()
    {
	$selectedObjects = array(0,0,0,0,0,0,0, 0);
	$turnUserCount = 0;
	foreach ($this->users as $user) {
	    // Only if the user is part of the current team
	    if ($this->getCurrentTeam() == $user->getTeam()) {
		$turnUserCount++;
		$selection = $user->getSelection();
		if ($selection == -1) {
		    $selectedObjects[7] += 1;
		}
		else {
		    $selectedObjects[$selection] += 1;
		}
	    }
	}

	$selectedObjects["turnUserCount"] = $turnUserCount;

	return $selectedObjects;

    }

    /**
     * returns the time in seconds till the next round ends
     */
    public function secondsUntilRoundEnd()
    {
	if ($this->getNextTurnEndTime() == NULL) {
	    return -1;
	}

	$currentDate = new \DateTime();
	$currentDateTimestamp = $currentDate->getTimestamp();
	$nextRoundEndTimestamp = $this->getNextTurnEndTime()->getTimestamp();

	return $nextRoundEndTimestamp - $currentDateTimestamp;
    }

    public function resetUserSelections()
    {
	foreach ($this->users as $user) {
	    $user->setSelection(-1);
	}
    }
}
