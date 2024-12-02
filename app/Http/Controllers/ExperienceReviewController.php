<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Reviews;
use App\Models\User;
use Illuminate\Http\Request;

class ExperienceReviewController extends Controller
{

    public function index()
    {
        $reviews = Reviews::all();
        $experiences = Experience::all();
        return view('review', compact('reviews', 'experiences'));
    }

    public function addExperience(Request $request)
    {
        try {
            $validateData = $request->validate([
                "user_id" => "required",
                "location" => "required",
                "image" => "nullable|image|mimes:jpeg,png,jpg,gif,svg",
                "subject" => "nullable",
                "category" => "required",
                "description" => "required",
            ]);

            // Handle the image upload before creating the experience
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() .  '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/experience_images', $imageName);
                $validateData['image'] = 'storage/experience_images/' . $imageName;
            } else {
                $validateData['image'] =  null;
            }

            $experience = Experience::create([
                'status' => "de-active",
                'user_id' => $validateData['user_id'],
                'location' => $validateData['location'],
                'subject' => $validateData['subject'],
                'category' => $validateData['category'],
                'description' => $validateData['description'],
                'image' => $validateData['image'],
            ]);

            $experience->save();


            return response()->json(["success"  => true, "message" => "Experience add successfully", "data" => $experience], 201);
        } catch (\Exception $e) {

            return response()->json(["success"  => true, "message" => $e->getMessage()], 500);
        }
    }

    public function getExperience()
    {
        try {
            $experiences = Experience::all();
            foreach ($experiences as $experience) {
                $userId = $experience->user_id;
                $user = User::where('id', $userId)->first();
                $experience->user = $user;
            }
            return response()->json(["success" => true, "message" => "Data get successfull", "data" => $experiences], 200);
        } catch (\Exception $e) {
            return response()->json(["success"  => true, "message" => $e->getMessage()], 500);
        }
    }


    // add review

    public function  addReviews(Request $request)
    {

        try {

            $validateData = $request->validate([
                "user_id" => "required",
                "rating" => "required|numeric",
                "location" => "required",
                "description" => "required",

            ]);

            $review = Reviews::create([
                'status' => "de-active",
                "user_id" => $validateData['user_id'],
                "rating" => $validateData['rating'],
                "location" => $validateData['location'],
                "description" => $validateData['description'],
            ]);
            return response()->json(['success' => true,  "message" => "Review  add successfully", "data" => $review], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => true,  "message" => $e->getMessage()], 500);
        }
    }
    public function getReviews()
    {

        try {
            $reviews = Reviews::all();
            foreach ($reviews as $review) {
                $userId  =   $review->user_id;
                $user = User::where('id', $userId)->first();
                $review->user = $user;
            }

            return response()->json(['success' => true,  "message" => "Review  get successfully", "data" => $reviews], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => true,  "message" => $e->getMessage()], 500);
        }
    }

    // custom review and  Experience

    public function insertReview(Request $request)
    {


        try {

            $validateData = $request->validate([
                "rating" => "required|numeric",
                "location" => "required",
                "description" => "required",
                "name" => "required",
                "role" => "required",
                "image" => "required",

            ]);

            $review = Reviews::create([
                'status' => "active",
                "user_id" => session('user_det')['user_id'],
                "rating" => $validateData['rating'],
                "location" => $validateData['location'],
                "description" => $validateData['description'],
                "name" => $validateData['name'],
                "role" => $validateData['role'],
            ]);
            $image = $request->file('image');
            $imageName = time() .  '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/review', $imageName);
            $review->image = 'storage/review/' . $imageName;

            $review->save();
            return response()->json(["success"  => true, "message" => "Experience add successfully"], 201);
        } catch (\Exception $e) {

            return response()->json(["success"  => true, "message" => $e->getMessage()], 500);
        }
    }

    public function deleteReview($id){
        try{
        $review = Reviews::find($id);
        if(!$review){
            return response()->json(['success' => false , "message"=> "Review not found"] , 422);
        }
        $review->delete();
        return response()->json(['success' => true , "message"=> "Review delete successfully"] , 200);
        
        } catch (\Exception $e) {
            return response()->json(["success"  => true, "message" => $e->getMessage()], 500);
        }

    }
    public function deleteExperience($id){
        try{
        $review = Experience::find($id);
        if(!$review){
            return response()->json(['success' => false , "message"=> "Experience not found"] , 422);
        }
        $review->delete();
        return response()->json(['success' => true , "message"=> "Experience delete successfully"] , 200);
        } catch (\Exception $e) {
            return response()->json(["success"  => true, "message" => $e->getMessage()], 500);
        }

    }

    public function insertExperience(Request $request)
    {


        try {
            $validateData = $request->validate([
                "location" => "required",
                "image" => "nullable|image|mimes:jpeg,png,jpg,gif,svg",
                "subject" => "nullable",
                "category" => "required",
                "description" => "required",
                "name" => "required",
                "role" => "required",
            ]);


            $experience = Experience::create([
                'status' => "active",
                "user_id" => session('user_det')['user_id'],
                'location' => $validateData['location'],
                'subject' => $validateData['subject'],
                'category' => $validateData['category'],
                'description' => $validateData['description'],
                'name' => $validateData['name'],
                'role' => $validateData['role'],
            ]);


            $image = $request->file('image');
            $imageName = time() .  '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/experience_images', $imageName);
            $experience->image = 'storage/experience_images/' . $imageName;
            $experience->save();
            return response()->json(["success"  => true, "message" => "Experience add successfully"], 201);

        } catch (\Exception $e) {
            return response()->json(["success"  => true, "message" => $e->getMessage()], 500);

        }
    }
}
