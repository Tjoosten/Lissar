<?php 

namespace App\Repositories;

use App\Apikeys;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;

/**
 * Class ApiKeyRepository
 *
 * @package App\Repositories
 */
class ApiKeyRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return Apikeys::class;
    }

    /**
     * Create the new API access token in the database.
     *
     * @param  string $serviceName The name from the service where the key is used.
     * @return mixed
     */
    public function createKey($serviceName)
    {
        if ($dbKey = $this->model->make(auth()->user())) {
            if ($this->update(['service' => $serviceName], $dbKey->id)) {
                return $dbKey->key; // return the genrated api key.
            }
        }
        
        return false; // The apikey nor the service name could be stored in the database.
    }
}