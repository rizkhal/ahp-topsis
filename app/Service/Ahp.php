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
     * Evaluation from kali matrix
     *
     * @var array
     */
    private $evaluation = [];

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
     *
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
     * Get the evaluation from kali matrix
     *
     * @return array
     */
    public function getEvaluation(): array
    {
        return $this->evaluation;
    }

    /**
     * Set matrix
     *
     * @param  array $matrix
     * @return self
     */
    public function setMatrix(array $matrix): self
    {
        $temp  = [];
        $eigen = [];
        $bobot = [];
        $size  = count($matrix);
        $eval  = $matrix;

        // temp perkalian matrix
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

            $this->priority[] = $this->round($eigen[$i] /= $size);
        }

        // set null temp
        // perkalian matrix dengan eigen vector
        // untuk cari bobot evaluasi dari matrix
        $temp = [];
        for ($i = 0; $i < $size; $i++) {
            $bobot[$i] = 0;
            for ($j = 0; $j < $size; $j++) {
                $temp[$i][$j] = $eval[$i][$j] * $this->priority[$j];
                $bobot[$i] += $temp[$i][$j];
            }

            $this->evaluation[] = $this->round($bobot[$i]);
        }

        // hitung total dari hasil kali matrix
        for ($j = 0; $j < $size; $j++) {
            $this->total[] = $this->round(array_sum($this->matrix[$j]));
        }

        return $this;
    }

    /**
     * Round up the number type float
     *
     * @param  array|float $numb
     * @return array|float
     */
    private function round($numb, int $n = 2)
    {
        if (is_string($numb)) {
            throw new Exception("Can'nt round type data string.", 1);
        }

        if (is_array($numb)) {
            $result = [];
            for ($i = 0; $i < count($numb); $i++) {
                $result[] = \round($numb[$i], $n);
            }

            return $result;
        }

        return \round($numb, $n);
    }
}
