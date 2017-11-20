<?php 

namespace App\Repositories;

use App\Subscriptions;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;

/**
 * Class SubscriptionRepository
 *
 * @package App\Repositories
 */
class SubscriptionRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return Subscriptions::class;
    }
}