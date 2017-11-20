<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Repositories\NotificationsRepository;
use Illuminate\View\View;
use Illuminate\Http\{Response, RedirectResponse};

/**
 * Class ProductsController
 *
 * @package App\Http\Controllers
 */
class NotificationsController extends Controller
{
    private $notificationsRepository; /** @var NotificationsRepository $notificationsRepository */
    
    /**
     * NotificationsController constructor 
     * 
     * @param  NotificationsRepository $notificationsRepository Abstraction layer between controller and model.
     * @return void
     */
    public function __construct(NotificationsRepository $notificationsRepository) 
    {
        $this->middleware('auth');
        $this->notificationsRepository = $notificationsRepository;
    }

    /**
     * Index page for the notifications.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('notifications.index', [
            'unreadNotifications' => auth()->user()->unreadNotifications()->paginate(10),
            'readNotifications'   => auth()->user()->notifications()->paginate(10)
        ]); 
    }

    /**
     * Mark one notification as read.
     *
     * @param  string $notificationId The unique identifier in the storage.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markAsRead($notificationId): RedirectResponse
    {
        $notification = $this->notificationsRepository->find($notificationId) ?: abort(Response::HTTP_NOT_FOUND);
        $notification->update(Carbon::now());

        return redirect()->route($ntofication->data['route']);
    }

    /**
     * Mark all notification as read. 
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markAllAsRead(): RedirectResponse
    {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->route('notifications.index');
    }
}
