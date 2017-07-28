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
            ->addArgument('hostname', InputArgument::REQUIRED, 'Hostname:')
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
        $this->timer();
        $ru = getrusage();

        /**
         * Lets read the configuration file
         */
        require_once dirname(__DIR__) . "/../../conf/config.inc.php";

        /**
         * get the input from the user.
         */
        $inputHostname = $this->normalize($input->getArgument('hostname'));
        $inputFolder = $this->normalize($input->getArgument('folder'));

        /**
         * if the folder value is left empty, uses the domain as name for the folder.
         */
        if (empty($inputFolder))
        {
            $inputFolder = $inputHostname;
        }

        /**
         * Logic goes here!
         *
         */
        $haystack = array (
            $ipAddress,
            $port,
            $inputHostname,
            $alias,
            $documentRoot,
            $inputFolder
        );
        $template = $this->parseTemplate($inputHostname, $documentRoot, $haystack, $this->getTemplate());

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
        $table
            ->setHeaders(
                array(
                    array(new TableCell('Results', array('colspan' => 5))),
                    array(
                    '<info>IP Address</>',
                    '<info>Port</>',
                    '<info>Hostname</>',
                    '<info>Folder</>',
                    '<info>Status</>')))
            ->setRows(
                array(
                    [
                        '<domain>'.$ipAddress.'</>',
                        '<domain>'.$port.'</>',
                        '<domain>'.$inputHostname.'</>',
                        '<folder>'.$documentRoot.'/'.$inputFolder.'</folder>',
                        "<domain>OK</>/<warning>ERROR</warning>"
                    ],
                    new TableSeparator(),
                    array(new TableCell('<info>Process completed in <warning>' . runtime($ru, $rs, "utime").'</> ms</>', array('colspan' => '5'))),
                    array(new TableCell($this->getCredits(), array('colspan' => '5'))),
                ))
            ;

        $table->render();

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
     * How the template will look like
     * $output->writeln('Template looks like:' . PHP_EOL . PHP_EOL . '<info>' . str_replace($needle, $haystack, $this->getTemplate()) . '</>');
     *
     * unused table outputs. (for future reference only
     *
     * $table->setStyle('borderless');
     * $table->setStyle('compact');
     *
     * This values go just "above" the table render command.
     */
    public function timer ()
    {
        function runtime($ru, $rus, $index) {
            return ($ru["ru_$index.tv_sec"]*1000 + intval($ru["ru_$index.tv_usec"]/1000))
                -  ($rus["ru_$index.tv_sec"]*1000 + intval($rus["ru_$index.tv_usec"]/1000));
        }
    }

    public function normalize($str)
    {

        return trim(strtolower(preg_replace('/[^a-zA-Z0-9_.]/', '_', $str)));
    }

    public function parseTemplate($inputHostname, $documentRoot, $haystack, $template)
    {
        /**
         * Lets read the configuration file
         */
        require_once dirname(__DIR__) . "/../../conf/config.inc.php";
        $needle = array(
            '{IPADDRESS}',
            '{PORT}',
            '{DOMAIN}',
            '{ALIAS}',
            '{DOCUMENTROOT}',
            '{FOLDER}'
        );

        return str_replace($needle, $haystack, $this->getTemplate());
    }

}