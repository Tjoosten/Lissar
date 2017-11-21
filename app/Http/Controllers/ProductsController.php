<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductValidator;
use App\Repositories\ProductRepository;
use Illuminate\Http\{RedirectResponse, Response};
use Illuminate\View\View;

/**
 * Class ProductsController
 *
 * @package App\Http\Controllers
 */
class ProductsController extends Controller
{
    private $productRepository; /** @var ProductRepository $productRepository */

    /**
     * ProductsController constructor.
     *
     * @param  ProductRepository $productRepository abstraction layer between database and controller.
     * @return void
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->middleware(['auth', 'forbid-banned-user']);
        $this->productRepository = $productRepository;
    }

    /**
     * Get the product index page.
     *
     * @return View
     */
    public function index(): View
    {
        return view('products.index', [
            'drinks'     => $this->productRepository->entity()->where('type', 'drank'),
            'foods'      => $this->productRepository->entity()->where('type', 'Eten'),
            'drinkCards' => $this->productRepository->entity()->where('type', 'Drankkaart')
        ]);
    }

    /**
     * Create view for new product that we provide by the subscription.
     *
     * @return View
     */
    public function create(): View  
    {
        return view('products.create');
    }

    /**
     * Store a new product in the database. 
     *
     * @param  ProductValidator $input The given user input (Validated).
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductValidator $input): RedirectResponse // TODO: implement activity monitor, Implement translation for flash message. 
    {
        $input->merge(['author_id' => auth()->user()->id]); // Merge the user from the current session in the inputs.

        if ($product = $this->productRepository->create($input->except('_token'))) {
            flash("het product '{$product->name}' is opgeslagen in het systeem.")->success();
        } 

        return redirect()->route('products.index');
    }

    /**
     * Delete an product out off the storage.
     *
     * @param  integer $productId The unique identifier from the storage.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($productId): RedirectResponse // TODO: implement activity monitor, Implement translation for flash message. 
    {
        $product = $this->productRepository->find($productId) ?: abort(Response::HTTP_NOT_FOUND);

        if ($product->delete()) {
            flash("Het product '{$product->name}' is verwijderd uit het systeem.")->success();
        }

        return redirect()->route('products.index');
    }
}
