<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * TODO: Implement Docblock
 */
class Priority extends Model
{
    /**
     * Mass-assign fields for the database table. 
     * 
     * @return array
     */
    protected $fillable = ['author_id', 'name', 'description', 'color_code'];

    /**
     * TODO: Implement docblock
     */
    public function author() 
    {
        return $this->belongsTo(User::class, 'author_id')->withDefault(['name' => 'Verwijdere gebruiker']);
    }
}
