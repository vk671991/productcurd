<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Models\ProductModel;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = ProductModel::paginate(10);
        return ProductResource::collection($posts);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product=new ProductModel();
        $product->Product_Title=$request->producttitle;
        $product->Product_Description=$request->productdescription;
        $product->Product_Price=$request->productprice;
        $product->Product_Image_Path=$request->productimage;
        $product->Product_Category=$request->productcategory;

        if($product->save()){
              return new ProductResource($product);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $product=ProductModel::findorFail($id);
         return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $product=ProductModel::findorFail($id);
        $product->Product_Title=$request->producttitle;
        $product->Product_Description=$request->productdescription;
        $product->Product_Price=$request->productprice;
        $product->Product_Image_Path=$request->productimage;
        $product->Product_Category=$request->productcategory;

        if($product->save()){
              return new ProductResource($product);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=ProductModel::findorFail($id);
        if($product->delete()){
              return new ProductResource($product);
        }
    }
}
