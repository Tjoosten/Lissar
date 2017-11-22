<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriptions extends Model
{
    /**
     * Mass-assign fields for the database table. 
     * 
     * @var array
     */
    protected $fillable = ['name', 'tel_nummer', 'email'];

    public function orders() 
    {
        return $this->belongsToMany(Product::class)->withPivot('personen');
    }
}
