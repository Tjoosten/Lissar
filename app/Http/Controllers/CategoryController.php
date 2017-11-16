<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryValidator;
use App\Repositories\CategoryRepository;
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

    /**
     * CategoryController constructor.
     *
     * @param  CategoryRepository $categoryRepository The abstraction layer between controller and database.
     * @return void
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->middleware('auth');
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Get the index page for the helpodesk category management console.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('categories.index', [
            'categories' => $this->categoryRepository->findWhere(['module' => 'helpdesk'])
        ]);
    }

    public function create(): View
    {

    }

    public function store(CategoryValidator $input): RedirectResponse
    {

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
