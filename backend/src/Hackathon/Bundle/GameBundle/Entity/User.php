<?php

namespace Hackathon\Bundle\GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Hackathon\Bundle\GameBundle\Entity\UserRepository")
 */
class User
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
     * @ORM\Column(name="selection", type="integer")
     */
    private $selection = -1;

    /**
     * @ORM\ManyToOne(targetEntity="Game", inversedBy="users")
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
     * @return User
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
     * Set selection
     *
     * @param integer $selection
     * @return User
     */
    public function setSelection($selection)
    {
        $this->selection = $selection;

        return $this;
    }

    /**
     * Get selection
     *
     * @return integer 
     */
    public function getSelection()
    {
        return $this->selection;
    }

    /*
     * Setter for game
     */
    public function setGame($game)
    {
        $this->game = $game;
        return $this;
    }
    
}
