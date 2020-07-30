<?php

namespace App\Models;

use App\Service\Service;
use Illuminate\Database\Eloquent\Model;

class Calculate extends Model
{
    protected $guarded = [];

    public function calculate($data)
    {
        $service = new Service;

        foreach ($data['criteria'] as $key => $value) {
            $service->addQualitativeCriteria($value);
        }

        $service->setCandidates($data['candidate']);

        foreach ($data['row'] as $i => &$ar) {
            foreach ($ar as $j => &$ar2) {
                if ($ar2 == 'AUTO') {
                    $ar2 = null;
                }
            }
        }

        $service->setRelativeInterestMatrix($data['row']);

        foreach ($data['pairwise'] as $i => &$ar) {
            foreach ($ar as $j => &$ar2) {
                foreach ($ar2 as $key => &$ar3) {
                    if ($ar3 == "AUTO") {
                        $ar3 = null;
                    }
                }
            }

            $pairWise[$data['criteria'][$i]] = $ar;
        }

        $service->setBatchCriteriaPairWise($pairWise);

        $service->finalize();

        dd($service->getMatrix());
        dd($service->getResult());

        return self::create([
            'title'       => $data['title'],
            'description' => $data['description'],
            'data'        => json_encode($data),
        ]);
    }
}
