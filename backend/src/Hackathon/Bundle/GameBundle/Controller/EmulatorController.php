<?php

namespace Hackathon\Bundle\GameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class EmulatorController extends Controller
{
    /**
     * @Route("/emulator")
     * @Template()
     */
    public function indexAction()
    {
        return array(
                // ...
	);  
    }

}
