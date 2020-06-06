<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
   @property varchar $name name
@property timestamp $created_at created at
@property timestamp $updated_at updated at
@property \Illuminate\Database\Eloquent\Collection $book belongsToMany
@property \Illuminate\Database\Eloquent\Collection $chapter belongsToMany
@property \Illuminate\Database\Eloquent\Collection $hadith belongsToMany
   
 */
class Language extends Model 
{
    
    /**
    * Database table name
    */
    protected $table = 'languages';

    /**
    * Mass assignable columns
    */
    protected $fillable=['name'];

    /**
    * Date time columns.
    */
    protected $dates=[];

    /**
    * books
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function books()
    {
        return $this->belongsToMany(Book::class,'book_languages');
    }
    /**
    * chapters
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function chapters()
    {
        return $this->belongsToMany(Chapter::class,'chapter_languages');
    }
    /**
    * hadiths
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function hadiths()
    {
        return $this->belongsToMany(Hadith::class,'hadith_languages');
    }



}