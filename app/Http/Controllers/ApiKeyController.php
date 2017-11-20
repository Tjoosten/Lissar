<?php

namespace App\Http\Controllers;

use Gate;
use App\Notifications\ApiKeyDeleteNotification;
use App\Http\Requests\ApiKeyValidator;
use App\Repositories\{ApiKeyRepository, UsersRepository};
use Illuminate\Http\{Response, RedirectResponse};
use Illuminate\View\View;

/**
 * TODO: implement docblock
 */
class ApiKeyController extends Controller
{
    private $apiKeyRepository;  /** @var ApliKeyRepository $apiKeyRepository */
    private $usersRepository;   /** @var UsersRepository   $usersRepository  */

    /**
     * ApiKeyController constructor
     *
     * @param  ApiKeyRepository $apiKeyRepository   Abstraction layer between controller and database.
     * @param  UsersRepository  $usersRepository    Abstratcion layer between controller and database
     * @return void
     */
    public function __construct(ApiKeyRepository $apiKeyRepository, UsersRepository $usersRepository) 
    {
        $this->middleware('auth');

        $this->apiKeyRepository = $apiKeyRepository;
        $this->usersRepository  = $usersRepository;
    }

    /**
     * Get the management index view for the api keys. 
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('apikeys.index', ['users' => $this->usersRepository->all(['id', 'name'])]);
    }

    /**
     * Create view for an new api key. (Admin)
     * 
     * @return \Illuminate\View\View
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
        if ($apiKey = $this->apiKeyRepository->createKey($input->service)) {
            // TODO: Register translation key.
            flash(trans('flash-messages.apikey-new-key', ['key' => $apiKey]))->success();
        }

        //? TODO: Implement shorthand IF/ELSE to determine the flash session. 
        //?       This is needed because the ->createkey($service) can return FALSE.     

        return redirect()->to($this->apiKeyRepository->getRedirectRoute());
    }

    /**
     * Delete an api key out off the storage. 
     *
     * @param  integer $keyId The unique identifier in the storage.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($keyId): RedirectResponse
    {
        $apiKey   = $this->apiKeyRepository->find($keyId) ?: abort(Response::HTTP_NOT_FOUND);
        $authUser = auth()->user();
        
        if (Gate::allows('delete', $apiKey) && $apiKey->delete()) {
            $this->usersRepository->find($apiKey->apikeyable_id)->notify(new ApiKeyDeleteNotification($apiKey, $authUser));
            flash("De API sleutel voor de service {$apiKey->service} is verwijderd.")->success();
            
            if (auth()->user()->hasRole('admin')) {
                // TODO: Implement activity logger
            }
        }

        return redirect()->to($this->apiKeyRepository->getRedirectRoute());
    }
}
