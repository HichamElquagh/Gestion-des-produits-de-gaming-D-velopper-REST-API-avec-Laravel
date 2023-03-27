<?php

namespace App\Http\Controllers\api;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $showallcategory = Category::all();
            if($showallcategory){
                return response()->json([
                    'status'=>true,
                    'product'=>new CategoryResource($showallcategory)
                ]);
            }
            else  {
                    return response()->json([
                        'status'=>false,
                        'product'=>'erreur en category',
                    ]);
            }
           
        }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCategory(StoreCategoryRequest $request)
    {
        //
        $id=Auth::user()->id;
        $storecategory = Category::create($request->validated()+ ['user_id'=> $id]);

        if($storecategory){ 
        return response()->json([
          'status'=>true,
          'product'=>'Product created',
          'product'=> new CategoryResource($storecategory)
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function showCategory(Category $category, $id)
    {
        //
        $showcategory = $category->find($id);
        
        if($showcategory){
            return response()->json([
                'status'=>true,
                'product'=>new CategoryResource($showcategory)
            ]);
        }
        else  {
                return response()->json([
                    'status'=>false,
                    'product'=>'erreur en category',
                ]);
        }
       

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function updateCategory(UpdateCategoryRequest $request, Category $category,$id)
    {
        $updatecategory = $category->find($id);

         if(!$updatecategory){
            return response()->json([
                'status'=>false,
                'product'=>'erreur'
            ]);
         }
         else {
            $updatecategory->update($request->validated());
        return response()->json([
            'status' => true,
            'message' => "Product updated successfully!",
            'data' => new CategoryResource($updatecategory)
        ]);
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function deleteCategory(Category $category, $id)
    {
        //
        $deletecategory = $category->find($id);
        
        if(!$deletecategory){
            return response()->json([
                'status'=>false,
                'product'=>'erreur'
            ]);
         }
         else {
       $deletecategory->delete();
        return response()->json([
            'status' => true,
            'message' => "Product deleted successfully!"
        ]);
    }


    }
}
