<?php

namespace Medinae\Model;

/**
 * Responsible to collect products
 *
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
class Products implements \Countable, \Iterator, Writable
{
    /**
     * @var Product[]
     */
    protected $products = [];

    /**
     * Get a product
     *
     * @param $key
     *
     * @return Product
     */
    public function getValue($key)
    {
        return $this->products[$key];
    }

    /**
     * Add a product
     *
     * @param Product $product
     */
    public function addProduct(Product $product)
    {
        $this->products[] = $product;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        $result = [];

        if (!$this->hasProducts()) {
            return $result;
        }

        foreach ($this->products as $product) {
            $productData = [];

            $price = $product->getPrice();

            $productData['title'] = $product->getTitle();
            $productData['description'] = $product->getDescription();
            $productData['price'] = $price;
            $productData['currency'] = (is_numeric($price)) ? $product->getCurrency()->getName() : 'N\A';

            $result[] = $productData;
        }

        return $result;
    }

    /**
     * Check if it has products
     *
     * @return bool
     */
    public function hasProducts()
    {
        return 0 < count($this->products);
    }

    /**
     * Count the available products
     *
     * @return int
     */
    public function count()
    {
        return count($this->products);
    }

    /**
     * {@inheritDoc}
     */
    public function current()
    {
        return current($this->products);
    }

    /**
     * {@inheritDoc}
     */
    public function key()
    {
        return key($product);
    }

    /**
     * {@inheritDoc}
     */
    public function next()
    {
        return next($this->products);
    }

    /**
     * {@inheritDoc}
     */
    public function rewind()
    {
        return reset($this->products);
    }

    /**
     * {@inheritDoc}
     */
    public function valid()
    {
        $key = key($this->products);

        return (null !=$key && $key !== false);
    }
}