<?php

namespace jlchafardet\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

class BatchProcessCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('batch:process')
            ->addArgument('type', InputArgument::REQUIRED, 'The type of items to process')
            ->addOption('no-cleanup', null, InputOption::VALUE_NONE)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>I am going to do something very useful</info>');
    }
}