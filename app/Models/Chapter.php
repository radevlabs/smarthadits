<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
   @property bigint $book_id book id
@property varchar $name name
@property timestamp $created_at created at
@property timestamp $updated_at updated at
@property Book $book belongsTo
@property \Illuminate\Database\Eloquent\Collection $language belongsToMany
@property \Illuminate\Database\Eloquent\Collection $hadith hasMany
   
 */
class Chapter extends Model 
{
    
    /**
    * Database table name
    */
    protected $table = 'chapters';

    /**
    * Mass assignable columns
    */
    protected $fillable=['book_id',
'name'];

    /**
    * Date time columns.
    */
    protected $dates=[];

    /**
    * book
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function book()
    {
        return $this->belongsTo(Book::class,'book_id');
    }

    /**
    * languages
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function languages()
    {
        return $this->belongsToMany(Language::class,'chapter_languages');
    }
    /**
    * hadiths
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function hadiths()
    {
        return $this->hasMany(Hadith::class,'chapter_id');
    }



}