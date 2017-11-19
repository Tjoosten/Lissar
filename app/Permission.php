<?php

namespace App;

/**
 * Class Permission
 *
 * @package App
 */
class Permission extends \Spatie\Permission\Models\Permission
{
    /**
     * Mass-assign fields for the database table.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
