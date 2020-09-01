<?php

declare (strict_types = 1);

namespace App\Service;

use App\Service\Exception\MatrixException;

class Topsis extends AhpTopsisBase
{
    /**
     * Rank of the matrix
     *
     * @var array
     */
    private $result;

    /**
     * The weight of the matrix
     *
     * @var array
     */
    private $weight;

    /**
     * Result of the normalize matrix
     *
     * @var array
     */
    private $normalize;

    /**
     * The ideal solution
     *
     * @var array
     */
    private $solution;

    /**
     * The distance
     *
     * @var array
     */
    private $distance;

    /**
     * Normalize the topsis matrix
     *
     * @return self
     */
    public function normalize(array $matrix): self
    {
        $normalize = [];
        $result    = [];

        for ($i = 0; $i < $size = count($matrix); $i++) {
            for ($j = 0; $j < $size; $j++) {
                if (isset($matrix[$j][$i])) {
                    $normalize[$i][$j] = pow((int) $matrix[$j][$i], 2);
                }
            }

            $result[$i] = array_sum($normalize[$i]);
        }

        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size; $j++) {
                if (isset($matrix[$j][$i])) {
                    $this->normalize[$i][$j] = (int) $matrix[$j][$i] / pow((int) $result[$i], 0.5);
                }
            }
        }

        return $this;
    }

    /**
     * Calculate weight
     *
     * @param  array  $eigen The weight from AHP method
     * @return self
     */
    public function calculate(array $eigen): self
    {
        // validate the given eigen and normalize matrix
        if (count($this->normalize) != $size = count($eigen)) {
            throw new MatrixException("The eigen vector from AHP matrix doesnt match with TOPSIS normalize matrix", 1);
        }

        // calculate the weight
        // eigen matrix passing from AHP method
        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size; $j++) {
                if (array_keys($this->normalize[$i]) == array_keys($eigen)) {
                    $weight[$i][$j] = $this->normalize[$i][$j] * $eigen[$i];
                }

                $smax[$i] = max($weight[$i]);
                $smin[$i] = min($weight[$i]);
            }
        }

        $this->solution = [
            'plus'  => $smax,
            'minus' => $smin,
        ];

        // calculate the distance
        // the `$smax` and `$smin` is ideal solution plus and min
        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size; $j++) {
                $dmax[$i][$j] = pow($weight[$i][$j] - $smax[$i], 2);
                $dmin[$i][$j] = pow($weight[$i][$j] - $smin[$i], 2);
            }

            $dmax[$i] = sqrt(array_sum($dmax[$i]));
            $dmin[$i] = sqrt(array_sum($dmin[$i]));
        }

        $this->distance = [
            'plus'  => $dmax,
            'minus' => $dmin,
        ];

        // calculate the result of the matrix
        // need revision 3(-_-)3
        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size; $j++) {
                $dmax[$i] += pow($smax[$i] - $weight[$i][$j], 2);
                $dmin[$i] += pow($smin[$i] - $weight[$j][$i], 2);
            }

            $dmaxnormalize[$i] = sqrt($dmax[$i]);
            $dminnormalize[$i] = sqrt($dmin[$i]);

            $this->result[$i] = $dminnormalize[$i] / $dmaxnormalize[$i] + $dminnormalize[$i];
        }

        return $this;
    }

    /**
     * Get the result from matrix
     *
     * @return array
     */
    public function getResult(): array
    {
        return [
            'normalize' => $this->normalize,
            'solution'  => $this->solution,
            'distance'  => $this->distance,
            'result'    => $this->result,
        ];
    }
}
