<?php

namespace App\Models;

use App\Service\Ahp;
use Illuminate\Database\Eloquent\Model;

class Calculate extends Model
{
    protected $ahp;

    protected $guarded = [];

    public function __construct()
    {
        parent::__construct();

        $this->ahp = new Ahp;
    }

    public function calculate($data)
    {
        for ($i = 0; $i < count($data['criteria']); $i++) {
            $criteria[] = [
                'name' => $data['criteria'][$i],
                'type' => $data['type'][$i],
            ];
        }

        for ($i = 0; $i < count($data['pairwise']); $i++) {
            $pairwise[$data['criteria'][$i]] = $data['pairwise'][$i];
        }

        $ahp = $this->ahp->setCriteria($criteria)->setMatrix($data['row']);
        dd($ahp);
    }
}
