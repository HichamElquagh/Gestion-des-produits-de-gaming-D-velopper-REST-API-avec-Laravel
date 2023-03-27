<?php


namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use  App\Http\Controllers\Controller;
use App\Models\Product;

class SearchController extends Controller
{
    //
    public function search($search){

        // $produit=Produit::with('categorie')->where('categorieTitre','like',"$search%")->get();
        
        $product = Product::with('category')
        ->whereHas('category', function ($query) use ($search) {
            $query->where('name', 'like', "$search%");
        })
        ->get();


        if (!$product) {
            return response()->json([
                'status'=> true ,
               'status'=>'product not found',
            ]);
        }
        if ($product) {
            return response()->json([
               'status'=> true ,
               'status'=>'product with this categorie found',
               'product'=> $product,
            ]);
        }
    }
}
