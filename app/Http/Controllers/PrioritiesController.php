<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriorityValidator;
use App\Repositories\PriorityRepository;
use Illuminate\Http\{RedirectResponse, Response};
use Illuminate\View\View;

/**
 * Class PrioritiesController
 *
 * @package App\Http\Controllers
 */
class PrioritiesController extends Controller
{
    private $priorityRepository; /** PriorityRepository $priorityRepository */

    /**
     * PrioritiesController constructor.
     *
     * @param  PriorityRepository $priorityRepository
     * @return void
     */
    public function __construct(PriorityRepository $priorityRepository)
    {
        $this->middleware('auth');
        $this->priorityRepository = $priorityRepository;
    }

    /**
     * Management index view for the priorities.
     * !
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('priorities.index');
    }

    /**
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('priorities.create');
    }

    /**
     * @param  PriorityValidator $input The user given data (Validated).
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PriorityValidator $input): RedirectResponse
    {
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
            flash("De prioriteit '{$priority->name}' is verwijderd uit het systeem.")->success();
        }

        return redirect()->route('priorities.index');
    }
}
