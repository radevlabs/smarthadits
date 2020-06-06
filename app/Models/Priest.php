<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property varchar $name name
 * @property longtext $biography biography
 * @property timestamp $created_at created at
 * @property timestamp $updated_at updated at
 * @property \Illuminate\Database\Eloquent\Collection $book hasMany
 */
class Priest extends Model
{

    /**
     * Database table name
     */
    protected $table = 'priests';

    /**
     * Mass assignable columns
     */
    protected $fillable = ['name',
        'biography'];

    /**
     * Date time columns.
     */
    protected $dates = [];

    /**
     * books
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books()
    {
        return $this->hasMany(Book::class, 'priest_id');
    }

    public function hadiths($validities = null, $ambiguism = null)
    {
        return Hadith::query()
            ->whereHas('chapter', function ($query) {
                return $query->whereHas('book', function ($query) {
                    return $query->whereHas('priest', function ($query) {
                        return $query->where('id', $this->id);
                    });
                });
            })->when($ambiguism, function ($query) use ($ambiguism) {
                return $query->where('ambiguism', $ambiguism);
            })->when($validities, function ($query) use ($validities) {
                return $query->whereIn('validity_id', $validities);
            });
    }
}
