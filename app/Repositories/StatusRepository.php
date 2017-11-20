<?php 

namespace App\Repositories;

use App\Status;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;

/**
 * Class StatusRepository
 *
 * @package App\Repositories
 */
class StatusRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return Status::class;
    }
}