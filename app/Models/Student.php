<?php

declare (strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = [];

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
