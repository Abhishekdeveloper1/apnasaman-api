<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductCategory extends Model
{
    use HasFactory;
    // protected $table = 'product_categories';
   
    public function productSubCategory(): HasMany
    {
        return $this->hasMany(ProductSubCategory::class,'foreign_key');  // Correct relationship definition
        // return $this->hasMany(ProductSubCategory::class);  // Correct relationship definition

    }
}

