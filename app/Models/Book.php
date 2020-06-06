<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property bigint $priest_id priest id
 * @property varchar $name name
 * @property timestamp $created_at created at
 * @property timestamp $updated_at updated at
 * @property Priest $priest belongsTo
 * @property \Illuminate\Database\Eloquent\Collection $language belongsToMany
 * @property \Illuminate\Database\Eloquent\Collection $chapter hasMany
 */
class Book extends Model
{

    /**
     * Database table name
     */
    protected $table = 'books';

    /**
     * Mass assignable columns
     */
    protected $fillable = ['priest_id',
        'name'];

    /**
     * Date time columns.
     */
    protected $dates = [];

    /**
     * priest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function priest()
    {
        return $this->belongsTo(Priest::class, 'priest_id');
    }

    /**
     * languages
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function languages()
    {
        return $this->belongsToMany(Language::class, 'book_languages');
    }

    /**
     * chapters
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chapters()
    {
        return $this->hasMany(Chapter::class, 'book_id');
    }


}
