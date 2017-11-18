<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketValidator;
use App\Repositories\{CategoryRepository, UsersRepository, TicketsRepository};
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class TicketController
 *
 * @package App\Http\Controllers
 */
class TicketController extends Controller
{
    private $ticketsRepository; /** @var TicketsRepository $ticketsRepository */
    private $usersRepository;   /** @var UsersRepository   $usersRepository   */

    /**
     * TicketController constructor.
     *
     * @param  TicketsRepository $ticketsRepository Abstraction layer bewteen controller and database.
     * @param  UsersRepository   $usersRepository   Abstraction layer between controller and database.
     * @return void
     */
    public function __construct(TicketsRepository $ticketsRepository, UsersRepository $usersRepository)
    {
        $this->middleware(['auth']);

        $this->usersRepository   = $usersRepository;
        $this->ticketsRepository = $ticketsRepository;
    }

    /**
     * Index page for the support tickets.
     *
     * @return View
     */
    public function index(): View
    {
        return view('tickets.index', [
            'tickets' => $this->ticketsRepository->entity(),    // TODO: Register tickets counts on the view.
            'users'   => $this->usersRepository->entity()
        ]);
    }

    /**
     * Create view for a support ticket.
     *
     * @param  CategoryRepository $categoryRepository Abstraction layer between controller and category database.
     * @return View
     */
    public function create(CategoryRepository $categoryRepository): View
    {
        return view('tickets.create', [
            'categories' => $categoryRepository->entity()->where(['module', 'helpdesk']), 
            'tickets'    => $this->ticketsRepository->entity(),
        ]);
    }

    /**
     * Store the bug ticket in the system.
     *
     * @param  TicketValidator $input The user given input. (validated)
     * @return RedirectResponse
     */
    public function store(TicketValidator $input): RedirectResponse
    {
        $user = $this->usersRepository->current();
        $input->merge(['author' => $user]);

        if ($ticket = $this->ticketsRepository->create($input->except('_token'))) {
            if ($user->hasRoles(['admin', 'verantwoordelijke'])) {
                activity()->performedOn($ticket)->causedBy($user)->log(trans('activity-log.ticket-create',
                    ['ticketTitle' => $ticket->title, 'author' => $user]
                ));
            }

            $message = trans('tickets.flash-store-success');
        }

        flash(isset($message) ? $message : trans('tickets.flash-flash-store-error'))->success();
        return redirect()->route('tickets.index');
    }
}
