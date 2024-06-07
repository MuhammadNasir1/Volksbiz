<?php

namespace App\Http\Controllers;

use App\Models\AddBusiness;
use Illuminate\Http\Request;
use Spatie\LaravelIgnition\FlareMiddleware\AddJobs;

class AddBusinessController extends Controller
{
    public function addBusiness(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'bus_img1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                'bus_img2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                'bus_img3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                'bus_img4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                'bus_video' => 'nullable',
                'bus_category' => 'required',
                'bus_title' => 'required',
                'bus_country' => 'required',
                'bus_city' => 'required',
                'bus_description' => 'required',
                'bus_price' => 'required',
            ]);

            // List of image fields to check
            $imageFields = ['bus_img1', 'bus_img2', 'bus_img3', 'bus_img4'];

            foreach ($imageFields as $index => $imageField) {
                if ($request->hasFile($imageField)) {
                    $image = $request->file($imageField);
                    $imageName = time() . ($index + 1) . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('public/busniess_images', $imageName);
                    $validatedData[$imageField] = 'storage/busniess_images/' . $imageName;
                } else {
                    $validatedData[$imageField] = null;
                }
            }

            if ($request->hasFile('bus_video')) {
                $video = $request->file('bus_video');
                $videoName = time() . '.' . $video->getClientOriginalExtension();
                $video->storeAs('public/busniess_videos', $videoName);
                $validatedData['bus_video'] = 'storage/busniess_videos/' . $videoName;
            }

            $validatedData = array_merge([
                'bus_img1' => null,
                'bus_img2' => null,
                'bus_img3' => null,
                'bus_img4' => null,
                'bus_video' => null
            ], $validatedData);

            $add_business = AddBusiness::create([
                'bus_img1' => $validatedData['bus_img1'],
                'bus_img2' => $validatedData['bus_img2'],
                'bus_img3' => $validatedData['bus_img3'],
                'bus_img4' => $validatedData['bus_img4'],
                'bus_video' => $validatedData['bus_video'],
                'bus_category' => $validatedData['bus_category'],
                'bus_title' => $validatedData['bus_title'],
                'bus_country' => $validatedData['bus_country'],
                'bus_city' => $validatedData['bus_city'],
                'bus_description' => $validatedData['bus_description'],
                'bus_price' => $validatedData['bus_price'],
            ]);

            $add_business->save();
            return redirect('businessList');
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function bussinessList()
    {
        $bussiness_list = AddBusiness::all();
        return view('businesses_list', compact('bussiness_list'));
    }

    public function delBusiness(string $id)
    {
        $business_details = AddBusiness::find($id);
        $business_details->delete();
        return redirect('../businessList');
    }

    public function getBusiness()
    {
        try {
            $business = AddBusiness::all();
            return response()->json(['sucess' => true, 'message' => 'Data Get Sucessfully', 'business' => $business], 200);
        } catch (\Exception $e) {
            return response()->json(['sucess' => false, 'message' => $e->getMessage()], 500);
        }
    }
}