<?php

declare (strict_types = 1);

namespace App\Service;

abstract class AhpTopsisBase
{
    /**
     * The QUANTITATIVE type for ahp method
     */
    const QUANTITATIVE = 0;

    /**
     * The QUALITATIVE type for ahp method
     */
    const QUALITATIVE  = 1;

    /**
     * The random IR for AHP method
     * 
     * @var array
     */
    public static $ir = [
        0.00,
        0.00,
        0.58,
        0.90,
        1.12,
        1.24,
        1.32,
        1.41,
        1.45,
        1.49,
        1.51,
        1.53,
        1.57,
        1.58,
        1.59,
    ];

    /**
     * Get the IR for ahp method
     * 
     * @param  float $matrixSize
     * @return float
     */
    public function getIr(float $matrixSize):  ? float
    {
        return isset(self::$ir[$matrixSize - 1]) ? self::$ir[$matrixSize - 1] : null;
    }

    /**
     * Round up the number type float
     *
     * @param  array|float $numb
     * @return array|float
     */
    public function round($numb, int $n = 2)
    {
        if (is_string($numb)) {
            throw new MatrixException("Can'nt round type data string.", 1);
        }

        if (is_array($numb)) {
            $result = [];
            for ($i = 0; $i < count($numb); $i++) {
                $result[] = round($numb[$i], $n);
            }

            return $result;
        }

        return round($numb, $n);
    }
}
