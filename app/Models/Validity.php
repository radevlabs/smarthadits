<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
   @property varchar $name name
@property longtext $explanation explanation
@property timestamp $created_at created at
@property timestamp $updated_at updated at
@property \Illuminate\Database\Eloquent\Collection $hadith hasMany
   
 */
class Validity extends Model 
{
    
    /**
    * Database table name
    */
    protected $table = 'validities';

    /**
    * Mass assignable columns
    */
    protected $fillable=['name',
'explanation'];

    /**
    * Date time columns.
    */
    protected $dates=[];

    /**
    * hadiths
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function hadiths()
    {
        return $this->hasMany(Hadith::class,'validity_id');
    }



}