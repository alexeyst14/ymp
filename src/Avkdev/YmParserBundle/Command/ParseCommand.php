<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 29.08.14
 * Time: 20:04
 */

namespace Avkdev\YmParserBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ParseCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('ymparser:run')
            ->setDescription('Yandex Market Parser');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $parser = $this->getContainer()->get('avkdev_ym_parser.ymparser');
        $parser->setOutput($output);
        $parser->run();
    }


}
