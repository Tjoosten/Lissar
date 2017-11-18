<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    /**
     * Mass-assign fields for the database table. 
     * 
     * @return array
     */
    protected $fillable = ['author_id', 'name', 'color_code', 'description', 'module'];

    /**
     * TODO: Implement docblock
     */
    public function author() 
    {
        return $this->belongsTo(User::class, 'author_id')
            ->withDefault(['name' => 'Verwijderde gebruiker']);
    }
}