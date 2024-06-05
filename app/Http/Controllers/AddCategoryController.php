<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddCategory;

class AddCategoryController extends Controller
{
    public function  addcategory(Request $request)
    {
        $validatedData = $request->validate([
            'category_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'category_name' => 'required',
        ]);

        if ($request->hasFile('category_image')) {
            $image = $request->file('category_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/category_images', $imageName); // Adjust storage path as needed
            $img =  $validatedData['category_image'] = 'storage/category_images/' . $imageName;
        } else {
            $validatedData['category_image'] = 'default_image.jpg'; //
        }

        $category =  new AddCategory;
        $category->category_name = $validatedData['category_name'];
        $category->category_image = $img;

        $category->save();

        return  redirect('categoryList');
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
}
