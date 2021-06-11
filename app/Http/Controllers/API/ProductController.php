<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['category', 'subcategory'])->latest()->paginate(5);
        return response()->json($products);
    }

    public function all()
    {
        $product_all = Product::with(['category', 'subcategory'])->latest()->get();
        return response()->json($product_all);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $validatedData = $request->validate([
            'productname' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required'
        ]);
        
        $product_id = Product::insertGetId([
            'name' => $request->productname,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->subcategory_id,
            'image' => 'photos/products/default.jpg',
            'created_at' => Carbon::now(),
        ]);
        

        if($request->product_image){
            $position = strpos($request->product_image, ';');
            $sub = substr($request->product_image, 0, $position);
            $file_extension = explode('/', $sub)[1];
            $name = time().".".$file_extension;
            $img = Image::make($request->product_image)->resize(800,800);
            $upload_path = 'photos/products/';
            $image_url = $upload_path.$name;
            $img->save($image_url);
            $product =  Product::find($product_id);
            $product->update([
                'image' => $image_url,
            ]);
        }

        return response()->json([
            'type' => 'success',
            'message' => "data inserted",
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with(['category', 'subcategory'])->findOrFail($id);
        return response()->json($product);
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
        $validatedData = $request->validate([
            'productname' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required'
        ]);
        
        $product = Product::findOrFail($id);

        $product->update([
            'name' => $request->productname,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->subcategory_id,
            'created_at' => Carbon::now(),
        ]);
        

        if($request->new_image){
            if($product->image){
                unlink($product->image);
            }
            $position = strpos($request->new_image, ';');
            $sub = substr($request->new_image, 0, $position);
            $file_extension = explode('/', $sub)[1];
            $name = time().".".$file_extension;
            $img = Image::make($request->new_image)->resize(800,800);
            $upload_path = 'photos/products/';
            $image_url = $upload_path.$name;
            $img->save($image_url);
            $product->update([
                'image' => $image_url,
            ]);
        }

        return response()->json([
            'type' => 'success',
            'message' => "data inserted",
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if($product->product_image){
            unlink($product->product_image); 
        }
        
        $product->delete();
        
        return response()->json([
            'type' => 'success',
            'message' => "data deleted",
        ],200);
    }
}
