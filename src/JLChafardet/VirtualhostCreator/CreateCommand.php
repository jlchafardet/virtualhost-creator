<?php

namespace JLChafardet\VirtualhostCreator;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('Virtualhost Creator')
            ->setDescription('Create virtualhost files for apache.')
            ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Creating Virtualhost. ');
    }

}