<?php

declare (strict_types = 1);

namespace App\Service;

class Topsis
{
    private $matrix;

    /**
     * Normalize the matrix
     *
     * @return array
     */
    public function normalize(array $matrix)
    {
        $temp = [];
        $size = count($matrix);

        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size; $j++) {
                if (isset($matrix[$j][$i])) {
                    $temp[$i][$j] = $matrix[$j][$i] * $matrix[$j][$i];
                }
            }
        }

        die;
    }
}
