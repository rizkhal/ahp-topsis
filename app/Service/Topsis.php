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
    private $rank;

    /**
     * Solution ideal from the matrix
     *
     * @var array
     */
    private $solution;

    /**
     * Plus ideal solution
     *
     * @var array
     */
    private $smax;

    /**
     * Minus ideal solution
     *
     * @var array
     */
    private $smin;

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
     * Distance from the matrix
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
    public function calculateWeight(array $eigen): self
    {
        if (count($this->normalize) != $size = count($eigen)) {
            throw new MatrixException("The eigen vector from AHP matrix doesnt match with TOPSIS normalize matrix", 1);
        }

        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size; $j++) {
                if (array_keys($this->normalize[$i]) == array_keys($eigen)) {
                    $this->weight[$i][$j] = $this->normalize[$i][$j] * $eigen[$i];
                }
            }
        }

        return $this;
    }

    /**
     * Get the ideal solution
     *
     * @return self
     */
    public function calculateIdealSolution(): self
    {
        for ($i = 0; $i < $size = count($this->weight); $i++) {
            for ($j = 0; $j < $size; $j++) {
                $this->smax[$i] = max($this->weight[$i]);
                $this->smin[$i] = min($this->weight[$i]);
            }
        }

        $this->solution = [
            'smax' => $this->smax,
            'smin' => $this->smin,
        ];

        return $this;
    }

    /**
     * Calculate distance from the given matrix
     *
     * @return self
     */
    public function calculateDistance(): self
    {
        for ($i = 0; $i < $size = count($this->weight); $i++) {
            for ($j = 0; $j < $size; $j++) {
                $dmax1[$i][$j] = pow($this->weight[$i][$j] - $this->smax[$i], 2);
                $dmin1[$i][$j] = pow($this->weight[$i][$j] - $this->smin[$i], 2);
            }

            $dmax[$i] = sqrt(array_sum($dmax1[$i]));
            $dmin[$i] = sqrt(array_sum($dmin1[$i]));
        }

        $this->distance = [
            'dmax' => $dmax,
            'dmin' => $dmin,
        ];

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
            'weight'    => $this->weight,
            'solution'  => $this->solution,
            'distance'  => $this->distance,
            'ranks'     => $this->rank,
        ];
    }
}
