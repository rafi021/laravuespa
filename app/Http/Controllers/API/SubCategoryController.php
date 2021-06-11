<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_categories = SubCategory::with('category')->latest()->paginate(5);
        return response()->json($sub_categories);
    }

    public function all()
    {
        $sub_categories_all = SubCategory::with('category')->latest()->get();
        return response()->json($sub_categories_all);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'category_id' => 'required',
            'subcategoryname' => 'required',
        ]);

        SubCategory::create([
            'category_id' => $request->category_id,
            'name' => $request->subcategoryname,
        ]);

        return response()->json([
            'type' => 'success',
            'message' => 'data inserted'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subCategory = SubCategory::findOrFail($id);
        return response()->json($subCategory);
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
        // dd($request->all());
        $validateData = $request->validate([
            'category_id' => 'required',
            'subcategoryname' => 'required',
        ]);

        $subCategory = SubCategory::findOrFail($id);
        $subCategory->update([
            'category_id' => $request->category_id,
            'name' => $request->subcategoryname,
        ]);

        return response()->json([
            'type' => 'success',
            'message' => 'data updated'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $subCategory->delete();

        return response()->json([
            'type' => 'success',
            'message' => 'data deleted'
        ], 200);
    }
}
