<?php

namespace Hackathon\Bundle\GameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Hackathon\Bundle\GameBundle\Formatter\TeletextFormatter;

class EmulatorController extends Controller
{
    /**
     * @Route("/emulator")
     * @Template()
     */
    public function indexAction()
    {
    	$entityManager = $this->getDoctrine()->getManager();
    	$repo = $entityManager->getRepository("HackathonGameBundle:Game");
    	$game = $repo->findCurrentGame();

        $formatter = new TeletextFormatter($game);
        return array('text' => $formatter->getFormat());
    }

}
