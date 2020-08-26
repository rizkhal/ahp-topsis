<?php

namespace Tests\Feature;

use App\Service\Ahp;
use App\Service\Topsis;
use Tests\TestCase;

class AhpTopsisTest extends TestCase
{
    /**
     * The ahp class
     *
     * @var App\Service\Ahp
     */
    private $ahp;

    /**
     * The topsis class
     *
     * @var App\Service\Topsis
     */
    private $topsis;

    public function __construct()
    {
        parent::__construct();

        $this->ahp    = new Ahp();
        $this->topsis = new Topsis();
    }

    /**
     * Criteria of the matrix
     * 
     * @return array
     */
    private function criteria(): array
    {
        return [
            [
                "name" => "Video A",
                "type" => true,
            ],
            [
                "name" => "Video B",
                "type" => true,
            ],
            [
                "name" => "Video C",
                "type" => true,
            ],
            [
                "name" => "Video D",
                "type" => true,
            ],
        ];
    }

    /**
     * Matrix for ahp method
     * 
     * @return array
     */
    private function ahpMatrix(): array
    {
        return [
            [1, 1.5, 2, 3],
            [0.66, 1, 3, 2],
            [0.5, 0.33, 1, 0.5],
            [0.33, 0.25, 2, 1],
        ];
    }

    /**
     * Matrix for topsis method
     * 
     * @return array
     */
    private function topsisMatrix(): array
    {
        return [
            [4, 2, 5, 1],
            [5, 2, 2, 4],
            [3, 2, 2, 4],
            [4, 3, 2, 3],
        ];
    }

    /**
     * The eigen result from ahp method
     * 
     * @return array
     */
    private function getEigen(): array
    {
        return $this->ahp->setCriteria($this->criteria())->setMatrix($this->ahpMatrix())->getEigen();
    }

    /**
     * @test
     */
    public function calculate()
    {
        $topsis = $this->topsis->normalize($this->topsisMatrix())->calculate($this->getEigen())->getResult();
        
        dd($topsis);
    }
}
