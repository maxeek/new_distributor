<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Client;
use App\Models\Product;

use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

use Illuminate\Http\Request;

class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::whereNull('category_id')->get();
        $subcategories = Category::whereNotNull('category_id')->get();
        $clients = Client::orderBy('business_name', 'ASC')->get();

        return Inertia::render('Pos', [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'clients' => $clients,
            'isClient' => false
        ]);
    }

    public function filterProduct(Request $request)
    {
        $products = Product::getPosData($request);

        return $products;
    }
}
