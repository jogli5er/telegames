<?php

namespace Hackathon\Bundle\GameBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FF\CommonBundle\Controller\ApiController as Controller;
use Hackathon\Bundle\GameBundle\Entity\User;
use Hackathon\Bundle\GameBundle\GameLogic\ConnectFour;

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
		    "name"=> "Kreuz"
		),
		array(
		    "id" =>  2,
		    "name"=> "Kreis"
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

	$entityManager = $this->getDoctrine()->getManager();
	$entityManager->persist($user);
	$entityManager->flush();

	return $this->createObjectResponse($user);
    }

    /**
     * @Route("game/move")
     * @Method({"GET"})
     */
    public function getMovesAction()
    {
	$entityManager = $this->getDoctrine()->getManager();
	$repo = $entityManager->getRepository("HackathonGameBundle:Game");
	$game = $repo->findCurrentGame();
	$gameLogic = new ConnectFour($game);

	$options = $gameLogic->getOptions();
	return $this->createObjectResponse($options);
    }

}
