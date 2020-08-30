<?php

declare (strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = [];

    /**
     * Search the student by name
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
     * Save student into database
     *
     * @param  array $request
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
     * Update the student
     *
     * @param  array  $request
     * @param  string $id
     * @return bool
     */
    public function edit(array $request, string $id): bool
    {
        $student = self::findOrFail($id);
        if ($student->update($request)) {
            return true;
        }

        return false;
    }

    /**
     * Delete the student
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
