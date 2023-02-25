<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Http\Requests\ProductRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return Inertia::render('Products/Index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::whereNull('category_id')->get();
        $subcategories = Category::whereNotNull('category_id')->get();

        return Inertia::render('Products/Create', [
            'categories' => $categories,
            'subcategories' => $subcategories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        if ($request->file('file')) {

            $file = $request->file('file');
            $extension = pathinfo($file->getClientOriginalExtension(), PATHINFO_FILENAME);
            $filename = time() . time() . Str::random(4) . '.' . $extension;

            Storage::disk('public')->put('products' . '/' . $filename, File::get($file));

            $request->merge(['img' => $filename]);
        }

        Product::create($request->all());

        return Redirect::route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::whereNull('category_id')->get();
        $subcategories = Category::whereNotNull('category_id')->get();

        return Inertia::render('Products/Edit', [
            'categories' => $categories,
            'product' => $product,
            'subcategories' => $subcategories
        ]);
    }

    public function editstock(Product $product)
    {
        return Inertia::render('Products/Editstock', [
            'product' => $product,
        ]);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $input = $request->all();

        if ($request->file('file')) {

            if (Storage::disk('public')->exists('products/' . $product->img)) {
                Storage::disk('public')->delete('products' . '/' . $product->img);
            }

            $file = $request->file('file');
            $extension = pathinfo($file->getClientOriginalExtension(), PATHINFO_FILENAME);
            $filename = time() . time() . Str::random(4) . '.' . $extension;

            Storage::disk('public')->put('products' . '/' . $filename, File::get($file));

            $input['img'] = $filename;
        }

        $product->update($input);

        return Redirect::route('products.index');
    }

    public function updateStock(Request $request, Product $product)
    {
        $input = $request->all();

        $product->update($input);

        return Redirect::route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if (Storage::disk('public')->exists('products/' . $product->img)) {
            Storage::disk('public')->delete('products' . '/' . $product->img);
        }

        $product->delete();
        return Redirect::route('products.index');
    }

    public function getSupportingData()
    {
        $categories = Category::index(['name as text', 'id as value']);

        return [
            'categories' => $categories
        ];
    }
    public function updatePrice()
    {

        $products = DB::table('base_productos')->get();
        // dd($products);
        foreach ($products as $product) {
            # code...
            $modelproduct = Product::where('barcode', $product->barcode)->first();

            $modelproduct->sale_price = $product->sale_price;
            $modelproduct->stock = $product->stock;
            $modelproduct->save();
        }
        sleep(1);

        return Redirect::route('products.index');
    }
    public function getProduct(Request $request)
    {
        $products = Product::getAllData($request);

        if (empty($request->reqType)) {
            return ['datarows' => $products['data'], 'count' => $products['count']];
        } else {
            return ['datarows' => $products];
        }
    }

    public function export()
    {
        $categories = Category::whereNull('category_id')->get();
        $records = Product::all();

        return (new ProductsExport)
            ->records($records)
            ->categories($categories)
            ->download('Productos_'. Carbon::now() .'.xlsx');
    }
}
