<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceReviewController extends Controller
{

    public function addExperience(Request $request)
    {
        try {
            $validateData = $request->validate([
                "status" => "required",
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
                'status' => $validateData['status'],
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
        } catch (\Exception $e) {
            return response()->json(["success"  => true, "message" => $e->getMessage()], 500);
        }
    }
}
