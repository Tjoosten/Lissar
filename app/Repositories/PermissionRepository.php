<?php 

namespace App\Repositories;

use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use Spatie\Permission\Models\Permission;

/**
 * Class PermissionRepository
 *
 * @package App\Repositories
 */
class PermissionRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return Permission::class;
    }
}