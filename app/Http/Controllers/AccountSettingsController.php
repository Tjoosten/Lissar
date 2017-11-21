<?php

namespace App\Http\Controllers;

use App\Http\Requests\{AccountInfoValidator, AccountSecurityValidator};
use App\Repositories\UsersRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class AccountSettingsController
 *
 * @package App\Http\Controllers
 */
class AccountSettingsController extends Controller
{
    private $usersRepository; /** @var UsersRepository $usersRepository */

    /**
     * AccountSettingsController constructor.
     *
     * @param  UsersRepository $usersRepository Abstraction layer between controller and database.
     * @return void
     */
    public function __construct(UsersRepository $usersRepository)
    {
        $this->middleware(['auth', 'forbid-banned-user']);
        $this->usersRepository = $usersRepository;
    }

    /**
     * Get the index page for the account settings.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('account-settings.index', ['user' => $this->usersRepository->find(auth()->user()->id)]);
    }

    /**
     * Update the account information in the system.
     *
     * @param  AccountInfoValidator $input  The user given input (validated).
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editInfo(AccountInfoValidator $input): RedirectResponse
    {
        if ($this->usersRepository->update($input->except('_token'), auth()->user()->id)) {
            flash(trans('account-settings.flash-edit-info-success'))->success();
        }

        return redirect()->route('account.settings', ['type' => 'info']);
    }

    /**
     * Update the account security in the system.
     *
     * @param  AccountSecurityValidator $input  The user given input (validated).
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editSecurity(AccountSecurityValidator $input): RedirectResponse
    {
        $data = ['password' => bcrypt($input->password)];

        if ($this->usersRepository->update($data, auth()->user()->id)) {
            flash('account-settings.flash-edit-security-success')->success();
        }

        return redirect()->route('account.settings', ['type' => 'security']);
    }
}
