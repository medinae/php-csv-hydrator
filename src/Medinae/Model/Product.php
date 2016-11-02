<?php

namespace Medinae\Model;

use Money\Money;

/**
 * Product Model class
 *
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
class Product
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var Money
     */
    protected $price;

    /**
     * Product constructor.
     *
     * @param string $title
     * @param string $description
     * @param Money  $price
     */
    public function __construct($title, $description, Money $price = null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string|float
     */
    public function getPrice()
    {
        if (null === $this->price) {
            return 'N\A';
        }

        return round($this->price->getAmount() / 100, 2);
    }

    public function getCurrency()
    {
        if (null === $this->price) {
            return 'N\A';
        }

        return $this->price->getCurrency();
    }
}
