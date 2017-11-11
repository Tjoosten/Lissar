<?php 

namespace App\Repositories;

use App\Ticket;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;

/**
 * Class TicketsRepository
 *
 * @package App\Repositories
 */
class TicketsRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return Ticket::class;
    }
}