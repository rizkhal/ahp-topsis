<?php

declare (strict_types = 1);

namespace App\Service;

use App\Service\Exception\MatrixException;

class Topsis extends AhpTopsisBase
{
    /**
     * The weight of the matrix
     * @var array
     */
    private $weight;

    /**
     * Result of the normalize matrix
     * @var array
     */
    private $normalize;

    /**
     * Normalize the topsis matrix
     *
     * @return self
     */
    public function normalize(array $matrix): self
    {
        $normalize = [];
        $result    = [];
        $size      = count($matrix);

        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size; $j++) {
                if (isset($matrix[$j][$i])) {
                    $normalize[$i][$j] = pow((int) $matrix[$j][$i], 2);
                }
            }

            $result[$i] = array_sum($normalize[$i]);
        }

        $normalize = [];
        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size; $j++) {
                if (isset($matrix[$j][$i])) {
                    $normalize[$i][$j] = (int) $matrix[$j][$i] / pow((int) $result[$i], 0.5);
                }
            }
        }

        $this->normalize = $normalize;

        return $this;
    }

    /**
     * Calculate weight
     *
     * @param  array  $eigen The weight from AHP method
     * @return self
     */
    public function calculateWieght(array $eigen): self
    {
        if (count($this->normalize) != $size = count($eigen)) {
            throw new MatrixException("The eigen vector from AHP matrix doesnt match with TOPSIS normalize matrix", 1);
        }

        $temp   = [];
        $weight = [];
        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size; $j++) {
                if (array_keys($this->normalize[$i]) == array_keys($eigen)) {
                    $weight[$i][$j] = $this->normalize[$i][$j] * $eigen[$i];
                }
            }
        }

        $this->weight = $weight;

        return $this;
    }

    public function getIdealSolution()
    {
        $max = [];
        $min = [];
        for ($i = 0; $i < $size = count($this->weight); $i++) {
            for ($j = 0; $j < $size; $j++) {
                $max[$i] = max($this->weight[$i]);
                $min[$i] = min($this->weight[$i]);
            }
        }

        return compact('max', 'min');
    }

    public function getDistance()
    {
        $max = $this->getIdealSolution()['max'];
        $min = $this->getIdealSolution()['min'];

        for ($i = 0; $i < $size = count($this->weight); $i++) {
            for ($j = 0; $j < $size; $j++) {
                // --------------------------- wip
            }
        }
        dd($this->getIdealSolution());
    }

    /**
     * Get the normalize result
     *
     * @return array
     */
    public function getNormalize(): array
    {
        return $this->normalize;
    }

    /**
     * Get the weight of the matrix
     *
     * @return array
     */
    public function getWeight(): array
    {
        return $this->weight;
    }
}
