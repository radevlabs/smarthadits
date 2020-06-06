<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
   @property varchar $name name
@property longtext $info info
@property timestamp $created_at created at
@property timestamp $updated_at updated at
@property \Illuminate\Database\Eloquent\Collection $path hasMany
   
 */
class Position extends Model 
{
    
    /**
    * Database table name
    */
    protected $table = 'positions';

    /**
    * Mass assignable columns
    */
    protected $fillable=['name',
'info'];

    /**
    * Date time columns.
    */
    protected $dates=[];

    /**
    * paths
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function paths()
    {
        return $this->hasMany(Path::class,'position_id');
    }



}