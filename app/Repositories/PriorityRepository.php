<?php 

namespace App\Repositories;

use App\Priority;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;

/**
 * Class PriorityRepository
 *
 * @package App\Repositories
 */
class PriorityRepository extends Repository
{

    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return Priority::class;
    }
}