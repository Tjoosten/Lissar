<?php

namespace App\Http\Controllers;

use App\Repositories\SubscriptionRepository; 
use Illuminate\Http\Request;
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

    public function create() 
    {

    }

    public function store() 
    {

    }

    public function edit() 
    {

    }

    public function update() 
    {

    }

    public function destroy() 
    {

    }
}
