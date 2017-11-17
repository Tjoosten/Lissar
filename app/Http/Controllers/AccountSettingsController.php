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
        $this->middleware(['auth']);
        $this->usersRepository = $usersRepository;
    }

    /**
     * Get the index page for the account settings.
     *
     * @return View
     */
    public function index(): View
    {
        return view('account-settings.index', ['user' => $this->usersRepository->find(auth()->user()->id)]);
    }

    /**
     * Update the account information in the system.
     *
     * @param AccountInfoValidator $input
     * @return RedirectResponse
     */
    public function editInfo(AccountInfoValidator $input): RedirectResponse
    {
        if ($this->usersRepository->update($input->except('_token'), auth()->user()->id)) {
            flash(trans('account-settings.flash-edit-info-success'))->success();
        }

        return redirect()->route('account.settings');
    }

    /**
     * Update the account security in the system.
     *
     * @param  AccountSecurityValidator $input
     * @return RedirectResponse
     */
    public function editSecurity(AccountSecurityValidator $input): RedirectResponse
    {
        $data = ['password' => bcrypt($input->password)];

        if ($this->usersRepository->update($data, auth()->user()->id)) {
            flash('account-settings.flash-edit-security-success')->success();
        }

        return redirect()->route('account.settings');
    }
}
