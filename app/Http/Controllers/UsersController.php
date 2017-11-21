<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserValidator;
use App\Repositories\{UsersRepository, RoleRepository};
use Illuminate\Http\{RedirectResponse, Response};
use Illuminate\View\View;

/**
 * Class UsersController
 *
 * @package App\Http\Controllers
 */
class UsersController extends Controller
{
    private $usersRepository; /** @var UsersRepository $usersRepository */
    private $roleRepository;  /** @var RoleRepository  $roleRepository  */

    /**
     * UsersController constructor.
     *
     * @param  UsersRepository $usersRepository Abstraction layer between database and controller.
     * @param  RoleRepository  $roleRepository  Abstraction layer between database and controller.
     * @return void
     */
    public function __construct(UsersRepository $usersRepository, RoleRepository $roleRepository)
    {
        $this->middleware(['auth', 'forbid-banned-user']);
        $this->usersRepository = $usersRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Index page for the user management system.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('users.index', ['users' => $this->usersRepository->paginate(25)]);
    }

    /**
     * Create view a new user. 
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('users.create');
    }

    /**
     * Store the new user in the storage.
     *
     * @param  UserValidator $input The given input form the user. (Validated)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserValidator $input): RedirectResponse 
    {
        if ($user = $this->usersRepository->create($input->except(['_token']))) {
            flash("U hebt een login aangemaakt voor {$user->name}")->success();
            
            //! TODO: Implement notification mail that to the input email. 
            //!       To letting know that the user has been created.
        }

        return redirect()->route('users.index');
    }

    /**
     * Block the user in the system.
     *
     * @param  integer $userId  The unique identifier in the storage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function block($userId): RedirectResponse
    {

    }

    /**
     * Activate the user back in the system. 
     *
     * @param  integer $userId  The unique identifier in the storage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unblock($userId): RedirectResponse
    {

    }

    /**
     * Edit view for a specific view.
     *
     * @param  integer $userId The unique user identifier in the storage.
     * @return \Illuminate\View\View
     */
    public function edit($userId): View
    {
        $user  = $this->usersRepository->find($userId) ?: abort(Response::HTTP_NOT_FOUND);
        $roles = $this->roleRepository->entity()->pluck('name', 'id');

        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the user in the system. 
     * 
     * @param  UserValidator $input  The user given input. (Validated).
     * @param  integer       $userId The unique identifier in the storage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserValidator $input, $userId): RedirectResponse // TODO: Implement activity logger
    {
        $dbUser = $this->usersRepository->find($userId) ?: abort(Response::HTTP_NOT_FOUND);

        if ($dbUser->update($input->except(['_token', 'roles']))) {
            $dbUser->roles()->sync($input->roles); // Synchronize the user with the new roles. 
            flash(trans('users.flash-edit-success', ['user' => $dbUser->name]))->success();
        }

        return redirect()->route('users.index');
    }

    /**
     * Delete an user in the system.
     *
     * @param  integer $userId The unique identifier in the storage.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($userId): RedirectResponse
    {
        $user  = $this->usersRepository->find($userId) ?: abort(Response::HTTP_NOT_FOUND);

        if (auth()->user()->hasRole('admin') || $user->id == auth()->user()->id) {
            // 1) Check if the user has the correct permissions. 2) The user is deleted in the system.
            if ($user->delete()) { // User has been deleted in the system.
                $message = trans('users.delete-flash-success', ['user' => $user->name]);
                // TODO: Implement user notification mail that the account has been deleted. 
            }
        }

        flash(isset($message) ? $message : trans('users.delete-flash-no-perm', ['user' => $user->name]))->success();
        return redirect()->route('users.index');
    }
}
