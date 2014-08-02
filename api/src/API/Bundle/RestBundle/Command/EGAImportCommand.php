<?php

namespace API\Bundle\RestBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use API\Bundle\RestBundle\Entity\Item;

class EGAImportCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('ega:import')
            ->setDescription('Import metadata from CSV')
            ->addArgument(
                'file',
                InputArgument::REQUIRED
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $kernel = $this->getContainer()->get('kernel');
        $path = $kernel->locateResource('@APIRestBundle/Command/'. $input->getArgument('file'));
        $em = $this->getContainer()->get('doctrine')->getManager();

        $items = [];

        $handle = fopen($path, "r");
        while(($array=fgetcsv($handle))!== FALSE){
            $item = new Item();
            $item->setHost('EGA');
            $item->setStudyId($array[0]);
            $item->setStudyTitle($array[1]);
            $item->setStudyDescription($array[2]);
            $item->setDatasetId($array[3]);
            $item->setDatasetTitle($array[4]);
            $item->setDatasetDescription($array[5]);
            $item->setTechnology($array[6]);
            $item->setAccessType('public');
            $items[] = $item;
        }

        foreach ($items as $item){
            $em->persist($item);
        }

        $em->flush();

        fclose($handle);
    }
} 