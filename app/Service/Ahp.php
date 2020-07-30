<?php

declare (strict_types = 1);

namespace App\Service;

use Exception;

class Ahp extends AhpBase
{
    /**
     * Criteria of the matrix
     *
     * @var array
     */
    protected $criteria = [];

    /**
     * Candidate of the matrix
     *
     * @var array
     */
    protected $candidate = [];

    /**
     * Relative matrix
     *
     * @var array
     */
    protected $relativeMatrix = [];

    /**
     * Eigen Vector of the criteria
     *
     * @var array
     */
    protected $eigenVector = [];

    /**
     * Set candidate
     * 
     * @param  array $candidate
     * @return void
     */
    public function setCandidate(array $candidate): void
    {
        $this->candidate[] = $candidate;
    }

    /**
     * Set up criteria
     *
     * @param  array $criteria
     * @return self
     */
    public function setCriteria(array $criteria, array $type): self
    {
        if (!is_array($criteria)) {
            throw new Exception("The criteria must be array.", 1);
        }

        for ($i = 0; $i < count($type); $i++) {
            $this->criteria[] = [
                "name" => $criteria[$i],
                "type" => $type[$i] == false ? self::COST : self::BENEFIT,
            ];
        }

        return $this;
    }

    /**
     * Set the relative matrix
     *
     * @param  array $matrix
     * @return self
     */
    public function setRelativeInterestMatrix(array $matrix): self
    {
        if (count($this->criteria) != $size = count($matrix)) {
            throw new Exception("The criteria count not be equals with matrix params count", 1);
        }

        $total = [];
        $eigen = [];
        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size; $j++) {
                if (!isset($total[$j])) {
                    $total[$j] = 0;
                }

                $total[$j] += $matrix[$i][$j];
            }
        }

        for ($i = 0; $i < $size; $i++) {
            $eigen[$i] = 0;
            for ($j = 0; $j < $size; $j++) {
                $matrix[$i][$j] /= $total[$j];
                $eigen[$i] += $matrix[$i][$j];
            }

            $eigen[$i] /= $size;
        }

        $this->eigenVector[]    = $eigen;
        $this->relativeMatrix[] = $matrix;

        return $this;
    }

    /**
     * Get the eigen from matrix
     *
     * @return array
     */
    public function getEigen(): array
    {
        return $this->eigenVector;
    }

    /**
     * Get the matrix
     *
     * @return array
     */
    public function getMatrix(): array
    {
        return $this->relativeMatrix;
    }
}
