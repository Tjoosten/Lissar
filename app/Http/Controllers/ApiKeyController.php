<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiKeyValidator;
use App\Repositories\{ApiKeyRepository, UsersRepository};
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ApiKeyController extends Controller
{
    private $apikeyRepository;
    private $usersRepository; 

    public function __construct(ApiKeyRepository $apikeyRepository, UsersRepository $usersRepository) 
    {
        $this->middleware('auth');

        $this->apikeyRepository = $apikeyRepository;
        $this->usersRepository  = $usersRepository;
    }

    /**
     * Get the management index view for the api keys. 
     *
     * @return View
     */
    public function index(): View
    {
        return view('apikeys.index', ['users' => $this->usersRepository->all(['id', 'name'])]);
    }

    /**
     * Create view for an new api key. (Admin)
     * @return View
     */
    public function create(): View
    {
        return view('apikeys.create');
    }

    /**
     * Store an api key in the storage.
     *
     * @param  ApiKeyValidator $input   The user given input (validated).
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ApiKeyValidator $input): RedirectResponse
    {
        return redirect()->route('apikeys.index');
    }

    /**
     * Delete an api key out off the storage. 
     *
     * @param  integer $keyId The unique identifier in the storage.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($keyId): RedirectResponse
    {
        // TODO: Implement check. If the key is not found in the database throw an 404.
        // TODO: Create the destory handling in the database
        // TODO: if the delete was confirmed send an mail to the user that is owner of the key.

        return redirect()->route('apikeys.index');
    }
}
