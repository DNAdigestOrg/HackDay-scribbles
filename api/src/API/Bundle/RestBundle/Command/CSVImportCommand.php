<?php

namespace API\Bundle\RestBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CSVImportCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('csv:import')
            ->setDescription('Import metadata from CSV')
            ->addArgument(
                'file',
                InputArgument::REQUIRED
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $kernel = $this->getContainer()->get('kernel');
        $path = $kernel->locateResource('@APIRestBundle/Command/EGA.csv');

        $handle = fopen($path, "r");
        while(($array=fgetcsv($handle))!== FALSE){
            echo print_r($array);
        }
        fclose($handle);
    }
} 