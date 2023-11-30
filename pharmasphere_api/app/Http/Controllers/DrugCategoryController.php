<?php

namespace App\Http\Controllers;

use App\Models\DrugCategories as DrugCategory;
use Illuminate\Http\Request;

class DrugCategoryController extends Controller
{
    public function index()
    {
        $drugCategories = DrugCategory::all();
        return response()->json($drugCategories);
    }

    public function create()
    {
        // Return a view or data for creating a new drug category
    }

    public function store(Request $request)
    {
        $drugCategory = DrugCategory::create($request->all());
        return response()->json($drugCategory, 201);
    }

    public function show(DrugCategory $drugCategory)
    {
        return response()->json($drugCategory);
    }

    public function edit(DrugCategory $drugCategory)
    {
        // Return a view or data for editing the specified drug category
    }

    public function update(Request $request, DrugCategory $drugCategory)
    {
        $drugCategory->update($request->all());
        return response()->json($drugCategory);
    }

    public function destroy(DrugCategory $drugCategory)
    {
        $drugCategory->delete();
        return response()->json([
            'message' => 'Deleted successfully.'
        ], 204);
    }
}