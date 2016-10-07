<?php

namespace Medinae\Service\Writer;

use Medinae\Model\Writable;

interface WriterInterface
{
    /**
     * Create and hydrate a csv file
     *
     * @param Writable $writable
     * @param string   $fileName
     *
     * @return mixed
     */
    public function write(Writable $writable, $fileName);
}