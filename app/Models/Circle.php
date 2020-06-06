<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property varchar $name name
 * @property longtext $info info
 * @property timestamp $created_at created at
 * @property timestamp $updated_at updated at
 * @property \Illuminate\Database\Eloquent\Collection $narrator hasMany
 */
class Circle extends Model
{

    /**
     * Database table name
     */
    protected $table = 'circles';

    /**
     * Mass assignable columns
     */
    protected $fillable = ['name',
        'info'];

    /**
     * Date time columns.
     */
    protected $dates = [];

    /**
     * narrators
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function narrators()
    {
        return $this->hasMany(Narrator::class, 'circle_id');
    }


}
