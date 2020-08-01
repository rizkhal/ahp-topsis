<?php

declare (strict_types = 1);

namespace App\Service;

class Ahp extends AhpBase
{
    /**
     * Criteria of the matrix
     *
     * @var array
     */
    private $criteria = [];

    /**
     * Matrix of the criteria and candidate
     *
     * @var array
     */
    private $matrix = [];

    /**
     * Eigen Vector of the matrix
     *
     * @var array
     */
    private $priority = [];

    /**
     * Total of the matrix
     *
     * @var array
     */
    private $total = [];

    /**
     * Get array of the matrix
     *
     * @return array
     */
    public function getMatrix(): array
    {
        return $this->matrix;
    }

    /**
     * Get the total of the matrix
     * @return array
     */
    public function getTotal(): array
    {
        return $this->total;
    }

    /**
     * Get the eigen | priority
     * 
     * @return array
     */
    public function getPriority(): array
    {
        return $this->priority;
    }

    /**
     * Set matrix
     *
     * @param  array $matrix
     * @return self
     */
    public function setMatrix(array $matrix): self
    {
        /** @var $tmp nampung variable sementara */
        $temp = [];

        /** @var $eigen nampung eigen | prioritas */
        $eigen = [];

        /** @var $size total matrix nya */
        $size = count($matrix);

        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size; $j++) {
                if (!isset($temp[$j])) {
                    $temp[$j] = 0;
                }

                $temp[$j] += $matrix[$i][$j];
            }
        }

        // hitung eigen | prioritas
        for ($i = 0; $i < $size; $i++) {
            $eigen[$i] = 0;
            for ($j = 0; $j < $size; $j++) {
                $matrix[$i][$j] /= $temp[$j];
                $eigen[$i] += $matrix[$i][$j];

                $this->matrix[$i][$j] = $this->round($matrix[$i][$j]);
            }

            $this->priority[$i] = $this->round($eigen[$i] /= $size);
        }

        // ambil total dari hasil kali matrix
        // dengan cara menambahkan setiap baris hasil kali matrix
        for ($j = 0; $j < count($this->matrix); $j++) {
            $this->total[] = $this->round(array_sum($this->matrix[$j]));
        }

        return $this;
    }

    public function calculateMatrix()
    {
        //
    }

    /**
     * Round up the number type float
     *
     * @param  float  $float
     * @return float
     */
    private function round(float $float, int $n = 4): float
    {
        return \round($float, $n);
    }
}
