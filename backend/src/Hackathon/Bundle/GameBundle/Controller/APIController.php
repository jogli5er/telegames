<?php

namespace Hackathon\Bundle\GameBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FF\CommonBundle\Controller\ApiController as Controller;
use Hackathon\Bundle\GameBundle\Entity\User;
use Hackathon\Bundle\GameBundle\GameLogic\ConnectFour;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class APIController extends Controller
{
    /**
     * @Route("game/join")
     * @Method({"GET"})
     */
    public function getTeamsAction()
    {
	$data = array(
	    "teams" => array(
		array(
		    "id" =>  1,
		    "name"=> "x"
		),
		array(
		    "id" =>  2,
		    "name"=> "o"
		),
	    )
	);
	return $this->createObjectResponse($data);
    }

    /**
     * @Route("game/join")
     * @Method({"POST"})
     */
    public function joinAction()
    {
	$request = $this->getRequest();
	$bodyContent = $request->getContent();

	// Get the number and check range
	$teamNumber = intval($bodyContent);
	if ($teamNumber !== 1 && $teamNumber !== 2) {
	    return $this->createErrorResponse("Not a valid team");
	}

	// Add a user to the game
	$user = new User();
	$user->setTeam($teamNumber);

	// Add the user to the current game
	$entityManager = $this->getDoctrine()->getManager();
	$repo = $entityManager->getRepository("HackathonGameBundle:Game");
	$game = $repo->findCurrentGame();
	$game->addUser($user);

	$entityManager = $this->getDoctrine()->getManager();
	$entityManager->persist($user);
	$entityManager->flush();

	$data = array(
	    "id" => $user->getId(),
	    "team" => $user->getTeam(),
	);
	
	return $this->createObjectResponse($data);
    }

    /**
     * @Route("game/move/user/{id}")
     * @ParamConverter("user", class="HackathonGameBundle:User")
     * @Method({"GET"})
     */
    public function getMovesAction( User $user )
    {
	// Get the game of the user
	$game = $user->getGame();

	$data = array("moves" => array());
	if ($game->getCurrentTeam() == $user->getTeam()) {
	    // The user has actions in this round 
	    $data = $this->createMoveData($game);
	}

	// Add isFinished variable
	$data["winnerTeam"] = $game->getWinnerTeam();
	$data["isFinished"] = $game->getIsFinished();
	return $this->createObjectResponse($data);
    }

    /**
     * @Route("game/move/user/{id}")
     * @ParamConverter("user", class="HackathonGameBundle:User")
     * @Method({"POST"})
     */
    public function updateMoveAction(User $user)
    {
	// Return an error if the user is not in the current team
	$entityManager = $this->getDoctrine()->getManager();
	$repo = $entityManager->getRepository("HackathonGameBundle:Game");
	$game = $repo->findCurrentGame();
	if ($game->getCurrentTeam() != $user->getTeam()) {
	    return $this->createErrorResponse(
		"User is not in current team", 
		"You should wait for the next turn"
	    );
	}

	$request = $this->getRequest();
	$bodyContent = $request->getContent();

	// Get the number and check range
	$selectedOption = intval($bodyContent);

	// Set selection and store
	$user->setSelection($selectedOption);
	$entityManager = $this->getDoctrine()->getManager();
	$entityManager->flush();

	// Return the expected data
	return $this->createObjectResponse($this->createMoveData());
    }

    /**
     * Creates the data array of moves. See the README on what is expected
     *
     * If game is not specified, the current game is used
     */
    protected function createMoveData($game = NULL)
    {
	if ($game == NULL) {
	    $entityManager = $this->getDoctrine()->getManager();
	    $repo = $entityManager->getRepository("HackathonGameBundle:Game");
	    $game = $repo->findCurrentGame();
	}

	$gameLogic = new ConnectFour($game);

	$options = $gameLogic->getOptions();

	// Prepare the data
	$formattedOptions = array();
	foreach ($options as $key) {
	    $option = array(
		"id" => $key,
		"name" => "Column " .($key + 1)
	    );
	    $formattedOptions[] = $option;
	}

	// Prepare final objects
	$data = array(
	    "moves" => $formattedOptions
	);

	return $data;
    }
}
