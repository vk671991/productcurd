<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Validator;
class ProductController extends Controller
{
     // to add product in catalog
    public function createproduct(Request $request){
      $validated = array(
        'producttitle' => 'required',
        'productprice' => 'required',
        'productcategory' => 'required',
    );
          $validate_data=Validator::make($request->all(),$validated);
             if ($validate_data->fails()) {
                return $validate_data ->errors();
            }
     
            $create_request=$request->all();
            $producttile=$create_request['producttitle'];
            $productdescription=$create_request['productdescription'];
            $productprice=$create_request['productprice'];
            $productcategory=$create_request['productcategory'];
            $file='';
              if(!empty($request->file())){
                  $file = $request->file('productimage');
              }
       $filename = rand(10,200).time().'_'.$file->getClientOriginalName();
       $path = $file->storeAs('public/files',$filename);
       $create[]=['Product_Title'=>$producttile,'Product_Description'=>$productdescription,'Product_Price'=>$productprice,'Product_Image_Path'=>$path,'Product_Category'=>$productcategory,'Product_Status'=>1,'created_time'=>date('Y-m-d H:i:s'),'modified_time'=>date('Y-m-d H:i:s')];
       DB::table('products_model')->insert($create);
       $paging=DB::table('products_model')->paginate(5);
       $data = 'Added successfully';
              return response()->json(array(
                   'success' => true,
                   'msg'   => $data,
                   'paging'=>$paging
              ));
    }

   // to update product from catalog
    public function updateproduct(Request $request){
        $id = $request->id;
        $producttile = $request->producttitle;
        $productdescription = $request->productdescription;
        $productprice = $request->productprice;
        $productimage = $request->productimage;
        $productcategory = $request->productcategory;
        $validated = array(
        'id' => 'required|nullable',
        'producttitle'=>'required|nullable',
        'productprice'=>'required|nullable',
        'productdescription'=>'required|nullable',
        'productcategory'=>'required|nullable'
        );
          $validate_data=Validator::make($request->all(),$validated);
             if ($validate_data->fails()) {
                return $validate_data ->errors();
            }
     
        $data = DB::table('products_model')
                        ->where('id', $id)
                        -> update(['Product_Title' => $producttile,'Product_Description'=>$productdescription,
                          'Product_Price'=>$productprice,'Product_Image_Path'=>$productimage,'Product_Category'=>$productcategory]);
     
       $paging=DB::table('products_model')->paginate(5);
        return response()->json(array(
         'success' => true,
         'data'   => "Updated Successfully",
         'paging'=>$paging
       ));

    }

     // to select product from catalog
    public function getproduct(Request $request){
      $data=DB::select("select * from products_model order by id DESC");
      $paging=DB::table('products_model')->paginate(5);
        return response()->json(array(
         'success' => true,
         'data'   => $data,
          'paging'=>$paging
       ));

    }

   // to delete product from catalog .Here we are not deleting the records we are updating the flag product status in db which indictes product deleted we can also use softdeletes.
    public function cancelproduct(Request $request,$id){
        $validated = array(
        'id' => 'required|nullable'
        );
          $validate_data=Validator::make($request->all(),$validated);
             if ($validate_data->fails()) {
                return $validate_data ->errors();
            }
        $id =$request->id;
        $data=DB::table('products_model')
                  ->where('id', $id)
                  -> update(['Product_Status'=>0]);
        $paging=DB::table('products_model')->paginate(5);
        return response()->json(array(
         'success' => true,
         'data'   => "Delete Successfully",
         'paging'=>$paging
       ));
    }

}
