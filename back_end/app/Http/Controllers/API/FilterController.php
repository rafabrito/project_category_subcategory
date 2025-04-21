<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\SubcategoryResource;

class FilterController extends Controller
{
    /**
     * Display a listing filtered of the categories or subcategories.
     */
    public function filterCategorySubcategory(Request $request)
    {
        $textFilter = $request->textFilter;
        $typeFilter = $request->typeFilter;
        $dataFilter = null;

        if(!empty($textFilter) and $typeFilter === 'categories') {
            $categories = Category::with(['subcategory' => 
            function($query) {
                    $query->orderBy('created_at', 'DESC');      
            }])->where('name', '=', $textFilter)->orWhere('name', 'like', "{$textFilter}%")->orderBy('created_at', 'DESC')->paginate(4);
        
            $dataFilter = CategoryResource::collection($categories); // retorna os dados json rotulados como data 
            
            return response()->json($dataFilter->resource);
        
        } else if (!empty($textFilter) and $typeFilter === 'subcategories'){
            return response()->json(['data' => 'entrou no else if']);
        }
        
        // recuperar categorias e suas respectivas subcategorias ordenadas decrescentemente
        // $categories = Category::with(['subcategory' => 
        // function($query) {
        //     $query->orderBy('created_at', 'DESC');      
        // }])->orderBy('created_at', 'DESC')->paginate(4);
        
        // $categories =  CategoryResource::collection($categories); // retorna os dados json rotulados como data 
        
        return response()->json(['data' => 'não entrou nas condições']);
    }
}
