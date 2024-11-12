<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\ProductsubCategory;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class ProductCategoryController extends Controller
{
    public function index()
    {
      $productCategories=ProductCategory::all();
      if ($productCategories->isNotEmpty()) {      
        Log::info('Product List:', [$productCategories]);
        return response()->json($productCategories, 200);
      }
      else
      {
        Log::info('Product list not avilable');
        return response()->json(['error' => 'Product list not avilable'], 404);

      }
    }


    public function getCategoriesWithSubcategories()
    {
      $categoriesWithSubcategories = DB::table('product_categories as p')
    ->join('productsub_categories as s', 'p.id', '=', 's.category_id')
    ->select('p.id as categoryId', 'p.category_name as productname', 's.name as subcategoryname', 's.id as subcategoryID')
    ->get();
    
// print_r($categories);die;
    if ($categoriesWithSubcategories->isNotEmpty()) {
      
      Log::info('Categories with Subcategories Retrieved:', $categoriesWithSubcategories->toArray());
      $categories = [];
    foreach ($categoriesWithSubcategories as $item) {
        // If the category is not already in the array, add it with an empty subcategories array
        if (!isset($categories[$item->categoryId])) {
            $categories[$item->categoryId] = [
                'categoryId' => $item->categoryId,
                'productname' => $item->productname,
                'subcategories' => []
            ];
        }
        
        // Add each subcategory to the category's subcategories array
        $categories[$item->categoryId]['subcategories'][] = [
            'subcategoryID' => $item->subcategoryID,
            'subcategoryname' => $item->subcategoryname
        ];
    }

    // Re-index the array to get a standard indexed array
    $categories = array_values($categories);
      return response()->json($categories, 200);
  } else {
      Log::info('No Categories with Subcategories Found');
      return response()->json(['error' => 'No categories with subcategories available'], 404);
  }
    // print_r($categoriesWithSubcategories);die;
        // Retrieve categories with their subcategories
        // $categories = ProductCategory::with('subcategories:id,category_id,name')->get(['id as categoryId', 'category_name as productname']);

        // // Check if categories were found and log appropriately
        // if ($categories->isNotEmpty()) {
        //     Log::info('Categories with Subcategories Retrieved:', $categories->toArray());
        //     return response()->json($categories, 200);
        // } else {
        //     Log::info('No Categories with Subcategories Found');
        //     return response()->json(['error' => 'No categories with subcategories available'], 404);
        // }
    }
}