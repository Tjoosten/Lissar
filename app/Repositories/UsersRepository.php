<?php 

namespace App\Repositories;

use App\User;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use Illuminate\Auth\Access\AuthorizationException;

/**
 * Class UsersRepository
 *
 * @package App\Repositories
 */
class UsersRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Return the database record for the currently authenticated user.
     *
     * @return mixed
     * @throws AuthorizationException
     */
    public function current()
    {
        if (auth()->check()) {
            return $this->find(auth()->user()->id);
        }

        // There is no user authencticated. So throw an error exception.
        throw new AuthorizationException(trans('exceptions.not-authenticated'));
    }

    /**
     * Check if the user has the given roles in the application.
     *
     * @param  array $roles The needed roles for the handling.
     * @return mixed
     */
    public function hasRoles(array $roles)
    {
        return $this->current()->hasRoles($roles);
    }
}