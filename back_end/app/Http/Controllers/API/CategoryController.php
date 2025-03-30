<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\StoreUpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index(Request $request)
    {
       
        $categories = Category::with('subcategory')->orderBy('created_at', 'DESC')->paginate(5);
        $categories =  CategoryResource::collection($categories); // retorna os dados rotulados como data
        
        return response()->json($categories->resource);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateCategoryRequest $request)
    {
        $data = $request->validated(); // valida os camos da categoria

        $category = Category::create($data);

        $categories = Category::with('subcategory')->orderBy('created_at', 'DESC')->paginate(5);
        $categories =  CategoryResource::collection($categories); // retorna os dados rotulados como data
        
        return response()->json($categories->resource);

       // return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);

        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
