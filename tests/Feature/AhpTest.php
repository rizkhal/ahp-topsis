<?php

declare (strict_types = 1);

namespace Tests\Feature;

use App\Service\Ahp;
use Tests\TestCase;

class AhpTest extends TestCase
{
    protected $ahp;

    public function __construct()
    {
        parent::__construct();

        $this->ahp = new Ahp;
    }

    protected function criteria()
    {
        return [
            [
                "name" => "Kecepatan",
                "type" => 1,
            ],
            [
                "name" => "Kapasitas",
                "type" => 1,
            ],
            [
                "name" => "Kenyamanan",
                "type" => 1,
            ],
        ];
    }

    protected function matrix(): array
    {
        return [
            [1.00, 0.33, 5.00],
            [3.00, 1.00, 5.00],
            [0.20, 0.20, 1.00],
        ];
    }

    protected function pairWise(): array
    {
        return [
            'Kecepatan'  => [
                [1.00, 0.20, 0.14],
                [5.00, 1.00, 0.33],
                [7.00, 3.00, 1.00],
            ],
            'Kenyamanan' => [
                [1.00, 3.00, 0.20],
                [0.33, 1.00, 0.33],
                [5.00, 3.00, 1.00],
            ],
            'Kapasitas'  => [
                [1.00, 0.33, 0.14],
                [3.00, 1.00, 0.20],
                [7.00, 5.00, 1.00],
            ],
        ];
    }

    /**
     * @test
     * @group f-ahp
     */
    public function setCriteria()
    {
        $this->assertTrue(true);
    }

    /**
     * @test
     * @group f-ahp
     */
    public function setAlternative()
    {
        $this->assertTrue(true);
    }

    /**
     * @test
     * @group f-ahp
     */
    public function setBatchCriteriaPairWise()
    {
        $this->assertTrue(true);
    }

    /**
     * @test
     * @group f-ahp
     */
    public function setMatrix()
    {
        $this->assertTrue(true);
    }

    /**
     * @test
     * @group f-ahp
     */
    public function finalRanks()
    {
        $ahp = $this->ahp->setCriteria($this->criteria())
                ->setAlternative(['Sepeda', 'Motor', 'Mobil'])
                ->setBatchCriteriaPairWise($this->pairwise())
                ->setMatrix($this->matrix())->finalize();

        $ranks = $ahp->getRank();

        for ($i = 0; $i < count($ranks); $i++) {
            $this->assertContainsEquals($ranks[$i]['value'], [0.1746, 0.1865, 0.635]);
        }

        foreach ($ranks as $r) {
            foreach ($r as $i => $v) {
                $this->assertArrayHasKey($i, $r);
                $this->assertArrayHasKey($i, $r);
            }
        }
    }
}
