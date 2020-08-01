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
        dd($data);
    }
}
