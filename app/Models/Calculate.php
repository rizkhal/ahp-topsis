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
        foreach ($data['criteria'] as $i => $c) {
            $criteria[] = [
                'name' => $c,
                'type' => true,
            ];
        }

        $eigen  = $this->ahp->setCriteria($criteria)->setMatrix($data['ahp'])->getEigen();
        $topsis = $this->topsis->normalize($data['topsis'])->calculate($eigenVector)->getResult();

        foreach ($criteria as $i => $value) {
            $eigen[] = [
                'criteria'    => $value['name'],
                'eigenVector' => $eigenVector[$i],
            ];
        }

        $merge  = array_merge(['eigen' => $eigen], $topsis);
        $result = [
            'data'       => json_encode($merge),
        ];

        if (self::create($result)) {
            return true;
        }

        return false;
    }
}
