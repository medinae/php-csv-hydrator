<?php

namespace Medinae\Command;

use Medinae\Service\DataLoader\ProductLoaderInterface;
use Medinae\Service\Writer\WriterInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Csv hydrator command
 *
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
class CSVHydratorCommand extends Command
{
    /**
     * @var ProductLoaderInterface
     */
    protected $productLoader;

    /**
     * @var WriterInterface
     */
    protected $writer;

    /**
     * CSVHydratorCommand constructor.
     *
     * @param ProductLoaderInterface $productLoader
     * @param WriterInterface        $writer
     */
    public function __construct(ProductLoaderInterface $productLoader, WriterInterface $writer)
    {
        parent::__construct();

        $this->productLoader = $productLoader;
        $this->writer = $writer;
    }

    /**
     * Configure the command
     */
    protected function configure()
    {
        $this
            ->setName('csv-hydrator')
            ->setDescription('Create and hydrate a .csv file with given products data')
            ->addOption('input', 'i', InputOption::VALUE_OPTIONAL, 'Product file to parse', 'fixtures/products.json')
            ->addOption('output', 'o', InputOption::VALUE_OPTIONAL, '.csv output file name', 'products.csv');
    }

    /**
     * Processed when the command is executed
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return mixed
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $products = null;

        $jsonData = file_get_contents($input->getOption('input'));

        $io = new SymfonyStyle($input, $output);
        $io->title('CSV Hydrator Command');

        try {
            $products = $this->productLoader->load($jsonData);
        } catch (\Exception $exception){
            $io->error('An error occurred when loading data... '.$exception->getMessage());

            return;
        }

        if (!isset($products)) {
            $io->error('No product data to load... ');

            return;
        }

        try {
            $this->writer->write($products, $input->getOption('output'));
        } catch (\Exception $exception){
            $io->error('An error occurred when creating and writing into CSV file... '.$exception->getMessage());

            return;
        }

        $io->success('A .csv file was created and hydrated successfully !');
    }
}

