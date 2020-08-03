<?php

declare (strict_types = 1);

namespace App\Service;

use App\Service\Exception\MatrixException;

class Ahp extends AhpBase
{
    /**
     * Criteria of the matrix
     *
     * @var array
     */
    private $criteria = [];

    /**
     * Set alternatif of the matrix
     *
     * @var array
     */
    private $alternative = [];

    /**
     * Matrix of the criteria and candidate
     *
     * @var array
     */
    private $relativeMatrix = [];

    /**
     * Criteria pairwise
     *
     * @var array
     */
    private $criteriaPairWise = [];

    /**
     * The eigen from matrix criteria
     *
     * @var array
     */
    private $eigenVector = [];

    /**
     * Final of the ranks
     * 
     * @var array
     */
    private $finalRanks = [];

    /**
     * Final of the matrix
     * 
     * @var array
     */
    private $finalMatrix = [];

    /**
     * Set the criteria matrix
     *
     * @param  array $criteria
     * @return self
     */
    public function setCriteria(array $criteria): self
    {
        foreach ($criteria as $i => $c) {
            $this->criteria[] = [
                'name' => $c['name'],
                'type' => $c['type'] == false ? self::QUANTITATIVE : self::QUALITATIVE,
            ];
        }

        return $this;
    }

    /**
     * Set matrix
     *
     * @param  array $matrix
     * @return self
     */
    public function setMatrix(array $matrix): self
    {
        $size = count($this->criteria);
        if ($size != count($matrix)) {
            throw new MatrixException("Matrix size should be $size * $size");
        }

        foreach ($matrix as $i => $m) {
            if ($size != count($m)) {
                throw new MatrixException("Matrix size should be $size * $size");
            }

            for ($j = 0; $j < count($m); $j++) {
                if ($i == $j) {
                    if ($matrix[$i][$j] != 1) {
                        throw new MatrixException('Matrix diagonal should have value : 1');
                    }
                }
            }
        }

        $do = $this->normalizeEigenAndMatrix($matrix);

        $this->eigenVector = $do['eigen'];

        $this->relativeMatrix = [
            'matrix' => $do['matrix'],
            'eigen'  => $do['eigen'],
            'total'  => $do['total'],
        ];

        return $this;
    }

    /**
     * Set batch of the pair wise
     *
     * @param  string $name
     * @param  array  $matrix
     * @return self
     */
    public function setBatchCriteriaPairWise(array $matrix): self
    {
        $this->criteriaPairWise = [];
        foreach ($matrix as $i => $m) {
            $this->setCriteriaPairWise($i, $m);
        }

        return $this;
    }

    /**
     * Set the pair wise
     *
     * @param  string $name
     * @param  array  $matrix
     * @return object
     */
    public function setCriteriaPairWise(string $name, array $matrix): object
    {
        $key = array_search($name, array_column($this->criteria, 'name'));

        if (!is_numeric($key)) {
            throw new MatrixException("The criteria $name was not found!", 1);
        }

        if ($this->criteria[$key]['type'] == self::QUALITATIVE) {
            return $this->setQualitative($name, $matrix);
        }

        return $this->setQuantitative($name, $matrix);
    }

    /**
     * Set quantitative
     *
     * @param  string $name
     * @param  array  $matrix
     * @return self
     */
    private function setQuantitative(string $name, array $matrix): self
    {
        if (count($matrix) != $size = count($this->alternative)) {
            throw new MatrixException("Quantitative Pairwise should have matrix sized $size * $size");
        }

        // NEED REVISION +(*_*)+
        // ----------------------------------------------->
        $eigen = $this->normalizeEigenAndMatrix($matrix);

        $this->criteriaPairWise[$name]['matrix'] = $matrix;
        $this->criteriaPairWise[$name]['eigen']  = $eigen['eigen'];
        // ----------------------------------------------->

        return $this;
    }

