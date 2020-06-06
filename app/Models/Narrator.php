<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 * @property bigint $circle_id circle id
 * @property bigint $live_country_id live country id
 * @property bigint $dead_country_id dead country id
 * @property varchar $name name
 * @property varchar $lineage lineage
 * @property int $quality quality
 * @property varchar $kuniyah kuniyah
 * @property varchar $laqob laqob
 * @property varchar $dead_at dead at
 * @property timestamp $created_at created at
 * @property timestamp $updated_at updated at
 * @property Circle $circle belongsTo
 * @property \Illuminate\Database\Eloquent\Collection $narratorComment hasMany
 * @property \Illuminate\Database\Eloquent\Collection $path belongsToMany
 */
class Narrator extends Model
{
    use Searchable;

    /**
     * Database table name
     */
    protected $table = 'narrators';

    /**
     * Mass assignable columns
     */
    protected $fillable = ['circle_id',
        'live_country_id',
        'dead_country_id',
        'name',
        'lineage',
        'quality',
        'kuniyah',
        'laqob',
        'dead_at'];

    /**
     * Date time columns.
     */
    protected $dates = [];

    public function toSearchableArray()
    {
        $data = $this->toArray();
        unset($data['lineage']);

        return $data;
    }

    /**
     * deadCountry
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function deadCountry()
    {
        return $this->belongsTo(Country::class, 'dead_country_id');
    }

    /**
     * liveCountry
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function liveCountry()
    {
        return $this->belongsTo(Country::class, 'live_country_id');
    }

    /**
     * circle
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function circle()
    {
        return $this->belongsTo(Circle::class, 'circle_id');
    }

    /**
     * narratorComments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function narratorComments()
    {
        return $this->hasMany(NarratorComment::class, 'narrator_id');
    }

    /**
     * paths
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function paths()
    {
        return $this->belongsToMany(Path::class, 'path_narrators');
    }


}
