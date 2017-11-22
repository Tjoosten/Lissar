<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Http\Requests\SubscriptionValidator;
use App\Repositories\{SubscriptionRepository, ProductRepository}; 
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
    private $productRepository;       /** @var ProductRepository      $productRepository       */

    /**
     * SubscriptionController constructor.
     *
     * @param  ProductRepository      $productRepository       Abstraction layer between database and controller. 
     * @param  SubscriptionRepository $subscriptionsRepository Abstraction layer between database and controller.
     * @return void
     */
    public function __construct(SubscriptionRepository $subscriptionsRepository, ProductRepository $productRepository)
    {
        $this->middleware(['auth', 'forbid-banned-user']);
        
        $this->productRepository       = $productRepository;
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
     * Search for a specific subscription.
     *
     * @param  Request $input
     * @return \Illuminate\View\View
     */
    public function search(Request $input): View
    {
        return view('subscriptions.index', [
            'subscriptions' =>$this->subscriptionsRepository->entity()->where('name', "%{$input->term}%")->paginate(25)
        ]);
    }

    /**
     * Get the create view for a new subscription.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View 
    {
        return view('subscriptions.create', ['products' => $this->productRepository->entity()->where('type', 'Eten')->get()]);
    }

    /**
     * Store the new subscription in the storage. 
     *
     * @param  SubscriptionValidator $input The given user input (Validated).
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SubscriptionValidator $input): RedirectResponse
    {
        // TODO: fill in the form validation.

        if ($subscription = $this->subscriptionsRepository->create($input->except(['token', 'orders']))) {
            foreach ($input->order as $order)  {
                if ($this->subscriptionsRepository->isEmptyPersonen($order['personen'])) {
                    $subscription->orders()->attach($order['product'], ['personen' => $order['personen']]);
                    $subscription->notify((new OrderComplete($input))->delay(Carbon::now()->addMinutes(2)));

                    flash("De inschrijving is toegevoegd in het systeem.")->success();
                    activity()->performedOn($subscription)->causedBy(auth()->user())->log(trans('activity-log.subscription-create', ['author' => auth()->user()]));
                } // END Order pivoting
            } // END order loop
        } // END Subscription insert

        return redirect()->route('ins§è) chrijvingen.index');
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
     * Update the product in the storage
     *
     * @return \Illuminate\Http\RedirectResponse
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
        $subscription = $this->subscriptionsRepository->find($subscription) ?: abort(Response::HTTP_NOT_FOUND);

        if ($subscription->delete()) { // Subscription has been deleted in the system.
            flash("De inschrijving van {$subscription->name} is verwijderd uit het systeem")->success();
        }

        return redirect()->route('subscriptions.index');
    }
}
