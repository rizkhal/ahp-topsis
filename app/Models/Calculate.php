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
        $ahp = $this->ahp->setCriteria($data["criteria"], $data["type"])
                    ->setRelativeInterestMatrix($data["row"]);

        dd($ahp->getEigen());
    }
}
