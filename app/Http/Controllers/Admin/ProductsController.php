<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Section;
use App\Category;
use Session;


class ProductsController extends Controller
{
  public function products(){
    Session::put('page','products');
    $products = Product::with(['category'=>function($query){
      $query->select('id','category_name');
    },'section'=>function($query){
      $query->select('id','name');
    }])->get();
    // $products = json_decode(json_encode($products));
    // echo "<pre>"; print_r($products); die;
    return view('admin.products.products')->with(compact('products'));
  }

  public function updateProductStatus(Request $request){
    if($request->ajax()){
      $data = $request->all();
      if($data['status']=="Active"){
        $status = 0;
      }else{
        $status = 1;
      }
      Product::where('id',$data['product_id'])->update(["status"=>$status]);
      return response()->json(['status'=>$status,'product_id'=>$data['product_id']]);
    }
  }

  public function deleteProduct($id){
    Product::where('id', $id)->delete();
    $message = 'Product deleted';
    session::flash('success_message',$message);
    return redirect()->back();
  }

  public function addEditProduct(Request $request,$id=null){
    if($id==""){
      $title = "Add Product";
      $product = new Product;
      $message = "Product added";

    }else{
      $title = "Edit Product";
      $message = "Product updated";
    }

    if($request->isMethod('post')){
      $data = $request->all();
      // echo "<pre>"; print_r($data); die;

      $rules = [
        'category_id' => 'required',
        'brand' => 'required|regex:/^[\w-]*$/',
        'name' => 'required|regex:/^[\pL\s\-]+$/u',
        'code' => 'required|regex:/^[\w-]*$/',
        'price' => 'required|numeric',
        // 'url' => 'required|regex:/^[\pL\s\-]+$/u',
        'image' => 'image',
      ];

      $customCategoryMessages = [
        'brand.required' => 'Brand is required',
        'brand.regex' => 'Invalid brand format',
        'category_id.required' => 'Choose a category',
        'name.required' => 'Product name is required',
        'name.regex' => 'Invalid name',
        'code.required' => 'Product code is required',
        'code.regex' => 'Invalid code',
        'price.required' => 'Product price is required',
        'price.numeric' => 'Price only numbers allowed',
        'image.image' => 'Image type invalid',
      ];

      $this->validate($request,$rules,$customCategoryMessages);

      if(empty($data['is_featured'])){
        $is_featured = 'No';
      }else{
        $is_featured = 'Yes';
      }
      // save info
      $categoryDetails = Category::find($data['category_id']);
      $product->section_id = $categoryDetails['section_id'];
      $product->category_id = $data['category_id'];
      $product->brand = $data['brand'];
      $product->name = $data['name'];
      $product->code = $data['code'];
      $product->price = $data['price'];
      $product->weight = $data['weight'];
      // $product->image = $data['image'];
      // $product->video = $data['video'];
      $product->description = $data['description'];
      $product->meta_title = $data['meta_title'];
      $product->meta_description = $data['meta_description'];
      $product->meta_keywords = $data['meta_keywords'];
      $product->is_featured = $is_featured;
      $product->status = 1;
      $product->save();

      session::flash('success_message',$message);
      return redirect('admin/products');

    }

    // Sections and Categories
    $categories = Section::with('categories')->get();
    $categories = json_decode(json_encode($categories),true);
    // echo "<pre>"; print_r($categories); die;


    return view('admin.products.add_edit_product')->with(compact('title','categories'));
  }





}
