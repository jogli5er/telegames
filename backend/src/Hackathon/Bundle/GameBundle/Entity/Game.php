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
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="GameTurn", mappedBy="game")
     */
    private $turns;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="game")
     */
    private $users;

    public function __construct() 
    {
	$this->users = new ArrayCollection();
	$this->turns = new ArrayCollection();
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
}
