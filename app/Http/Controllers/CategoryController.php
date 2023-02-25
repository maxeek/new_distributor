<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Category::query();

        if (request('search')) {
            $query->where('name', 'LIKE', '%' . request('search') . '%');
        }

        if (request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        }

        return Inertia::render('Categories/Index', [
            'categories' => $query->with('category')->paginate(100)->withQueryString(),
            'filters' => request()->all(['search', 'field', 'direction'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::whereNull('category_id')->get();

        return Inertia::render('Categories/Create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        if ($request->file('file')) {

            $file = $request->file('file');
            $extension = pathinfo($file->getClientOriginalExtension(), PATHINFO_FILENAME);
            $filename = time() . time() . Str::random(4) . '.' . $extension;

            Storage::disk('public')->put('categories' . '/' . $filename, File::get($file));

            $request->merge(['img' => $filename]);
        }

        Category::create($request->all());

        return Redirect::route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::whereNull('category_id')->get();

        return Inertia::render('Categories/Edit', [
            'category' => $category,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        if ($request->file('file')) {

            if (Storage::disk('public')->exists('categories/' . $category->img)) {
                Storage::disk('public')->delete('categories' . '/' . $category->img);
            }

            $file = $request->file('file');
            $extension = pathinfo($file->getClientOriginalExtension(), PATHINFO_FILENAME);
            $filename = time() . time() . Str::random(4) . '.' . $extension;

            Storage::disk('public')->put('categories' . '/' . $filename, File::get($file));

            $request->merge(['img' => $filename]);
        }

        $category->update($request->all());

        return Redirect::route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if (Storage::disk('public')->exists('categories/' . $category->img)) {
            Storage::disk('public')->delete('categories' . '/' . $category->img);
        }

        $category->delete();
        return Redirect::route('categories.index');
    }
}
