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

    /**
     * Determine the redirect route and send i back to the controller.
     *
     * @return mixed
     */
    public function getRedirectRoute()
    {
        switch (url()->previous()) { //! Dirty fix but it works for now.
            case url('account/info'):     return route('account.settings', ['type' => 'apikeys']);
            case url('account/security'): return route('account.settings', ['type' => 'security']);
            case url('account/apikeys'):  return route('account.settings', ['type' => 'apikeys']);
            
            default: return route('apikeys.index');    
        }
    }
}