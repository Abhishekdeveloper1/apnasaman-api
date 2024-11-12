<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class ProductsubCategory extends Model
{
    use HasFactory;
    // protected $table = 'productsub_categories';
   

    public function productCategory(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'foreign_key', 'category_id');  // Correct relationship definition
    }
}

