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
                "name" => "Kenyamanan",
                "type" => 1,
            ],
            [
                "name" => "Kapasitas",
                "type" => 1,
            ],
        ];
    }

    protected function matrix(): array
    {
        return [
            [1.00, 0.33, 5.00],
            [3.00, 1.00, 5.00],
            [4.20, 1.53, 1.00],
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

    protected function method()
    {
        return $this->ahp
                ->setCriteria($this->criteria())
                ->setAlternative(['Sepeda', 'Motor', 'Mobil'])
                ->setMatrix($this->matrix())
                ->setBatchCriteriaPairWise($this->pairWise())
                ->finalize();
    }

    /**
     * @test
     * @group f-method
     */
    public function methodAhp()
    {
        $data = $this->method();
        $this->assertTrue(true);
    }

    /**
     * @test
     * @group f-method
     */
    public function methodTopsis()
    {
        $data = $this->method();
        dd($data->getMatrix());
    }
}
