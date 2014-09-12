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

    }
}

