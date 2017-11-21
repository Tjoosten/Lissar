<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriorityValidator;
use App\Repositories\{PriorityRepository, TicketsRepository};
use Illuminate\Http\{RedirectResponse, Response};
use Illuminate\View\View;

/**
 * Class PrioritiesController
 *
 * @package App\Http\Controllers
 */
class PrioritiesController extends Controller
{
    private $priorityRepository; /** @var PriorityRepository $priorityRepository */
    private $ticketsRepository;  /** @var TicketsRepository  $ticketsRepository  */

    /**
     * PrioritiesController constructor.
     *
     * @param  PriorityRepository $priorityRepository
     * @return void
     */
    public function __construct(PriorityRepository $priorityRepository, TicketsRepository $ticketsRepository)
    {
        $this->middleware(['auth', 'forbid-banned-user']);

        $this->priorityRepository = $priorityRepository;
        $this->ticketsRepository  = $ticketsRepository;
    }

    /**
     * Management index view for the priorities.
     * !
     * @return \Illuminate\View\View
     */
    public function index(): View // TODO: register options routes in the view.
    {
        return view('priorities.index', [
            'priorities' => $this->priorityRepository->paginate(20),
            'tickets'    => $this->ticketsRepository->entity()
        ]);
    }

    /**
     * Get the create view for a new helpdesk priority. 
     * 
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('priorities.create', ['tickets' => $this->ticketsRepository->entity()]);
    }

    /**
     * Store the new priority in the storage. 
     * 
     * @param  PriorityValidator $input The user given data (Validated).
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PriorityValidator $input): RedirectResponse
    {
        $input->merge(['author_id' => auth()->user()->id]); 

        if ($priority = $this->priorityRepository->create($input->except('_token'))) { // Priority has been stored. 
            // TODO: Implement activity monitor, Implement translation for flash message.
            flash("De prioriteit {$priority->name} is opgeslagen in het systeem.")->success();
        }

        return redirect()->route('priorities.index');
    }

    /**
     * Edit view in the application for a priority.
     *
     * @param  integer $priorityId The unique identifier in the storage.
     * @return \Illuminate\View\View
     */
    public function edit($priorityId): View
    {
        $priority = $this->priorityRepository->find($priorityId) ?: abort(Response::HTTP_NOT_FOUND);
        return view('priorities.edit', compact('priority'));
    }

    /**
     * Update an priority in the storage.
     *
     * @param  PriorityValidator    $input          The given user input. (Validated)
     * @param  integer              $priorityId     The unique identifier in the storage.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PriorityValidator $input, $priorityId): RedirectResponse
    {
        $priority = $this->priorityRepository->find($priorityId) ?: abort(Response::HTTP_NOT_FOUND);

        if ($update = $priority->update($input->except('_token'))) {
            // TODO: Implement activity monitor, Implement translation for flash message.
            flash("De prioriteit '{$update->name}' is aangepast in het systeem.")->success();
        }

        return redirect()->route('priorities.index');
    }

    /**
     * Delete a priority out of the storage.
     *
     * @param  integer $priorityId The unique identifier in the storage.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($priorityId): RedirectResponse
    {
        $priority = $this->priorityRepository->find($priorityId) ?: abort(Response::HTTP_NOT_FOUND);

        if ($priority->delete()) {
            // TODO: implement activity monitor, Implement translation for flash message. 
            flash("De prioriteit '{$priority->name}' is verwijderd uit het systeem.")->success();
        }

        return redirect()->route('priorities.index');
    }
}
