<?php 

namespace Hackathon\Bundle\GameBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class TestCommand
 * @author John Doe
 */
class TestCommand extends ContainerAwareCommand
{
    protected function configure()
    {
	$this->setName("test");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
	echo "This is a test";
    }
}

