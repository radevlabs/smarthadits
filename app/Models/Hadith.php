<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 * @property bigint $chapter_id chapter id
 * @property bigint $validity_id validity id
 * @property bigint $no no
 * @property tinyint $ambiguism ambiguism
 * @property longtext $info info
 * @property timestamp $created_at created at
 * @property timestamp $updated_at updated at
 * @property Validity $validity belongsTo
 * @property Chapter $chapter belongsTo
 * @property \Illuminate\Database\Eloquent\Collection $category belongsToMany
 * @property \Illuminate\Database\Eloquent\Collection $language belongsToMany
 * @property \Illuminate\Database\Eloquent\Collection $path hasMany
 * @property \Illuminate\Database\Eloquent\Collection $similiar belongsToMany
 */
class Hadith extends Model
{
    use Searchable;

    /**
     * Database table name
     */
    protected $table = 'hadiths';

    /**
     * Mass assignable columns
     */
    protected $fillable = ['chapter_id',
        'validity_id',
        'no',
        'ambiguism',
        'info'];

    /**
     * Date time columns.
     */
    protected $dates = [];

    public function toSearchableArray()
    {
        $data = [];
        $data['id'] = $this->id;
        foreach ($this->languages()->get() as $language){
            $data[$language->name] = $language->pivot->content;
        }

        return $data;
    }

    public function book()
    {
        return $this->chapter()
            ->first()
            ->book();
    }

    public function priest()
    {
        return $this->book()
            ->first()
            ->priest();
    }

    /**
     * validity
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function validity()
    {
        return $this->belongsTo(Validity::class, 'validity_id');
    }

    /**
     * chapter
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chapter()
    {
        return $this->belongsTo(Chapter::class, 'chapter_id');
    }

    /**
     * categories
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'hadith_categories');
    }

    /**
     * languages
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function languages()
    {
        return $this->belongsToMany(Language::class, 'hadith_languages')
            ->withPivot('content', 'summary');
    }

    /**
     * paths
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paths()
    {
        return $this->hasMany(Path::class, 'hadith_id');
    }

    /**
     * similiars
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function similiars()
    {
        return $this->belongsToMany(Hadith::class, 'similiars', 'hadith_id', 'similiar_hadith_id');
    }
}
