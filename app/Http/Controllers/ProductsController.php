<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
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
     * @param  ProductRepository $productRepository Âbstraction layer between database and controller.
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
}
