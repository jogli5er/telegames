<?php

namespace Hackathon\Bundle\GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GameTurn
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Hackathon\Bundle\GameBundle\Entity\GameTurnRepository")
 */
class GameTurn
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
     * @var integer
     *
     * @ORM\Column(name="team", type="integer")
     */
    private $team;

    /**
     * @var integer
     *
     * @ORM\Column(name="move", type="integer")
     */
    private $move;

    /**
     * @ORM\ManyToOne(targetEntity="Game", inversedBy="turns")
     */
    private $game;

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
     * Set team
     *
     * @param integer $team
     * @return GameTurn
     */
    public function setTeam($team)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return integer 
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Set move
     *
     * @param integer $move
     * @return GameTurn
     */
    public function setMove($move)
    {
        $this->move = $move;

        return $this;
    }

    /**
     * Get move
     *
     * @return integer 
     */
    public function getMove()
    {
        return $this->move;
    }
}
