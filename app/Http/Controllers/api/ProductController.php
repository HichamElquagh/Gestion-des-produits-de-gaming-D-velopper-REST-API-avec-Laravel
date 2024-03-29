<?php

namespace App\Http\Controllers\api;

use App\Models\Product;
use Illuminate\Http\Request;
use  App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProductRequest;
use  App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        return response()->json([
            'status' => true,
            'message' => 'Products retrieved successfully!',
            'data' => ProductResource::collection(Product::all()),
        ], Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createProduct()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeProduct(StoreProductRequest $request)
    {
        //
        $id=Auth::user()->id;
        $storeproduct = Product::create($request->validated()+ ['user_id'=> $id]);

        if($storeproduct){ 
        return response()->json([
          'status'=>true,
          'product'=>'Product created',
          'product'=> new ProductResource($storeproduct)
        ]);
    }
    else{
       return response()->json([
         'status'=>false,
         'product'=>'erreur'
       ]);
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function showproduct(Product $product, $id)
    {
        //
        $showproduct = $product->find($id);
        
        if($showproduct){
            return response()->json([
                'status'=>true,
                'product'=>new ProductResource($showproduct)
            ]);
        }
        else  {
                return response()->json([
                    'status'=>false,
                    'product'=>'erreur'
                ]);
        }
       

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function updateProduct(StoreProductRequest $request, Product $product ,$id)
    {
        //
        $updateproduct = $product->find($id);
        $user = Auth::user();
         if(!$user->can('edit all product') && $user->id != $product->user_id){
            return response()->json([
                'status'=>false,
                'product'=>"You don't have permission to edit this product!"
            ]);
         }
         else {
        $updateproduct->update($request->validated());
        return response()->json([
            'status' => true,
            'message' => "Product updated successfully!",
            'data' => new ProductResource($updateproduct)
        ]);
    }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function deleteProdcut(Product $product, $id)
    {
        //
        $deleteproduct = $product->find($id);
        $user = Auth::user();
        if(!$user->can('edit All product') && $user->id != $product->user_id){
            return response()->json([
                'status'=>false,
                'product'=>"You don't have permission to delete this product!"
            ]);
         }
         else {
        $deleteproduct->delete();
        return response()->json([
            'status' => true,
            'message' => "Product deleted successfully!"
        ]);
    }

        
        
    }
}
