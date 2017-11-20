<?php 

namespace App\Repositories;

use Illuminate\Notifications\DatabaseNotification;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;

/**
 * Class NotificationsRepository
 *
 * @package App\Repositories
 */
class NotificationsRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return DatabaseNotification::class;
    }
}