    /**
     * Set the qualitative type
     *
     * @param string $name
     * @param array  $matrix
     * @return self
     */
    private function setQualitative(string $name, array $matrix): self
    {
        $size = count($this->alternative);

        if ($size != count($matrix)) {
            throw new MatrixException('matrix size should be ' . $size . "x" . $size);
        }

        foreach ($matrix as $i => $m) {
            if ($size != count($m)) {
                throw new MatrixException('matrix size should be ' . $size . "x" . $size);
            }

            for ($j = 0; $j < count($m); $j++) {
                if ($i == $j) {
                    if ($matrix[$i][$j] != 1) {
                        throw new MatrixException('matrix diagonal should have value : 1');
                    }
                }
            }
        }

        $this->criteriaPairWise[$name]       = $this->normalizeEigenAndMatrix($matrix);
        $this->criteriaPairWise[$name]['cr'] = $this->concistencyCheck($matrix, $this->criteriaPairWise[$name]['eigen']);

        return $this;
    }

    /**
     * Set the alternative
     *
     * @param  array $alternative
     * @return self
     */
    public function setAlternative(array $alternative): self
    {
        $this->alternative = $alternative;

        return $this;
    }

    /**
     * Normalize matrix
     *
     * @param  array $matrix
     * @return array
     */
    private function normalizeEigenAndMatrix(array $matrix): array
    {
        $temp = [];
        $size = count($matrix);

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
        $eigen = [];
        for ($i = 0; $i < $size; $i++) {
            $eigen[$i] = 0;
            for ($j = 0; $j < $size; $j++) {
                $matrix[$i][$j] /= $temp[$j];
                $eigen[$i] += $matrix[$i][$j];

                $matrix[$i][$j] = $this->round($matrix[$i][$j]);
            }

            $eigen[$i] = $this->round($eigen[$i] /= $size);
        }

        $temp = [];
        for ($i = 0; $i < $size; $i++) {
            $total[$i] = 0;
            for ($j = 0; $j < $size; $j++) {
                $total[$i] += $this->round($matrix[$j][$j], 1);
            }
        }

        return [
            "matrix" => $matrix,
            "eigen"  => $eigen,
            "total"  => $total,
        ];
    }

    /**
     * Check the consistency
     *
     * @param  array  $matrix
     * @param  array  $eigen
     * @return float
     */
    private function concistencyCheck(array $matrix, array $eigen): float
    {
        $dmax = 0;
        $size = count($matrix);
        for ($i = 0; $i < $size; $i++) {
            $e = 0;
            for ($j = 0; $j < $size; $j++) {
                $e += $matrix[$j][$i];
            }
            $dmax += $e * $eigen[$i];

        }
        $ci = ($dmax - $size) / ($size - 1);

        $cr = $this->round($ci / $this->getIR($size), 1);

        return $cr;
    }

    /**
     * Finalizing the matrix and get result
     * 
     * @return self
     */
    public function finalize(): self
    {
        if (count($this->criteriaPairWise) != count($this->criteria)) {
            throw new \ErrorException('Error');
        }

        $m1    = [];
        $ranks = [];
        for ($i = 0; $i < count($this->alternative); $i++) {
            $m1[$i] = [];
            $j      = 0;
            $r      = ['name' => $this->alternative[$i], 'value' => 0];
            foreach ($this->criteriaPairWise as $key => $criteriaPairWise) {
                $m1[$i][$j] = $criteriaPairWise['eigen'][$i];
                $r['value'] += $m1[$i][$j] * $this->eigenVector[$j];
                $j++;
            }
            $ranks[] = $r;
        }

        $this->finalMatrix = $m1;
        $this->finalRanks  = $ranks;

        return $this;
    }

    /**
     * Get result matrix and ranks
     * 
     * @return array
     */
    public function getResult(): array
    {
        return [
            'matrix' => $this->finalMatrix,
            'ranks'  => $this->finalRanks
        ];
    }

    /**
     * Get the matrix
     * 
     * @return array
     */
    public function getMatrix(): array
    {
        return $this->finalMatrix;
    }

    /**
     * Get the final ranks
     * 
     * @return array
     */
    public function getRank(): array
    {
        return $this->finalRanks;
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
