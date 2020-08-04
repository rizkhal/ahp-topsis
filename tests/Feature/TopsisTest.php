<?php

declare (strict_types = 1);

namespace Tests\Feature;

use App\Service\Topsis;
use Tests\TestCase;

class TopsisTest extends TestCase
{
    protected $topsis;

    public function __construct()
    {
        parent::__construct();

        $this->topsis = new Topsis;
    }

    protected function criteria(): array
    {
        return [
            'Price',
            'Storage',
            'Camera',
            'Looks',
        ];
    }

    protected function alternative(): array
    {
        return [
            'Mobile 1',
            'Mobile 2',
            'Mobile 3',
            'Mobile 4',
            'Mobile 5',
        ];
    }

    protected function matrix(): array
    {
        return [
            [250, 16, 12, 5],
            [200, 16, 8, 3],
            [300, 32, 16, 4],
            [275, 32, 8, 4],
            [225, 16, 16, 2],
        ];
    }

    /**
     * @test
     * @group f-topsis
     */
    public function normalize()
    {
        $topsis = $this->topsis->normalize($this->matrix());
        dd($topsis);
    }
}
