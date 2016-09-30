<?php

namespace Medinae\Model;

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
     * @var float
     *
     * @TODO: use "Money" value object
     */
    protected $price;

    /**
     * Product constructor.
     *
     * @param string $title
     * @param string $description
     * @param int    $price
     */
    public function __construct($title, $description, $price)
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
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string|float
     */
    public function getPrice()
    {
        if (null === $this->price) {
            return 'N\A';
        }

        return round($this->price, 2);
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }
}
