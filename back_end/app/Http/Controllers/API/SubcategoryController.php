<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Category;
use App\Http\Resources\SubcategoryResource;
use App\Http\Requests\StoreUpdateSubcategoryRequest;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the subcategories.
     */
    public function index()
    {
        $subcategories = Subcategory::with('category')->orderBy('created_at', 'DESC')->paginate(5);
        $subcategories =  SubcategoryResource::collection($categories); // retorna os dados rotulados como data
        
        return response()->json($subcategories->resource);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validated(); // valida os camos da categoria

        $subcategory = Subcategory::create($data);

        // $subcategory =  new SubcategoryResource($subcategory); // retorna os dados rotulados como data
        // recuperar categorias e suas respectivas subcategorias ordenadas decrescentemente
        $categories = Category::with(['subcategory' => 
        function($query) {
            $query->orderBy('created_at', 'DESC');      
        }])->orderBy('created_at', 'DESC')->paginate(4);
        
        $categories =  CategoryResource::collection($categories); // retorna os dados json rotulados como data 
        
        return response()->json($categories->resource);
        // return response()->json($subcategory->resource); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subcategory = Subcategory::findOrFail($id);

        $subcategory = new SubcategoryResource($subcategory);

        return response()->json($subcategory->resource);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateSubcategoryRequest $request, string $id)
    {
        $data = $request->all(); // recupera todos os dados presentes no request

        $subcategory = Subcategory::findOrFail($id); // encontra a categoria para atualização

        $subcategory->update($data); // atualiza o dados da categoria

        $subcategory =  new SubcategoryResource($subcategory); // retorna os dados rotulados como data
        
        return response()->json($subcategory->resource);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->delete();

        return response()->json([], Response::HTTP_NO_CONTENT); 
    }
}
