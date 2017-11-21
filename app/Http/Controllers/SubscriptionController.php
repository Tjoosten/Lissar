<?php

namespace App\Http\Controllers;

use App\Repositories\SubscriptionRepository; 
use Illuminate\Http\{Response, RedirectResponse};
use Illuminate\View\View;

/**
 * Class SubscriptionController
 *
 * @package App\Http\Controllers
 */
class SubscriptionController extends Controller
{
    private $subscriptionsRepository; /** @var SubscriptionRepository $subscriptionsRepository */

    /**
     * SubscriptionController constructor.
     *
     * @param  SubscriptionRepository $subscriptionsRepository Abstraction layer between database and controller.
     * @return void
     */
    public function __construct(SubscriptionRepository $subscriptionsRepository)
    {
        $this->middleware(['auth', 'forbid-banned-user']);
        $this->subscriptionsRepository = $subscriptionsRepository;
    }

    /**
     * Get the index management console for the subscriptions.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('subscriptions.index', ['subscriptions' => $this->subscriptionsRepository->paginate(25)]);
    }

    /**
     * Get the create view for a new subscription.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View 
    {
        return view();
    }

    /**
     * Undocumented function
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(): RedirectResponse
    {

    }

    /**
     * Undocumented function
     *
     * @return \Illuminate\View\View
     */
    public function edit(): View 
    {

    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function update(): RedirectResponse
    {

    }

    /**
     * Delete a subscription in the storage.
     *
     * @param   integer $subscription The unique identifier in the storage.
     * @return  \Illuminate\Http\RedirectResponse
     */
    public function destroy($subscription): RedirectResponse // TODO: Implement activity logger. 
    {
        $subscription = $this->subscriptions->find($subscription) ?: abort(Response::HTTP_NOT_FOUND);

        if ($subscription->delete()) { // Subscription has been deleted in the system.
            flash("De inschrijving van {$subscription->name} is verwijderd uit het systeem")->success();
        }

        return redirect()->route('subscriptions.index');
    }
}
