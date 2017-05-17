<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BX_Book extends Model
{

    protected $primaryKey = 'ISBN';
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'BX-Books';


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
    protected $guarded = ['ISBN'];



    /**
     * Cast ISBN to string because of 0-s in front of it
    */
    protected $casts = [ 'ISBN' => 'string' ];

    /**
     * Relationship to get Book rating and related user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\BX_User', 'BX-Book-Ratings', 'ISBN', 'User-ID')
            ->withPivot('Book-Rating');
    }


}
