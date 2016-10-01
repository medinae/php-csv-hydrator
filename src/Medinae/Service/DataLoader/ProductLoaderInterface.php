<?php

namespace Medinae\Service\DataLoader;

use Medinae\Model\Product;

/**
 * Interface ProductLoaderInterface - All Product loader class have to implement it.
 *
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
interface ProductLoaderInterface
{
    /**
     * @param string $jsonData
     *
     * @return Product[]
     */
    public function load($jsonData);
}
