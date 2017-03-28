<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BX_User extends Model
{

    protected $primaryKey = 'User-ID';
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'BX-Users';


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['User-ID'];


    /**
     * Get user with related books
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function book()
    {
        return $this->belongsToMany('App\BX_Book', 'BX-Book-Ratings', 'User-ID', 'ISBN')
            ->withPivot('Book-Rating');
    }


}
