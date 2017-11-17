<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryValidator;
use App\Repositories\{CategoryRepository, TicketsRepository};
use Illuminate\Http\{Response, RedirectResponse};
use Illuminate\View\View;

/**
 * Class CategoryController
 *
 * @package App\Http\Controllers
 */
class CategoryController extends Controller
{
    private $categoryRepository; /** @var CategoryRepository $categoryRepository */
    private $ticketsRepository;  /** @var TicketsRepository  $ticketsRepository  */

    /**
     * CategoryController constructor.
     *
     * @param  TicketsRepository  $ticketsRepository  The abstraction layer between controller and database.
     * @param  CategoryRepository $categoryRepository The abstraction layer between controller and database.
     * @return void
     */
    public function __construct(CategoryRepository $categoryRepository, TicketsRepository $ticketsRepository)
    {
        $this->middleware('auth');

        $this->categoryRepository = $categoryRepository;
        $this->ticketsRepository   = $ticketsRepository;
    }

    /**
     * Get the index page for the helpodesk category management console.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('categories.index', [
            'categories' => $this->categoryRepository->entity()->with(['author'])->where('module', 'helpdesk')->paginate(20),
            'tickets'    => $this->ticketsRepository->entity()
        ]);
    }

    /**
     * Create view in the database for a new helpdesk category.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('categories.create');
    }

    /**
     * Store a new ticket in the system.
     *
     * @param  CategoryValidator $input The user given input. (validated)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryValidator $input): RedirectResponse
    {
        return redirect()->route('categories.create');
    }

    /**
     * The dit view for a category in the system.
     *
     * @param  integer $categoryId The unique identifier in the storage.
     * @return \Illuminate\View\View
     */
    public function edit($categoryId): View
    {
        $category = $this->categoryRepository->find($categoryId) ?: abort(Response::HTTP_NOT_FOUND);
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the label in the storage.
     *
     * @param  CategoryValidator    $input          The user given input. (Validated).
     * @param  integer              $categoryId     The unique identifier in the storage.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryValidator $input, $categoryId): RedirectResponse
    {
        $category = $this->categoryRepository->find($categoryId) ?: abort(Response::HTTP_NOT_FOUND);

        if ($update = $category->update($input->except('_token'))) { // Category has been updated.
            flash("De category {$update->name} is aangepast in het systeem.")->success();
        }

        return redirect()->route('categories.index');
    }

    /**
     * Delete a category out off the system.
     *
     * @param  integer $categoryId The unique identifier in the storage.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($categoryId): RedirectResponse
    {
        $category = $this->categoryRepository->find($categoryId) ?: abort(Response::HTTP_NOT_FOUND);

        if ($category->delete()) { // Category has been deleted.
            flash('De categorie is verwijderd uit het systeem.')->success();
        }

        return redirect()->route('categories.index');
    }
}
