<?php

namespace App\Models;

use App\Service\Ahp;
use App\Service\Topsis;
use Illuminate\Database\Eloquent\Model;

class Calculate extends Model
{
    protected $guarded = [];

    protected $casts = [
        'data' => 'json',
    ];

    /**
     * Calculate the matrix
     *
     * @param  array  $data
     * @return bool
     */
    public function calculate(array $data): bool
    {
        $ahp    = new Ahp;
        $topsis = new Topsis;

        foreach ($data['candidate'] as $i => $c) {
            $candidate[] = [
                'name' => $c,
                'type' => true,
            ];
        }

        $eigenVector = $ahp->setCriteria($candidate)->setMatrix($data['ahp'])->getEigen();
        $topsis      = $topsis->normalize($data['topsis'])->calculate($eigenVector)->getResult();

        foreach ($candidate as $i => $value) {
            $eigen[] = [
                'candidate'   => $value['name'],
                'eigenVector' => $eigenVector[$i],
            ];
        }

        $result = array_merge(
            ['notes' => $data['notes']],
            ['eigen' => $eigen], $topsis,
            ['candidate' => $data['candidate']],
            ['alternative' => $data['alternative']],
        );

        if (self::create(['data' => json_encode($result)])) {
            return true;
        }

        return false;
    }

    /**
     * Show the data calculated
     *
     * @param  int    $id
     * @return array
     */
    public function show(int $id): array
    {
        return [
            'data' => json_decode(self::findOrFail($id)['data']),
        ];
    }

    /**
     * Delete the calculated matrix row
     *
     * @param  string $id
     * @return bool
     */
    public function remove(string $id): bool
    {
        $student = self::findOrFail($id);
        if ($student->delete($id)) {
            return true;
        }

        return false;
    }
}
