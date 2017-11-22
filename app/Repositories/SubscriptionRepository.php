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

    /**
     * Check if the persons are empty in the product array.
     *
     * @param  integer $inputKey The key where the amount of users are defined. 
     * @return boolean
     */
    public function isEmptyPersonen($inputKey)
    {
        return ! is_null($inputKey) && (int) $inputKey !== 0;
    }
}