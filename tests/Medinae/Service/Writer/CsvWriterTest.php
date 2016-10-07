<?php

namespace test\Medinae\Service\Writer;

use Medinae\Model\Product;
use Medinae\Model\Products;
use Medinae\Service\Writer\CsvWriter;
use Medinae\Service\Writer\WriterInterface;
use Money\Currency;
use Money\Money;

/**
 * Unit tests for class Medinae\Service\Writer\CsvWriter
 *
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
class CsvWriterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CsvWriter
     */
    protected $writer;

    public function setUp()
    {
        $this->writer = new CsvWriter();
    }

    /**
     * @test
     */
    public function it_implements_good_interface()
    {
        $this->assertInstanceOf(WriterInterface::class, $this->writer);
    }

    /**
     * @test
     */
    public function it_create_and_hydrate_csv_file()
    {
        $products = new Products();

        $products->addProduct(new Product('Iphone 5', 'Another phone'));
        $products->addProduct(new Product('Samsung Galaxy S5', 'Another phone', new Money(10000, new Currency('EUR'))));
        $products->addProduct(new Product('Blackberry 10', 'Really ? It exists ?'));

        $this->writer->write($products, 'test');
    }

}