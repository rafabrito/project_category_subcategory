<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\SubcategoryController;
use App\Http\Controllers\API\FilterController;

// Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
// Route::patch('/categories/{id}', [CategoryController::class, 'update']);
// Route::get('/categories/{id}', [CategoryController::class, 'show']);
// Route::get('/categories', [CategoryController::class, 'index']);
// Route::post('/categories', [CategoryController::class, 'store']);

// Rotas da api para o recurso '/categories' (index, show, store, update e delete)
Route::apiResource('/categories', CategoryController::class); // este função apresenta todas as funções pertencentes ao recurso categories

// Rotas da api para o recurso '/subcategories' (index, show, store, update e delete)
Route::apiResource('/subcategories', SubcategoryController::class); // este função apresenta todas as funções pertencentes ao recurso subcategories

// Rotas da api para o recurso '/filter'
Route::post('/filter', [FilterController::class, 'filterCategorySubcategory']);