<?php

namespace test\Medinae\Service\DataLoader;

use Medinae\Model\Product;
use Medinae\Service\DataLoader\JSONProductLoader;
use Medinae\Service\DataLoader\ProductLoaderInterface;

/**
 * Unit tests for class Medinae\Service\DataLoader\JSONProductLoader
 *
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
class JSONProductLoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var JSONProductLoader
     */
    protected $loader;

    public function setUp()
    {
        $this->loader = new JSONProductLoader();
    }

    /**
     * @test
     */
    public function it_implements_good_interface()
    {
        $this->assertInstanceOf(ProductLoaderInterface::class, $this->loader);
    }

    /**
     * @test
     */
    public function it_loads_valid_products()
    {
        $jsonProducts = <<<BLOC
[
  {
	"title": "Adidas shoes",
	"description": "Some gems have hidden qualities beyond their luster, beyond their shine...",
	"price": null
  },
  {
	"title": "Bata shoes",
	"description": "Some gems have hidden qualities beyond their luster, beyond their shine... Azurite",
	"price": {
		"amount": 35044,
		"currency": "USD"
	}
  },
  {
	"title": "Vans shoes",
	"description": "Some gems have hidden qualities.",
	"price": {
		"amount": 3344,
		"currency": "USD"
	}
  }
]
BLOC;
        $products = $this->loader->load($jsonProducts);

        $this->assertCount(3, $products);

        foreach($products as $product) {
            $this->assertInstanceOf(Product::class, $product);
        }

        $this->assertEquals('N\A', $products->getValue(0)->getPrice());
        $this->assertEquals("Bata shoes", $products->getValue(1)->getTitle());
        $this->assertEquals(33.44, $products->getValue(2)->getPrice());
    }

    /**
     * @test
     * @expectedException \Exception
     * @expectedExceptionMessage Invalid/No provided data
     */
    public function it_handles_no_provided_data_exception()
    {
        $this->loader->load("Hi there !");
    }

    /**
     * @test
     * @expectedException \Exception
     * @expectedExceptionMessage Missing keys : check "title", "description" and "price"
     */
    public function it_handles_missing_keys_exception()
    {
        $jsonProducts = <<<BLOC
[
  {
	"title": "Adidas shoes",
	"description": "Some gems have hidden qualities beyond their luster, beyond their shine..."
  },
  {
	"description": "Some gems have hidden qualities beyond their luster, beyond their shine... Azurite",
	"price": {
		"amount": 35044,
		"currency": "USD"
	}
  },
  {
	"title": "Vans shoes",
	"description": "Some gems have hidden qualities.",
	"price": {
		"amount": 3344,
		"currency": "USD"
	}
  }
]
BLOC;

        $this->loader->load($jsonProducts);
    }
}
