<?php

namespace Hackathon\Bundle\GameBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use FF\CommonBundle\Controller\ApiController as Controller;

class StatisticsController extends Controller
{
    /**
     * @Route("statistics/selectedOptions")
     * @Method({"GET"})
     */
    public function selectedOptionsAction()
    {
	$entityManager = $this->getDoctrine()->getManager();
	$repo = $entityManager->getRepository("HackathonGameBundle:Game");
	$game = $repo->findCurrentGame();

	$data = $game->getCurrentOptionSelection();
	// Add total number of users 
	$userCount = count($game->getUsers());
	$data['userCount'] = $userCount;

        return $this->createObjectResponse($data);
    }

}
