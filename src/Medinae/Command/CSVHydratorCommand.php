<?php

namespace Medinae\Command;

use Medinae\Service\DataLoader\ProductLoaderInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Csv hydrator command
 *
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
class CSVHydratorCommand extends Command
{
    const DEFAULT_FILE_PATH = 'fixtures/products.json';

    /**
     * @var ProductLoaderInterface
     */
    protected $productLoader;

    public function __construct(ProductLoaderInterface $productLoader)
    {
        parent::__construct();

        $this->productLoader = $productLoader;
    }

    /**
     * Configure the command
     */
    protected function configure()
    {
        $this
            ->setName('csv-hydrator')
            ->setDescription('Create and hydrate a .csv file with given products data.')
            ->addArgument('file', InputArgument::OPTIONAL, 'Product file to parse.');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $products = null;
        $productsFilePath = $input->getArgument('file') ? $input->getArgument('file') : self::DEFAULT_FILE_PATH;
        $jsonData = file_get_contents($productsFilePath);

        $io = new SymfonyStyle($input, $output);
        $io->title('CSV Hydrator Command');

        try {
            $products = $this->productLoader->load($jsonData);
        } catch (\Exception $exception){
            $io->error('An error occurred... '.$exception->getMessage());
        }

        if (isset($products)) {
            $io->success(count($products).' products loaded.');
        }
    }
}

