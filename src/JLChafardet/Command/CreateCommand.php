<?php

namespace JLChafardet\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableCell;
use Symfony\Component\Console\Helper\TableSeparator;
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
         * Start measuring running time
         *
         */
        $rs = getrusage();
        function runtime($ru, $rus, $index) {
            return ($ru["ru_$index.tv_sec"]*1000 + intval($ru["ru_$index.tv_usec"]/1000))
                -  ($rus["ru_$index.tv_sec"]*1000 + intval($rus["ru_$index.tv_usec"]/1000));
        }

        /**
         * Lets read the configuration file
         */
        require dirname(__DIR__) . "/../../conf/config.inc.php";

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
         * Logic goes here! sucky single function crap for now.
         */

        /**
         * Styles used by the output.
         */
        $domain = new OutputFormatterStyle('green',null, array('bold'));
        $folder = new OutputFormatterStyle('yellow', null, array('bold'));
        $warning = new OutputFormatterStyle('red',null, array('bold','blink'));
        $bold = new OutputFormatterStyle(null, null, array('bold'));

        $output->getFormatter()->setStyle('domain', $domain);
        $output->getFormatter()->setStyle('folder', $folder);
        $output->getFormatter()->setStyle('warning', $warning);
        $output->getFormatter()->setStyle('bold', $bold);

        /**
         * Now lets try a table and decide which is better
         */
        $table = new Table($output);
        $ru = getrusage();
        $table
            ->setHeaders(
                array(
                    array(new TableCell('Results', array('colspan' => 5))),
                    array(
                    '<info>IP Address</>',
                    '<info>Port</>',
                    '<info>Domain</>',
                    '<info>Folder</>',
                    '<info>Status</>')))
            ->setRows(
                array(
                    [
                        '<domain>'.$ipAddress.'</>',
                        '<domain>'.$port.'</>',
                        '<domain>'.$inputDomain.'</>',
                        '<folder>'.$documentRoot.'/'.$inputFolder.'</folder>',
                        "<domain>OK</>/<warning>ERROR</warning>"
                    ],
                    new TableSeparator(),
                    array(new TableCell('<info>Process completed in <warning>' . runtime($ru, $rs, "utime").'</> ms</>', array('colspan' => '5'))),
                    array(new TableCell($this->getCredits(), array('colspan' => '5'))),
                ))
            ;

        $table->render();
        $output->writeln(PHP_EOL);
        $needle = array(
            '{IPADDRESS}',
            '{PORT}',
            '{DOMAIN}',
            '{ALIAS}',
            '{DOCUMENTROOT}',
            '{FOLDER}'
        );
        $haystack = array (
            $ipAddress,
            $port,
            $inputDomain,
            $alias,
            $documentRoot,
            $inputFolder
        );
        //$output->writeln('Template looks like:' . PHP_EOL . PHP_EOL . '<info>' . str_replace($needle, $haystack, $this->getTemplate()) . '</>');

    }

    protected function getTemplate()
    {
        return file_get_contents(dirname(__DIR__) . '/../../conf/template.conf');
    }

    protected function getCredits()
    {
        return ("<info>Thank you for using virtualhost-creator by <folder>JLChafardet.</></>");
    }

    /**
     * unused table outputs. (for future reference only
     *
     * $table->setStyle('borderless');
     * $table->setStyle('compact');
     *
     * This values go just "above" the table render command.
     */

}