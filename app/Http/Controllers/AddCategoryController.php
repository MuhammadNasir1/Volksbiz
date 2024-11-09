<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddCategory;

class AddCategoryController extends Controller
{
    public function  addcategory(Request $request)
    {

        try {
            $validatedData = $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                'name_en' => 'required|unique:add_categories,name_en',
                'name_de' => 'required|unique:add_categories,name_en',
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/category_images', $imageName); // Adjust storage path as needed
                $img =  $validatedData['image'] = 'storage/category_images/' . $imageName;
            } else {
                $img = 'null';
            }

            $category =  new AddCategory;
            $category->name_en = $validatedData['name_en'];
            $category->name_de = $validatedData['name_de'];
            $category->image = $img;

            $category->save();

            return response()->json(['success' => true, 'message' => 'Category add successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function categoryData()
    {
        $category_data = AddCategory::where('status', 1)->get();
        return view('category_list', compact('category_data'));
    }

    public function delCategory(string $id)
    {
        $category = AddCategory::find($id);
        $category->status = 0;
        $category->update();
        return response()->json(["success" => true, "message" => "Category deleted"], 200);
    }


    public function getCategories()
    {
        try {
            $categories  = AddCategory::all();
            return response()->json(['success' => true, 'message' => "Data  get successfully", 'categories' => $categories], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }


    public function updateCategory(Request $request, $id)
    {

        try {
            $validatedData = $request->validate([
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                'name_en' => 'required',
                'name_de' => 'required',
            ]);

            $category =  addcategory::find($id);
            $category->name_en = $validatedData['name_en'];
            $category->name_de = $validatedData['name_de'];
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/category_images', $imageName); // Adjust storage path as needed
                $category->image  = 'storage/category_images/' . $imageName;
            }

            $category->update();
            return response()->json(['success' => true, 'message' => 'Category update successfully'], 201);
        } catch (\Exception $e) {

            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
