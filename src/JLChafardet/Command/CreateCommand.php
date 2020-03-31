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
            ->setDescription('Create virtualhost files for Apache/Nginx.')
            ->addArgument('hostname', InputArgument::REQUIRED, 'Hostname:')
            ->addArgument('folder', InputArgument::OPTIONAL, 'Folder name (optional):')
            ->addArgument('framework', InputArgument::OPTIONAL, 'Framework to use(if any, optional):')
            ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /**
         * Lets read the configuration file
         */
        require_once dirname(__DIR__) . "/../../conf/config.inc.php";

        /**
         * get the input from the user.
         */
        $inputHostname = $this->normalize($input->getArgument('hostname'));
        if(!empty($input->getArgument('folder')))
        {
            $inputFolder = $this->normalize($input->getArgument('folder'));
        }
        if(!empty($input->getArgument('framework')))
        {
            $framework = $this->normalize($input->getArgument('framework'));
        }

        /**
         * if the folder value is left empty, uses the domain as name for the folder.
         */
        if (empty($inputFolder))
        {
            $inputFolder = $inputHostname;
        }

        /**
         * Values to use during the runtime of the app.
         */
         $haystack = array (
            'IP' => $ipAddress,
            'PORT' => $port,
            'HOSTNAME' => $inputHostname,
            'ALIAS' => $alias,
            'DOCUMENTROOT' => $documentRoot,
            'FOLDER' => $inputFolder,
            'SERVER' => $webServer,
            'FCGIPORT' => $fcgiPort,
            'OPERATINGSYSTEM' => $operatingSystem
        );

        /**
         * get the template and parse it with its respective values.
         */
        $template = $this->parseTemplate($inputHostname, $documentRoot, $haystack, $this->getTemplate($webServer));

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
                    array(new TableCell($this->getCredits(), array('colspan' => '5'))),
                ))
            ;

        $table->render();
        $output->writeln( PHP_EOL . PHP_EOL . 'Template looks like:' . PHP_EOL . PHP_EOL . '<info>' . $template . '</>');

    }

    protected function getTemplate($webServer)
    {
        switch ($webServer)
        {
            case "Ngnix":
                return file_get_contents(dirname(__DIR__) . '/../../conf/template_nginx');
                break;
            default:
                    return file_get_contents(dirname(__DIR__) . '/../../conf/template_apache_w');
                    #return file_get_contents(dirname(__DIR__) . '/../../conf/template_apache');
                break;
        }
    }

    protected function getCredits()
    {
        return ("<info>Thank you for using virtualhost-creator by <folder>JLChafardet.</></>");
    }

    public function normalize($str)
    {

        return trim(strtolower(preg_replace('/[^a-zA-Z0-9_.]/', '_', $str)));
    }

    public function parseTemplate($inputHostname, $documentRoot, $haystack, $template)
    {
        $needle = array(
            '{IPADDRESS}',
            '{PORT}',
            '{DOMAIN}',
            '{ALIAS}',
            '{DOCUMENTROOT}',
            '{FOLDER}',
            '{SERVER}',
            '{FCGIPORT}'
        );

        return str_replace($needle, $haystack, $this->getTemplate($haystack['SERVER']));
    }

    public function getUserIpAddr(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }


    /**
     * How the template will look like
     * $output->writeln( PHP_EOL . PHP_EOL . 'Template looks like:' . PHP_EOL . PHP_EOL . '<info>' . str_replace($needle, $haystack, $this->getTemplate()) . '</>');
     *
     * unused table outputs. (for future reference only
     *
     * $table->setStyle('borderless');
     * $table->setStyle('compact');
     *
     * This values go just "above" the table render command.
     */
}
