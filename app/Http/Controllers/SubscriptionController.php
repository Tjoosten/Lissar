<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class SubscriptionController
 *
 * @package App\Http\Controllers
 */
class SubscriptionController extends Controller
{
    /**
     * SubscriptionController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Get the index management console for the subscriptions.
     *
     * @return View
     */
    public function index(): View
    {
        return view();
    }
}
