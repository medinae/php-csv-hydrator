<?php

namespace Medinae\Service\Writer;

use Medinae\Model\Writable;

/**
 * Write writable data into CSV file
 *
 * @author AbdElKader Bouadjadja <ak.bouadjadja@gmail.com>
 */
class CsvWriter implements WriterInterface
{
    /**
     * @var int
     */
    protected $counter = 0;

    /**
     * {@inheritdoc}
     */
    public function write(Writable $writable, $fileName)
    {
        if (!(substr($fileName, -1) == '.csv')) {
            $fileName .= '.csv';
        }

        $csv = fopen($fileName, 'w');

        $writableData = $writable->toArray();

        if (0 === $this->counter) {
            fputcsv($csv, array_keys(current($writableData)));
        }

        $this->counter++;

        foreach ($writableData as $item) {
            $values = array_values($item);

            fputcsv($csv, $values);
        }

        fclose($csv);
    }
}
