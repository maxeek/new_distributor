<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Category::whereNull('category_id')->get();
        $subcategories = Category::whereNotNull('category_id')->get();

        return Inertia::render('Client/Dashboard', [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'isClient' => true
        ]);
    }
}
