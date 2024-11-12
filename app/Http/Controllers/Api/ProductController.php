<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Crypt;
class ProductController extends Controller
{
  public function index($subcategory_id)
  {
  
    $products = Product::where('subcategory_id', $subcategory_id)->get();
    if ($categoriesWithSubcategories->isNotEmpty()) {
      $encryptedProducts = Crypt::encrypt($products->toJson());
      // print_r($encryptedProducts);die;
      return response()->json($encryptedProducts, 200);
    }
    else
    {
      $products = Product::all();
      $encryptedProducts = Crypt::encrypt($products->toJson());
      return response()->json($encryptedProducts, 200);



    }
   

    // Send the encrypted data as a JSON response
  } 
}
