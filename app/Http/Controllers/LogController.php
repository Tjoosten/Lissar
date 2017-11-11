<?php

namespace App\Http\Controllers;

use App\Repositories\ActivityRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class LogController
 *
 * @package App\Http\Controllers
 */
class LogController extends Controller
{
    private $activityRpeository; /** @var ActivityRepository $activityRepository */

    /**
     * LogController constructor.
     *
     * @param  ActivityRepository $activityRepository Abstraction layer between database and controller.
     * @return void
     */
    public function __construct(ActivityRepository $activityRepository)
    {
        $this->middleware('auth');
        $this->activityRpeository = $activityRepository;
    }

    /**
     * Get the index  view for the platform activity.
     *
     * @return View
     */
    public function index(): View
    {
        return view('activity.index', ['activities' => $this->activityRpeository->paginate(25)]);
    }
}
