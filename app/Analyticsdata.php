<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Analyticsdata extends Model 
{
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ref_id', 'datalayer', 'status', 'payment_method', 'client_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
