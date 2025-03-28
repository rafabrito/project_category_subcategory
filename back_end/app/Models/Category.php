<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    protected $primaryKey = 'id';

    public function subcategory() {
        return $this->hasMany('App\Models\Subcategory','category_id', 'id');
    }
}
