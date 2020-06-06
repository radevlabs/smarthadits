<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property varchar $name name
 * @property timestamp $created_at created at
 * @property timestamp $updated_at updated at
 * @property \Illuminate\Database\Eloquent\Collection $narrator hasMany
 * @property \Illuminate\Database\Eloquent\Collection $narrator hasMany
 */
class Country extends Model
{

    /**
     * Database table name
     */
    protected $table = 'countries';

    /**
     * Mass assignable columns
     */
    protected $fillable = ['name'];

    /**
     * Date time columns.
     */
    protected $dates = [];

    /**
     * narrators
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function narratorLives()
    {
        return $this->hasMany(Narrator::class, 'dead_country_id');
    }

    /**
     * narrators
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function narratorDeads()
    {
        return $this->hasMany(Narrator::class, 'live_country_id');
    }


}
