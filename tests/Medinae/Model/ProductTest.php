<?php

namespace test\Medinae\Model;

use Medinae\Model\Product;
use Money\Currency;
use Money\Money;

/**
 * Unit tests for class Medinae\Model\Product
 *
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
class ProductTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider products
     *
     * @param Product $product
     * @param float     $expectedPrice
     */
    public function it_gets_price(Product $product, $expectedPrice)
    {
        $this->assertEquals($expectedPrice, $product->getPrice());
    }

    public function products()
    {
        return [
            [new Product('Macbook', 'Apple product', new Money(482211, new Currency('AED'))), 4822.11],
            [new Product('iPhone 12', 'Apple product'), 'N\A']
        ];
    }
}