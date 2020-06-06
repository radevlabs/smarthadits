<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
   @property varchar $name name
@property timestamp $created_at created at
@property timestamp $updated_at updated at
@property \Illuminate\Database\Eloquent\Collection $hadithcategory belongsToMany

 */
class Category extends Model
{

    /**
    * Database table name
    */
    protected $table = 'categories';

    /**
    * Mass assignable columns
    */
    protected $fillable=['name'];

    /**
    * Date time columns.
    */
    protected $dates=[];

    /**
    * hadithcategories
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function hadiths()
    {
        return $this->belongsToMany(Hadith::class,'hadith_categories');
    }



}
