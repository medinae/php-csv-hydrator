<?php

namespace Medinae\Service\DataLoader;

use Medinae\Service\Validator\ValidationHelper;
use Money\Currency;
use Money\Money;
use Medinae\Model\Product;

/**
 * Create Product objects given json
 *
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
class JSONProductLoader implements ProductLoaderInterface
{
    /**
     * {@inheritdoc}
     */
    public function load($jsonData)
    {
        $products = [];
        $arrayData = json_decode($jsonData, true);

        if (!isset($arrayData)) {
            throw new \Exception('Invalid/No provided data');
        }

        foreach ($arrayData as $productData) {
            if (!ValidationHelper::arrayKeysExists($productData, 'title', 'description', 'price')) {
                throw new \Exception('Missing keys : check "title", "description" and "price"');
            }

            $products[] = $this->createProduct(
                $productData['title'],
                $productData['description'],
                $productData['price']
            );
        }

        return $products;
    }

    /**
     * @param string     $title
     * @param string     $description
     * @param Money|null $price
     *
     * @return Product
     */
    protected function createProduct($title, $description, $price)
    {
        return new Product(
            $title,
            $description,
            (isset($price)) ? new Money($price['amount'], new Currency($price['currency'])) : null
        );
    }
}
