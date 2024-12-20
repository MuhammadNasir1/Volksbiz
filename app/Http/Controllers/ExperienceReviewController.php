<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Notification;
use App\Models\Reviews;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            $user_name = User::where('id',  $validateData['user_id'])->value('name');
            Notification::create([
                'heading' =>  $user_name . ' ' .  "Add experience",
                'description' => "New experience  added ",
                'type' => "reviewsAndExperience",

            ]);

            return response()->json(["success"  => true, "message" => "Experience add successfully", "data" => $experience], 201);
        } catch (\Exception $e) {

            return response()->json(["success"  => false, "message" => $e->getMessage()], 500);
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
            return response()->json(["success"  => false, "message" => $e->getMessage()], 500);
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
            $user_name = User::where('id',  $validateData['user_id'])->value('name');
            Notification::create([
                'heading' =>  $user_name . ' ' .  "Add review",
                'description' => "New review  added ",
                'type' => "reviewsAndExperience",

            ]);
            return response()->json(['success' => true,  "message" => "Review  add successfully", "data" => $review], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false,  "message" => $e->getMessage()], 500);
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
            return response()->json(['success' => false,  "message" => $e->getMessage()], 500);
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
                "status" => "required",

            ]);

            $review = Reviews::create([
                "status" => $validateData['status'],
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
            return response()->json(["success"  => true, "message" => "Review add successfully"], 201);
        } catch (\Exception $e) {

            return response()->json(["success"  => false, "message" => $e->getMessage()], 500);
        }
    }

    public function deleteReview($id)
    {
        try {
            $review = Reviews::find($id);
            if (!$review) {
                return response()->json(['success' => false, "message" => "Review not found"], 422);
            }
            if ($review->image) {
                Storage::delete($review->image_path);
            }

            if ($review->image) {
                $filePath = public_path($review->image);

                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }


            $review->delete();
            return response()->json(['success' => true, "message" => "Review delete successfully"], 200);
        } catch (\Exception $e) {
            return response()->json(["success"  => false, "message" => $e->getMessage()], 500);
        }
    }
    public function deleteExperience($id)
    {
        try {
            $experience = Experience::find($id);
            if (!$experience) {
                return response()->json(['success' => false, "message" => "Experience not found"], 422);
            }
            if ($experience->image) {
                $filePath = public_path($experience->image);

                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            $experience->delete();
            return response()->json(['success' => true, "message" => "Experience delete successfully"], 200);
        } catch (\Exception $e) {
            return response()->json(["success"  => false, "message" => $e->getMessage()], 500);
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
                "status" => "required",
            ]);


            $experience = Experience::create([
                'status' => $validateData['status'],
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
            return response()->json(["success"  => false, "message" => $e->getMessage()], 500);
        }
    }

    public function updateExperience(Request $request, $id)
    {


        try {
            $experience = Experience::find($id);
            if (!$experience) {
                return response()->json(['success' => false, 'message' => 'Experience not found'], 404);
            }
            $image = $request->file('image');
            if ($image) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/experience_images', $imageName);
                $experience->image = 'storage/experience_images/' . $imageName;
            }
            $experience->update($request->except('image'));
            return response()->json(['success' => true, 'message' => 'Experience updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(["success"  => false, "message" => $e->getMessage()], 500);
        }
    }
    public function updateReview(Request $request, $id)
    {


        try {
            $experience = Reviews::find($id);
            if (!$experience) {
                return response()->json(['success' => false, 'message' => 'Review not found'], 404);
            }
            $image = $request->file('image');
            if ($image) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/review', $imageName);
                $experience->image = 'storage/review/' . $imageName;
            }
            $experience->update($request->except('image'));
            return response()->json(['success' => true, 'message' => 'Review updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(["success"  => false, "message" => $e->getMessage()], 500);
        }
    }
}
