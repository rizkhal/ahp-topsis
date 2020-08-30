<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
    protected $guarded = [];

    /**
     * Search the alternative by name
     * This method for handle select2 ajax request
     *
     * @param  array  $params
     * @return array
     */
    public function searchByName(array $params)
    {
        $query = self::query();

        if (isset($params['q'])) {
            $query->where('name', 'like', '%' . $params['q'] . '%');
        }

        return $query->take(10)->get();
    }

    /**
     * Store new alternative
     * 
     * @param  array  $request
     * @return bool
     */
    public function store(array $request): bool
    {
        if (self::create($request)) {
            return true;
        }

        return false;
    }

    /**
     * Update the alternative
     *
     * @param  array  $request
     * @param  string $id
     * @return bool
     */
    public function edit(array $request, string $id): bool
    {
        $alternative = self::findOrFail($id);
        if ($alternative->update($request)) {
            return true;
        }

        return false;
    }

    /**
     * Delete the alternative
     *
     * @param  string $id
     * @return bool
     */
    public function remove(string $id): bool
    {
        $alternative = self::findOrFail($id);
        if ($alternative->delete($id)) {
            return true;
        }

        return false;
    }
}
