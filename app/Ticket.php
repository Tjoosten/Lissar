<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ticket
 *
 * @package App
 */
class Ticket extends Model
{
    /**
     * Maass-assign fields for the database table.
     *
     * @var array
     */
    protected $fillable = ['author_id', 'title', 'content'];

    /**
     * @param  User $user The Model instance for the given user.
     * @return void
     */
    public function setAuthorAttribute(User $user)
    {
        $this->attributes['author_id'] = $user->id;
    }
}
