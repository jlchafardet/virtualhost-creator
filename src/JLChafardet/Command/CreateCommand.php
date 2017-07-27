<?php

namespace JLChafardet\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

class CreateCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('create')
            ->setDescription('Create virtualhost files for apache.')
            ->addArgument('domain', InputArgument::REQUIRED, 'Domain name:')
            ->addArgument('folder', InputArgument::OPTIONAL, 'Folder name (optional):')
            ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /**
         * get the input from the user.
         */
        $inputDomain = trim(strtolower($input->getArgument('domain')));
        $inputFolder = trim(strtolower($input->getArgument('folder')));
        /**
         * if the folder value is left empty, uses the domain as name for the folder.
         */
        if (empty($inputFolder))
        {
            $inputFolder = $inputDomain;
        }
        /**
         * Styles used by the output.
         */
        $domain = new OutputFormatterStyle('green',null, array('bold'));
        $folder = new OutputFormatterStyle('yellow', null, array('bold'));

        $output->getFormatter()->setStyle('domain', $domain);
        $output->getFormatter()->setStyle('folder', $folder);
        /**
         * Sends the message to the console.
         */
        $output->writeln("Creating Virtualhost. \nDomain is <domain>$inputDomain</domain>\nIn folder: /var/www/<folder>$inputFolder</folder>");
    }

}