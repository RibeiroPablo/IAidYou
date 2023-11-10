<?php

declare (strict_types=1);

namespace App\Http\Controllers;

use App\Models\HelpCategory;

class HelpCategoryController extends Controller
{
    public function index()
    {
        $categories = HelpCategory::get();

        return response()->json(['message' => 'Categories retrieved successfully.', 'categories' => $categories]);
    }
}
