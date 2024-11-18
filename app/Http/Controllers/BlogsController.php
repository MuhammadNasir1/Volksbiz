<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogsController extends Controller
{
    public function index()
    {
        $blogs = Blogs::all();
        return view("blogs", compact("blogs"));
    }

    public function upload(Request $request)
    {

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('images', 'public'); // Store in the 'public/images' directory
            $fullUrl = url(Storage::url($path));
            return response()->json(['url' => $fullUrl]);
            // return response()->json(['url' => Storage::url($path)]);
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
            return redirect('blogs');
            // return response()->json(['success' => true, "message" => "Data add successfully", "data"  => $blog], 201);
        } catch (\Exception $e) {
            return redirect('blogs');
            // return response()->json(['success' => false, "message" => $e->getMessage()], 400);
        }
    }

    function getBlogs()
    {
        try {
            $blogs = Blogs::all();
            foreach ($blogs as $blog) {
                $blog->content = html_entity_decode($blog->content, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            }

            return response()->json(['success' => true, "message" => "Data add successfully", "data"  => $blogs], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, "message" => $e->getMessage()], 400);
        }
    }

    function delete($id)
    {
        $blog = Blogs::find($id);
        $image = $blog->image;

        // Delete the image from storage
        if (Storage::exists($image)) {
            Storage::delete($image);
        }
        $blog->delete();
        return redirect('../blogs');
    }
    function editBlogData($id)
    {

        $blogData = Blogs::find($id);
        // foreach ($blogData as $blog) {
        $blogData->content = htmlspecialchars_decode($blogData->content);
        // }
        return view("blog_page", compact("blogData"));
    }

    function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([

                "title" => "required",
                "category" => "required",
                "author" => "required",
                "content" => "required",
            ]);
            $blog = Blogs::find($id);
            $blog->title = $validatedData['title'];
            $blog->category = $validatedData['category'];
            $blog->author = $validatedData['author'];
            $blog->content = htmlspecialchars($validatedData['content']);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/blog_images', $imageName);
                $blog->image = 'storage/blog_images/' . $imageName;
            }

            $blog->update();
            return redirect('blogs');
        } catch (\Exception $e) {
            return redirect('blogs');
            // return response()->json($e->getMessage());
        }
    }

    function getBlogDetail($id)
    {
        $blogData = Blogs::find($id);

        $blogData->content = htmlspecialchars_decode($blogData->content);

        return response()->json(["data" => $blogData], 200);
    }
}
