<?php

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

    protected function matrix(): array
    {
        return [
            [1.00, 0.33, 5.00],
            [3.00, 1.00, 5.00],
            [0.20, 0.20, 1.00],
        ];

        return [
            [1.00, 3.00, 5.00, 6.00],
            [0.33, 1.00, 5.00, 5.00],
            [0.20, 0.20, 1.00, 2.00],
            [0.17, 0.20, 0.50, 1.00],
        ];
    }

    /**
     * @test
     * @group f-service
     */
    public function eigenVectorCriteria()
    {
        $ahp = $this->ahp->setMatrix($this->matrix());
        dd($ahp);

        die;
    }
}
