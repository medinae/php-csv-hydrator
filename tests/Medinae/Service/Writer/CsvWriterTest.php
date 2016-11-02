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

        $this->assertTrue(file_exists('test.csv'));

        $csv = fopen('test.csv', 'r');
        $header = fgetcsv($csv);

        $this->assertEquals('title', $header[0]);
        $this->assertEquals('description', $header[1]);
        $this->assertEquals('currency', $header[3]);

        $row1 = fgetcsv($csv);

        $this->assertEquals('Iphone 5', $row1[0]);
        $this->assertEquals('N\A', $row1[3]);

        $row2 = fgetcsv($csv);

        $this->assertEquals('Another phone', $row2[1]);

        fclose($csv);

        unlink('test.csv');
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage "fileName" argument have to be a string
     */
    public function it_throws_an_exception_when_file_name_arg_is_not_a_string()
    {
        $products = new Products();

        $products->addProduct(new Product('Battery Energizer', 'Good product'));
        $products->addProduct(new Product('Battery Alcaline', 'Best product'));

        $this->writer->write($products, 2);
    }
}
