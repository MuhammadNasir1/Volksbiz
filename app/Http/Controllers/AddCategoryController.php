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
                'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                'category_name' => 'required',
            ]);

            if ($request->hasFile('category_image')) {
                $image = $request->file('category_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/category_images', $imageName); // Adjust storage path as needed
                $img =  $validatedData['category_image'] = 'storage/category_images/' . $imageName;
            } else {
                $img = 'null';
            }

            $category =  new AddCategory;
            $category->category_name = $validatedData['category_name'];
            $category->category_image = $img;

            $category->save();

            return response()->json(['success' => true, 'message' => 'Category add successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function categoryData()
    {
        $category_data = AddCategory::all();
        return view('category_list', compact('category_data'));
    }

    public function delCategory(string $id)
    {
        $delCat = AddCategory::find($id);
        $delCat->delete();
        return redirect()->route('categoryData');
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

    public function updateCategoryData($id)
    {
        $categoryData = addcategory::find($id);
        $category_data = AddCategory::all();

        return view('category_list', compact('categoryData', 'category_data'));
    }

    public function updateCategory(Request $request, $id)
    {

        try {
            $validatedData = $request->validate([
                'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                'category_name' => 'required',
            ]);
            $category =  addcategory::find($id);
            $category->category_name = $validatedData['category_name'];

            if ($request->hasFile('category_image')) {
                $image = $request->file('category_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/category_images', $imageName);
                $category->category_image =  $validatedData['category_image'] = 'storage/category_images/' . $imageName;
            }


            $category->update();
            return response()->json(['success' => true, 'message' => 'Category update successfully'], 201);
        } catch (\Exception $e) {

            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
