<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        // $categories = Category::latest()->paginate(5);
        return CategoryResource::collection(Category::latest()->paginate(20));
        //return response()->json($categories, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request)
    {
        Category::create([
            'category_name' => $request->category_name,
            'category_slug' => Str::slug($request->category_name),
        ]);

        // $category = new CategoryResource()

        $notification = [
            'alert_type' => 'success',
            'message' => 'Category Created Successfully!!'
        ];
        $status_code = 201;
        return response()->json($notification, $status_code);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryStoreRequest $request, Category $category)
    {
        $category->update([
            'category_name' => $request->category_name,
            'category_slug' => Str::slug($request->category_name),
        ]);

        // $category = new CategoryResource()

        $notification = [
            'alert_type' => 'success',
            'message' => 'Category Updated Successfully!!'
        ];
        $status_code = 200;
        return response()->json($notification, $status_code);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        $notification = [
            'alert_type' => 'warning',
            'message' => 'Category Deleted Successfully!!'
        ];
        $status_code = 200;
        return response()->json($notification, $status_code);
    }
}
