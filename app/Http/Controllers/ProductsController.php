<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        $this->middleware(['auth']);
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
        return view(); 
    }

    public function store(): RedirectResponse
    {
        return redirect()->route('products.index');
    }

    /**
     * Delete an product out off the storage.
     *
     * @param  integer $productId The unique identifier from the storage.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($productId): RedirectResponse
    {
        $productId = $this->productRepository->find($productId) ?: abort(Response::HTTP_NOT_FOUND);

        return redirect()->route();
    }
}
