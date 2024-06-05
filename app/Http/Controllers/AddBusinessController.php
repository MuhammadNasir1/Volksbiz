<?php

namespace App\Http\Controllers;

use App\Models\AddBusiness;
use Illuminate\Http\Request;

class AddBusinessController extends Controller
{
    public function addBusiness(Request $request)
    {
        $validatedData = $request->validate([
            'bus_img1' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'bus_img2' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'bus_img3' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'bus_img4' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'bus_video' => 'required',
            'bus_category' => 'required',
            'bus_title' => 'required',
            'bus_country' => 'required',
            'bus_city' => 'required',
            'bus_description' => 'required',
            'bus_price' => 'required',
        ]);

        if ($request->hasFile('bus_img1')) {
            $image = $request->file('bus_img1');
            $imageName = time() . '1.' . $image->getClientOriginalExtension();
            $image->storeAs('public/busniess_images', $imageName);
            $validatedData['bus_img1'] = 'storage/busniess_images/' . $imageName;
        } else {
            $validatedData['bus_img1'] = 'default_image.jpg';
        }

        if ($request->hasFile('bus_img2')) {
            $image = $request->file('bus_img2');
            $imageName = time() . '2.' . $image->getClientOriginalExtension();
            $image->storeAs('public/busniess_images', $imageName);
            $validatedData['bus_img2'] = 'storage/busniess_images/' . $imageName;
        } else {
            $validatedData['bus_img2'] = 'default_image.jpg';
        }

        if ($request->hasFile('bus_img3')) {
            $image = $request->file('bus_img3');
            $imageName = time() . '3.' . $image->getClientOriginalExtension();
            $image->storeAs('public/busniess_images', $imageName);
            $validatedData['bus_img3'] = 'storage/busniess_images/' . $imageName;
        } else {
            $validatedData['bus_img3'] = 'default_image.jpg';
        }

        if ($request->hasFile('bus_img4')) {
            $image = $request->file('bus_img4');
            $imageName = time() . '4.' . $image->getClientOriginalExtension();
            $image->storeAs('public/busniess_images', $imageName);
            $validatedData['bus_img4'] = 'storage/busniess_images/' . $imageName;
        } else {
            $validatedData['bus_img4'] = 'default_image.jpg';
        }

        if ($request->hasFile('bus_video')) {
            $video = $request->file('bus_video');
            $videoName = time() . '.' . $video->getClientOriginalExtension();
            $video->storeAs('public/busniess_videos', $videoName);
            $validatedData['bus_video'] = 'storage/busniess_videos/' . $videoName;
        } else {
            $validatedData['bus_video'] = 'default_video.mp4';
        }


        $add_bussniess = AddBusiness::create([
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

        dd($validatedData); // Use this to debug
        $add_bussniess->save();





        // return  redirect('categoryList');
    }
}
