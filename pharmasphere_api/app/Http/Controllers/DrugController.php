<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use Illuminate\Http\Request;

class DrugController extends Controller
{
    public function index()
    {
        $drugs = Drug::all();
        return response()->json($drugs);
    }

    public function create()
    {
        // 
    }

    public function store(Request $request)
    {
        $drug = Drug::create($request->all());
        return response()->json($drug, 201);
    }

    public function show(Drug $drug)
    {
        return response()->json($drug);
    }

    public function edit(Drug $drug)
    {
        // Return a view or data for editing the specified drug
    }

    public function update(Request $request, Drug $drug)
    {
        $drug->update($request->all());
        return response()->json($drug);
    }

    public function destroy(Drug $drug)
    {
        $drug->delete();
        // delete all values from purchases table where drug_id = $drug->id
        $drug->purchases()->delete();
        return response()->json(null, 204);
    }
    
    // List of all drugs by category from the db
    public function drugCategory(){
        $drugs = Drug::orderBy('category_id', 'asc')->get();
        return response()->json($drugs);
    }
}