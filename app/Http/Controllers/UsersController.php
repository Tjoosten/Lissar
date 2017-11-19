<?php

namespace App\Http\Controllers;

use Gate;
use App\Http\Requests\UserValidator;
use App\Repositories\UsersRepository;
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

    /**
     * UsersController constructor.
     *
     * @param  UsersRepository $usersRepository Abstraction layer between database and controller.
     * @return void
     */
    public function __construct(UsersRepository $usersRepository)
    {
        $this->middleware('auth');
        $this->usersRepository = $usersRepository;
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
     * @return View
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
        if ($user = $this->usersRepository->create($input->except('_token'))) {
            flash("U hebt een login aangemaakt voor {$user->name}")->success();
        }

        return redirect()->route('users.index');
    }

    public function block(): RedirectResponse
    {

    }

    public function unblock(): RedirectResponse
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
        $user = $this->usersRepository->find($userId) ?: abort(Response::HTTP_NOT_FOUND);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the user in the system. 
     * 
     * @param  UserValidator $input  The user given input. (Validated).
     * @param  integer       $userId The unique identifier in the storage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserValidator $input, $userId): RedirectResponse
    {
        $dbUser = $this->usersRepository->find($userId) ?: abort(Response::HTTP_NOT_FOUND);

        if ($user = $dbUser->update($input->except(['_token', 'permissions']))) {
            flash(trans('users.flash-edit-success', ['user' => $user->name]))->success();
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

        if (Gate::allows('delete', $user) && $user->delete()) {
            // 1) Check if the user has the correct permissions. 2) The user is deleted in the system.
            $message = trans('users.delete-flash-success', ['user' => $user->name]);
        }

        // Check if the user you want to delete is the current user. IF YES: abort IO and customize the flash message.
        (auth()->user()->id != $user->id) ?: $message = trans('users.delete-flash-current-user');

        flash(isset($message) ? $message : trans('users.delete-flash-no-perm', ['user' => $user->name]))->success();
        return redirect()->route('users.index');
    }
}
