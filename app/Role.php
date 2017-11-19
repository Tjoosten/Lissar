<?php

namespace App;

/**
 * Class Role
 *
 * @package App
 */
class Role extends \Spatie\Permission\Models\Role
{
    /**
     * Mass-assign fields for the role database table. 
     *
     * @var array
     */
    protected $fillable = ['name'];
}
