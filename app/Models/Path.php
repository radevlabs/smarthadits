<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property bigint $hadith_id hadith id
 * @property bigint $scheme_id scheme id
 * @property bigint $position_id position id
 * @property int $order order
 * @property timestamp $created_at created at
 * @property timestamp $updated_at updated at
 * @property Position $position belongsTo
 * @property Scheme $scheme belongsTo
 * @property Hadith $hadith belongsTo
 * @property \Illuminate\Database\Eloquent\Collection $narrator belongsToMany
 */
class Path extends Model
{

    /**
     * Database table name
     */
    protected $table = 'paths';

    /**
     * Mass assignable columns
     */
    protected $fillable = ['hadith_id',
        'scheme_id',
        'position_id',
        'order'];

    /**
     * Date time columns.
     */
    protected $dates = [];

    /**
     * position
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    /**
     * scheme
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function scheme()
    {
        return $this->belongsTo(Scheme::class, 'scheme_id');
    }

    /**
     * hadith
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hadith()
    {
        return $this->belongsTo(Hadith::class, 'hadith_id');
    }

    /**
     * narrators
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function narrators()
    {
        return $this->belongsToMany(Narrator::class, 'path_narrators')
            ->withPivot('order');
    }


}
