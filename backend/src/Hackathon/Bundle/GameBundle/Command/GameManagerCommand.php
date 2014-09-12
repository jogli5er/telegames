<?php 

namespace Hackathon\Bundle\GameBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class GameNanagerCommand
 * @author Sandro Meier
 */
class GameManagerCommand extends ContainerAwareCommand
{
    protected function configure()
    {
	$this->setName("game:update");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
	// Get the current game
	$entityManager = $this->getContainer()->get('doctrine')->getManager();
	$repo = $entityManager->getRepository("HackathonGameBundle:Game");
	$currentGame = $repo->findCurrentGame();
	
	// Check if the round finished
	$timeTillRoundFinished = $currentGame->secondsUntilRoundEnd();
	if ($timeTillRoundFinished <= 0) {
	    // The round ended! Let's start a new one!
	    $currentGame->startNewTurn();
	    echo "Starting new round";
	}

	$entityManager->flush();
	echo "Ended update\n";
    }
}

