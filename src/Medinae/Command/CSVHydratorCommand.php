<?php

namespace Medinae\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Csv hydrator command
 *
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
class CSVHydratorCommand extends Command
{
    /**
     * Configure the command
     */
    protected function configure()
    {
        $this
            ->setName('csv-hydrator')
            ->setDescription('Create and hydrate a .csv file with given products data.');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        return $output->writeln('Hi there !');
    }
}

