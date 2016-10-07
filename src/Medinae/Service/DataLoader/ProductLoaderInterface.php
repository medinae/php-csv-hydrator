<?php

namespace Medinae\Service\DataLoader;

use Medinae\Model\Writable;

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
     * @return Writable
     */
    public function load($jsonData);
}
