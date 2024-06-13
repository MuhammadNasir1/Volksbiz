<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogsController extends Controller
{


    public function upload(Request $request)
    {

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('images', 'public'); // Store in the 'public/images' directory

            return response()->json(['url' => Storage::url($path)]);
        }

        return response()->json(['error' => 'No image uploaded'], 400);
    }
    public function insert(Request $request)
    {

        try {
            $validatedData = $request->validate([

                "title" => "required",
                "category" => "required",
                "author" => "required",
                "image" => 'required',
                "content" => "required",
            ]);

            $blog = Blogs::create([
                "title" => $validatedData['title'],
                "category" => $validatedData['category'],
                "author" => $validatedData['author'],
                "content" => htmlspecialchars($validatedData['content']),
                "image" => "null",
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/blog_images', $imageName);
                $blog->image = 'storage/blog_images/' . $imageName;
            }

            $blog->save();
            return response()->json(['success' => true, "message" => "Data add successfully", "data"  => $blog], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, "message" => $e->getMessage()], 400);
        }
    }

    function getBlogs()
    {
        try {
            $blogs = Blogs::all();
            // foreach ($blogs as $blog) {
            //     $blog->content = htmlspecialchars_decode($blog->content);
            // }
            return response()->json(['success' => true, "message" => "Data add successfully", "data"  => $blogs], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, "message" => $e->getMessage()], 400);
        }
    }
}
