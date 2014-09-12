<?php

namespace Hackathon\Bundle\GameBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FF\CommonBundle\Controller\ApiController as Controller;

class APIController extends Controller
{
    /**
     * @Route("game/join")
     * @Template()
     */
    public function joinAction()
    {
        return array(
                // ...
	);    
    }

    /**
     * @Route("game/move")
     * @Template()
     */
    public function moveAction()
    {
        return array(
                // ...
	);    
    }

}
