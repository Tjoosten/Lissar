<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusValidator;
use App\Repositories\{StatusRepository, TicketsRepository};
use Illuminate\Http\RedirectResponse; 
use Illuminate\View\View;

/**
 * TODO: Implement docblock
 */
class StatusController extends Controller
{
    private $statusRepository;  /** @var StatusRepository   $statusRepository  */
    private $ticketsRepository; /** @var TicketsRepository  $ticketsRepository */

    /**
     * StatusController constructor
     *
     * @param  StatusRepository  $statusRepository  Abstraction layer between database and controller.
     * @param  TicketsRepository $ticketsRepository Abstraction layer between database and controller. 
     * @return void
     */
    public function __construct(StatusRepository $statusRepository, TicketsRepository $ticketsRepository) 
    {
        $this->middleware(['auth']);

        $this->statusRepository  = $statusRepository;
        $this->ticketsRepository = $ticketsRepository; 
    }

    /**
     * Get the index page for the helpdesk status management.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('status.index', [
            'tickets'   => $this->ticketsRepository->entity(), 
            'statusses' => $this->statusRepository->paginate(10)
        ]);
    }

    /**
     * Get the create page for a new status.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View 
    {
        return view('status.create', ['tickets' => $this->ticketsRepository->entity()]); 
    }

    /**
     * Store the status in the storage
     *
     * @param  StatusValidator $input   The user given input (Validated).
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StatusValidator $input): RedirectResponse
    {
        return '<code>Implement user logic.</code>';
    }

    /**
     * Edit view for the helpdesk status.
     *
     * @param  integer $statusId The unique identifier in the storage
     * @return \Illuminate\View\View
     */
    public function edit($statusId): View
    {
        return '<code>Implement view</code>';
    }

    /**
     * Update the status in the storage. 
     *
     * @param  StatusValidator  $input      The given user input (Validated).
     * @param  integer          $statusId   The unique identifier in the storage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StatusValidator $input, $statusId): RedirectResponse
    {
        //
    }

    /**
     * Delete the status out off the storage
     *
     * @param  integer $statusId    The unique identifier in the storage.
     * @return RedirectResponse
     */
    public function destroy($statusId): RedirectResponse 
    {
        return '<code>Build up the logic</code>';
    }
}
