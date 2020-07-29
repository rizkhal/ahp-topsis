<?php

namespace Tests\Feature;

use App\Service\Service;
use Tests\TestCase;

class ServiceTest extends TestCase
{
    protected $service;

    public function __construct()
    {
        parent::__construct();

        $this->service = new Service;
    }

    protected function pairWaise(): array
    {
        return [
            'Terbuka Terhadap Kritik' =>
            [
                [1, null, null, null],
                [5, 1, 3, 6],
                [4, null, 1, 4],
                [2, null, null, 1],
            ],
            'Tanggung Jawab'              =>
            [
                [1, null, null, 5],
                [5, 1, 2, 7],
                [2, null, 1, 5],
                [null, null, null, 1],
            ],
            'Kerjasama'              =>
            [
                [1, null, null, 5],
                [5, 1, 2, 7],
                [2, null, 1, 5],
                [null, null, null, 1],
            ],
            'Disiplin'              =>
            [
                [1, null, null, 5],
                [5, 1, 2, 7],
                [2, null, 1, 5],
                [null, null, null, 1],
            ],
            'Kreatif'              =>
            [
                [1, null, null, 5],
                [5, 1, 2, 7],
                [2, null, 1, 5],
                [null, null, null, 1],
            ],
        ];
    }

    protected function criterias(): array
    {
        return [
            'Terbuka Terhadap Kritik',
            'Tanggung Jawab',
            'Kerjasama',
            'Disiplin',
            'Kreatif',
        ];
    }

    protected function matrix(): array
    {
        return [
            [1, null, null, null, null],
            [5, 1, 3, 1, 4],
            [5, null, 1, 1, 4],
            [5, 1, 1, 1, 4],
            [1, null, null, null, 1],
        ];
    }

    /**
     * @test
     * @group f-service
     */
    public function setRelativeInterestMatrixQualitativeCriteria()
    {
        foreach ($this->criterias() as $key => $value) {
            $this->service->addQualitativeCriteria($value);
        }

        $this->service->setRelativeInterestMatrix($this->matrix());
        $this->service->setCandidates(['TF', 'KS', 'NH', 'AT']);

        $this->service->setBatchCriteriaPairWise($this->pairWaise());
        $this->service->finalize();

        $result = $this->service->getResult();
        $matrix = $this->service->getMatrix();

        $this->assertEquals(0.0959542618328561, $result[0]["value"]);
    }
}
