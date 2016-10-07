<?php

namespace test\Medinae\Model;

use Medinae\Model\Product;
use Medinae\Model\Products;
use Money\Currency;
use Money\Money;

/**
 * Unit tests for class Medinae\Model\Products
 *
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
class ProductsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_converts_products_to_array()
    {
        $products = new Products();

        $products->addProduct(new Product('PS4 Sony', 'Amazing video game'));
        $products->addProduct(new Product('XBOX', 'Bad video game', new Money(3333, new Currency('AED'))));
        $products->addProduct(new Product('GameBoy Color', 'Old video game'));

        $productsData = $products->toArray();

        $this->assertCount(3, $productsData);
        $this->assertEquals('PS4 Sony', $productsData[0]['title']);
        $this->assertEquals('AED', $productsData[1]['currency']);
        $this->assertEquals('Old video game', $productsData[2]['description']);
    }

}