<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketValidator;
use App\Repositories\{CategoryRepository, UsersRepository, TicketsRepository, PriorityRepository};
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class TicketController
 *
 * @package App\Http\Controllers
 */
class TicketController extends Controller
{
    private $ticketsRepository;     /** @var TicketsRepository  $ticketsRepository  */
    private $usersRepository;       /** @var UsersRepository    $usersRepository    */
    private $categoryRepository;    /** @var CategoryRepository $categoryRepository */

    /**
     * TicketController constructor.
     *
     * @param  TicketsRepository $ticketsRepository Abstraction layer bewteen controller and database.
     * @param  UsersRepository   $usersRepository   Abstraction layer between controller and database.
     * @return void
     */
    public function __construct(TicketsRepository $ticketsRepository, UsersRepository $usersRepository, CategoryRepository $categoryRepository)
    {
        $this->middleware(['auth', 'forbid-banned-user']);

        $this->usersRepository    = $usersRepository;
        $this->ticketsRepository  = $ticketsRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Index page for the support tickets.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('tickets.index', [
            'tickets'    => $this->ticketsRepository->entity(),
            'users'      => $this->usersRepository->entity(),
            'categories' => $this->categoryRepository->paginate(10),
        ]);
    }

    /**
     * Create view for a support ticket.
     *
     * @param  CategoryRepository $categoryRepository Abstraction layer between controller and category database.
     * @return \Illuminate\View\View
     */
    public function create(CategoryRepository $categoryRepository, PriorityRepository $priorityRepository): View
    {
        return view('tickets.create', [
            'categories' => $categoryRepository->entity()->where(['module', 'helpdesk']), 
            'priorities' => $priorityRepository->all(['id', 'name']),
            'users'      => $this->usersRepository->entity()->role('admin', 'verantwoordelijke')->get(),
            'tickets'    => $this->ticketsRepository->entity(),
        ]);
    }

    /**
     * Store the bug ticket in the system.
     *
     * @param  TicketValidator $input The user given input. (validated)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TicketValidator $input): RedirectResponse
    {
        $user = $this->usersRepository->current();
        $input->merge(['author_id' => $user->id]);

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
