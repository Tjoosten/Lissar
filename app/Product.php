<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @todo: Implement docblock
 */
class Product extends Model
{
    /**
     * Mass-assign fields for the database table. 
     * 
     * @return array
     */
    protected $fillable = ['author_id', 'name', 'description', 'type', 'price'];
}
