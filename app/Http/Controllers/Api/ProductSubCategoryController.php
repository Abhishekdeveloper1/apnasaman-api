<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductsubCategory;
use Illuminate\Support\Facades\Log;


class ProductSubCategoryController extends Controller
{
    public function index()
    {
      $productSubCategories=ProductsubCategory::all();
      if ($productSubCategories->isNotEmpty()) {      
        Log::info('Product List:', [$productSubCategories]);
        return response()->json($productSubCategories, 200);
      }
      else
      {
        Log::info('Product list not avilable');
        return response()->json(['error' => 'Product subcategory list not avilable'], 404);

      }
    }
}
