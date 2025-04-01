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
        // recuperar categorias e suas respectivas subcategorias ordenadas decrescentemente
        $categories = Category::with(['subcategory' => 
        function($query) {
            $query->orderBy('created_at', 'DESC');      
        }])->orderBy('created_at', 'DESC')->paginate(4);
        
        $categories =  CategoryResource::collection($categories); // retorna os dados json rotulados como data 
        
        return response()->json($categories->resource);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateCategoryRequest $request)
    {
        $data = $request->validated(); // valida os camos da categoria

        $category = Category::create($data);

        $category =  new CategoryResource($category); // construir o dado json da categoria rotulado como data
        
        return response()->json($category->resource); 

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);

        $category = new CategoryResource($category); // construir o dado json da categoria rotulado como data

        return response()->json($category->resource);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateCategoryRequest $request, string $id)
    {
        $data = $request->all(); // recupera todos os dados presentes no request

        $category = Category::findOrFail($id); // encontra a categoria para atualização

        $category->update($data); // atualiza o dados da categoria

        $category =  new CategoryResource($category); // retorna os dados rotulados como data
        
        return response()->json($category->resource); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id); // encontra a categoria para remoção
        $category->delete(); // deletar categoria

        // recuperar categorias e suas respectivas subcategorias ordenadas decrescentemente
        $categories = Category::with(['subcategory' => 
        function($query) {
            $query->orderBy('created_at', 'DESC');      
        }])->orderBy('created_at', 'DESC')->paginate(4);

        $categories =  CategoryResource::collection($categories); // retorna os dados rotulados como data
        
        return response()->json($categories->resource);
    }
}
