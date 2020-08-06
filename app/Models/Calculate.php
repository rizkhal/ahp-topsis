<?php

namespace App\Models;

use App\Service\Ahp;
use App\Service\Topsis;
use Illuminate\Database\Eloquent\Model;

class Calculate extends Model
{
    protected $fillable = ['data'];

    protected $casts = [
        'data' => 'json',
    ];

    protected $ahp;

    protected $topsis;

    public function __construct()
    {
        parent::__construct();

        $this->ahp    = new Ahp;
        $this->topsis = new Topsis;
    }

    public function calculate(array $data): bool
    {
        $criteria = [];
        foreach ($data['criteria'] as $i => $c) {
            $criteria[] = [
                'name' => $c,
                'type' => true,
            ];
        }

        // menghitung eigen vector dari
        // criteria matrix dengan metode AHP
        $eigenVector = $this->ahp->setCriteria($criteria)->setMatrix($data['ahp'])->getEigen();

        // normalisasi matrix alternative
        // menggunakan metode TOPSIS
        // dan mengalikan masing2 kriteria
        // dengan bobot eigenVector dari metode AHP
        $topsis = $this->topsis->normalize($data['topsis'])->calculateWieght($eigenVector);

        dd($topsis->getDistance());

        die;
        return false;
    }
}
