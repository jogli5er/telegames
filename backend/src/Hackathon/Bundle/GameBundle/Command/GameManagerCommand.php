<?php 

namespace Hackathon\Bundle\GameBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Hackathon\Bundle\GameBundle\Entity\GameTurn;
use Hackathon\Bundle\GameBundle\GameLogic\ConnectFour;
use Hackathon\Bundle\GameBundle\Entity\Game;
use Hackathon\Bundle\GameBundle\Formatter\TeletextFormatter;
use Hackathon\Bundle\GameBundle\Communicator\TeletextCommunicator;

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

	    // The round finished. So let's find out on what the crowd decided
	    $userRepo = $entityManager->getRepository("HackathonGameBundle:User");
	    $result = $userRepo->findRoundResult($currentGame);
	    echo "Round result:\n ";
	    var_dump($result);

	    if ($result !== NULL) {
		// Create a new GameTurn object
		$turn = new GameTurn();
		$turn->setMove($result["selection"]);
		$turn->setTeam($currentGame->getCurrentTeam());
		$currentGame->addTurn($turn);
		$entityManager->persist($turn);

		// Reset the user selection
		$currentGame->resetUserSelections();

		$gameLogic = new ConnectFour($currentGame);
		$winnerTeam = $gameLogic->checkWin();
		if ($winnerTeam !== NULL) {
		    // We have a winner
		    // @todo Set the winner
		    $currentGame->setIsFinished(true);

		    // And need to start a new game
		    echo "Starting new Game\n";
		    $newGame = new Game();
		    $entityManager->persist($newGame);
		}
		else {
		    // The round ended! Let's start a new one!
		    $currentGame->startNewTurn();
		    $formatter = new TeletextFormatter($currentGame);
		    $formattedText = $formatter->getFormat();
		    TeletextCommunicator::post($formattedText);
		    echo "Starting new round\n";
		}
	    }
	    else {
		// Users did not select anything...
		$currentGame->startNewTurn();
		echo "No move selected. Repeating turn.";
	    }
	}

	$entityManager->flush();
	echo "Ended update\n";
    }

}
