<?php

declare (strict_types = 1);

namespace App\Service;

use App\Service\Exception\MatrixException;

class Ahp extends AhpTopsisBase
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

        if (!isset($this->criteria[$key])) {
            throw new MatrixException("The criteria $name doesnt exists!", 1);
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

        $total = 0;
        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size; $j++) {
                $total += $matrix[$i][$j];
            }
        }

        $result = [];
        for ($i = 0; $i < $size; $i++) {
            $result[$i] = 0;
            for ($j = 0; $j < $size; $j++) {
                $result[$i] = $this->round($matrix[$i][$j] / $total);
            }
        }

        $this->criteriaPairWise[$name]['matrix'] = $matrix;
        $this->criteriaPairWise[$name]['eigen']  = $result;

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

        // temp multiply matrix
        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size; $j++) {
                if (!isset($temp[$j])) {
                    $temp[$j] = 0;
                }

                $temp[$j] += $matrix[$i][$j];
            }
        }

        // calculate eigen | prioritas
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
     * @return array
     */
    private function concistencyCheck(array $matrix, array $eigen): array
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

        $cr = $ci / $this->getIR($size);

        return [
            "ci" => $ci,
            "cr" => $cr,
        ];
    }

    /**
     * Finalizing the matrix and get result
     *
     * @return self
     */
    public function finalize(): self
    {
        if (count($this->criteriaPairWise) != count($this->criteria)) {
            throw new MatrixException("The criteria not equals with pair wise matrix.");
        }

        $matrix = [];
        $ranks  = [];
        for ($i = 0; $i < count($this->alternative); $i++) {
            $matrix[$i] = [];
            $j          = 0;
            $result     = ['name' => $this->alternative[$i], 'value' => 0];
            foreach ($this->criteriaPairWise as $key => $criteriaPairWise) {
                $matrix[$i][$j] = $criteriaPairWise['eigen'][$i];
                $result['value'] += $matrix[$i][$j] * $this->eigenVector[$j];
                $j++;
            }
            $ranks[] = $result;
        }

        $this->finalMatrix = $matrix;
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
            'ranks'  => $this->finalRanks,
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

    public function getEigen(): array
    {
        return $this->eigenVector;
    }
}
