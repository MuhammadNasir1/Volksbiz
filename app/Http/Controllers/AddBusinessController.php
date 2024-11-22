<?php

namespace App\Http\Controllers;

use App\Models\AddBusiness;
use App\Models\AddCategory;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Calculation\Category;
use Spatie\LaravelIgnition\FlareMiddleware\AddJobs;

class AddBusinessController extends Controller
{
public function businessRequest(){

    $businesses = AddBusiness::where('status' , "pending")->get();
    foreach ($businesses as $business) {
        $business->update_images = json_decode($business->images , true);
        $category = AddCategory::where('id', $business->category)->first();
        if ($category) {
            $business->category = $category->category_name;
            $business->country = ucfirst($business->country);
            $business->category_de = $category->category_name_de;
            $business->category_id = $category->id;
        } else {
            $business->category = null;
            $business->category_de = null;
            $business->category_id = null;
        }
    }

    return view('business_request', compact('businesses'));
}

    public function addBusiness(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'bus_img1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                'bus_img2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                'bus_img3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                'bus_img4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                'video' => 'nullable',
                'category' => 'required',
                'title' => 'required',
                'title_de' => 'required',
                'country' => 'required',
                'city' => 'required',
                'description' => 'required',
                'description_de' => 'required',
                'price' => 'required',
            ]);

            $imageFields = ['bus_img1', 'bus_img2', 'bus_img3', 'bus_img4'];
            $imagePaths = [];

            foreach ($imageFields as $index => $imageField) {
                if ($request->hasFile($imageField)) {
                    $image = $request->file($imageField);
                    $imageName = time() . ($index + 1) . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('public/busniess_images', $imageName);
                    $validatedData[$imageField] =  'storage/busniess_images/' . $imageName;
                    $imagePaths[] = 'storage/busniess_images/' . $imageName; // Add the file path to the array
                } else {
                    $validatedData[$imageField] = null;
                }
            }
            if ($request->hasFile('video')) {
                $video = $request->file('video');
                $videoName = time() . '.' . $video->getClientOriginalExtension();
                $video->storeAs('public/busniess_videos', $videoName);
                $videoPath = 'storage/busniess_videos/' . $videoName;
            } else {
                $videoPath = 'null';
            }

            $add_business = AddBusiness::create([
                'user_id' => session('user_det')['user_id'],
                'images' => json_encode($imagePaths),
                'video' => $videoPath,
                'category' => $validatedData['category'],
                'title' => $validatedData['title'],
                'title_de' => $validatedData['title_de'],
                'country' => ucfirst($validatedData['country']),
                'city' => $validatedData['city'],
                'description' => $validatedData['description'],
                'description_de' => $validatedData['description_de'],
                'price' => $validatedData['price'],
                'status' => "1",
            ]);

            $add_business->save();
            return response()->json(['success' => true, 'message' => "Business add successfully"], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }



    public function addSellerBusiness(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'user_id' => 'required',
                'images' => 'nullable|array',
                'images.*' => 'file|mimes:jpg,jpeg,png,gif',
                'video' => 'nullable',
                'category' => 'required',
                'title' => 'required',
                'title_de' => 'required',
                'country' => 'required',
                'city' => 'required',
                'description' => 'required',
                'description_de' => 'required',
                'price' => 'required',
                'phone_no' => 'nullable',
            ]);

            $imagePaths = []; // Initialize an array to store file paths

            // Check if the request contains files in the 'images' array
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    if ($image->isValid()) {
                        $imageName = time() . '_' . ($index + 1) . '.' . $image->getClientOriginalExtension();

                        $image->storeAs('public/business_images', $imageName);
                        $imagePaths[] = 'storage/business_images/' . $imageName;
                    }
                }
            }
            if ($request->hasFile('video')) {
                $video = $request->file('video');
                $videoName = time() . '.' . $video->getClientOriginalExtension();
                $video->storeAs('public/busniess_videos', $videoName);
                $videoPath = 'storage/busniess_videos/' . $videoName;
            } else {
                $videoPath = 'null';
            }
            $business = AddBusiness::create([
                'user_id' => $validatedData['user_id'],
                'images' => json_encode($imagePaths),
                'video' => $videoPath,
                'category' => $validatedData['category'],
                'title' => $validatedData['title'],
                'title_de' => $validatedData['title_de'],
                'country' => ucfirst($validatedData['country']),
                'city' => $validatedData['city'],
                'description' => $validatedData['description'],
                'description_de' => $validatedData['description_de'],
                'price' => $validatedData['price'],
                'phone_no' => $validatedData['phone_no'],
            ]);

  
            $business->save();
            $business->images = json_decode($business->images, true);
            $category = AddCategory::where('id', "$business->category")->first();
            $business->category = $category->category_name;
            $business->category_de = $category->category_name_de;
            $business->category_id = $business->category;

            return response()->json(['success' => true, 'message' => "Business add successfully", "data"  =>  $business], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function updateSellerBusiness(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'images' => 'nullable|array',
                'images.*' => 'file|mimes:jpg,jpeg,png,gif',
                'video' => 'nullable',
                'category' => 'required',
                'title' => 'required',
                'title_de' => 'required',
                'country' => 'required',
                'city' => 'required',
                'description' => 'required',
                'description_de' => 'required',
                'price' => 'required',
            ]);
            $business = AddBusiness::find($id);
            if (!$business) {
                return response()->json(['success' => false, 'message' => 'Business not found'], 404);
            }

            if ($request->hasFile('video')) {
                $video = $request->file('video');
                $videoName = time() . '.' . $video->getClientOriginalExtension();
                $video->storeAs('public/busniess_videos', $videoName);
                $videoPath = 'storage/busniess_videos/' . $videoName;
            }

            $imagePaths = $business->images ? json_decode($business->images, true) : [];


            // Check if the request contains files in the 'images' array
            if ($request->hasFile('images')) {
                $imagePaths =  [];
                foreach ($request->file('images') as $index => $image) {
                    if ($image->isValid()) {
                        $imageName = time() . '_' . ($index + 1) . '.' . $image->getClientOriginalExtension();

                        $image->storeAs('public/business_images', $imageName);
                        $imagePaths[] = 'storage/business_images/' . $imageName;
                    }
                }
            }

            $business->images = json_encode($imagePaths);
            $business->video =  $videoPath ??  $business->video;
            $business->category = $validatedData['category'];
            $business->title = $validatedData['title'];
            $business->title_de = $validatedData['title_de'];
            $business->country = ucfirst($validatedData['country']);
            $business->city = $validatedData['city'];
            $business->description = $validatedData['description'];
            $business->description_de = $validatedData['description_de'];
            $business->price = $validatedData['price'];
            $business->update();
            $business->images = json_decode($business->images, true);
            $category = AddCategory::where('id', "$business->category")->first();
            $business->category = $category->category_name;
            $business->category_de = $category->category_name_de;
            $business->category_id = $business->category;
            return response()->json(['success' => true, 'message' => "Business update successfully", "data"  =>  $business], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    public function updateBusiness(Request $request, string $id)
    {
        try {
            $validatedData = $request->validate([
                'bus_img1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                'bus_img2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                'bus_img3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                'bus_img4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                'video' => 'nullable',
                'category' => 'required',
                'title' => 'required',
                'title_de' => 'required',
                'country' => 'required',
                'city' => 'required',
                'description' => 'required',
                'description_de' => 'required',
                'price' => 'required',
            ]);
            $update_business = AddBusiness::find($id);
            $update_business->category = $validatedData['category'];
            $update_business->title = $validatedData['title'];
            $update_business->title_de = $validatedData['title_de'];
            $update_business->country = ucfirst($validatedData['country']);
            $update_business->city = $validatedData['city'];
            $update_business->description = $validatedData['description'];
            $update_business->description_de = $validatedData['description_de'];
            $update_business->price = $validatedData['price'];
            $existingImages = json_decode($update_business->images, true);
            $imageFields = ['bus_img1', 'bus_img2', 'bus_img3', 'bus_img4'];
            $imagePaths = $existingImages ?? []; // Start with existing images

            foreach ($imageFields as $index => $imageField) {
                if ($request->hasFile($imageField)) {
                    // Delete old image if it exists
                    if (isset($existingImages[$index])) {
                        Storage::delete(str_replace('storage/', 'public/', $existingImages[$index]));
                    }

                    // Upload new image
                    $image = $request->file($imageField);
                    $imageName = time() . ($index + 1) . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('public/busniess_images', $imageName);
                    $imagePaths[$index] = 'storage/busniess_images/' . $imageName; // Update the file path in the array
                }
            }

            // Update the images in the database
            $update_business->images = json_encode($imagePaths);
            if ($request->hasFile('video')) {
                $video = $request->file('video');
                $videoName = time() . '.' . $video->getClientOriginalExtension();
                $video->storeAs('public/busniess_videos', $videoName);
                $videoPath = 'storage/busniess_videos/' . $videoName;
                $update_business->video = $videoPath;
            }



            $update_business->update();
            return response()->json(['success' => true, 'message' => 'Buissness Update successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function businesses()
    {
        $bussinesses = AddBusiness::where('status' , "active")->orwhere('status' , "sold")->get();
        foreach ($bussinesses as $business) {
            $business->update_images = json_decode($business->images , true);
            $category = AddCategory::where('id', $business->category)->first();
            if ($category) {
                $business->category = $category->category_name;
                $business->country = ucfirst($business->country);
                $business->category_de = $category->category_name_de;
                $business->category_id = $category->id;
            } else {
                $business->category = null;
                $business->category_de = null;
                $business->category_id = null;
            }
        }
        // return response()->json( $business);
        $categories = AddCategory::where('status', 1)->get();
        return view('businesses_list', compact('bussinesses', 'categories'));
    }

    public function delBusiness(string $id)
    {
        $business_details = AddBusiness::find($id);
        $business_details->status = "deleted";
        $business_details->update();
        return response()->json(['success' => true, 'message' => "Business delete successfully"], 200);;
    }

    public function getBusiness()
    {
        try {
            $businesses = AddBusiness::where('status' , "active")->wherenot('status' , "deleted")->get();;
            foreach ($businesses as $business) {
                $business->images = json_decode($business->images);
                $category = AddCategory::where('id', $business->category)->first();
                if ($category) {
                    $business->category = $category->category_name;
                    $business->category_de = $category->category_name_de;
                    $business->category_id = $category->id;
                } else {
                    $business->category = null;
                    $business->category_de = null;
                    $business->category_id = null;
                }
            }
            return response()->json(['success' => true, 'message' => 'Data get successfully', 'business' => $businesses], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function getSellerBusiness()
    {
        try {
            $user = Auth()->user();
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not authenticated.'], 401);
            }
            $userId  =  $user->id;
            $businesses = AddBusiness::where('user_id',  $userId)->wherenot('status' , "deleted")->get();
            foreach ($businesses as $business) {
                $business->images = json_decode($business->images);
                $category = AddCategory::where('id', "$business->category")->first();
                if ($category) {
                    $business->category = $category->category_name;
                    $business->category_de = $category->category_name_de;
                    $business->category_id = $category->id;
                } else {
                    $business->category = null;
                    $business->category_de = null;
                    $business->category_id = null;
                }
            }
            return response()->json(['success' => true, 'message' => 'Data get successfully', 'business' => $businesses], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function getFilteredBusiness(Request $request)
    {
        try {
            $query = addBusiness::query();

            // Filter by price range (if both min and max are provided)
            if ($request->has('min_price') && !empty($request->min_price) && $request->has('max_price') && !empty($request->max_price)) {
                $query->whereBetween('price', [$request->min_price, $request->max_price]);
            }

            // Filter by location (country or city)
            if ($request->has('location') && !empty($request->location)) {
                $location = $request->location;
                $query->where(function ($q) use ($location) {
                    $q->where('country', $location)
                        ->orWhere('city', $location);
                });
            }

            // Filter by search term (title or description)
            if ($request->has('search') && !empty($request->search)) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'LIKE', "%{$search}%")
                        ->orWhere('description', 'LIKE', "%{$search}%");
                });
            }

            // Filter by category (if provided)
            if ($request->has('category') && !empty($request->category)) {
                $query->where('category', $request->category);
            }

            // Fetch the businesses
            $businesses = $query->get();

            // Fetch and decode images for each business efficiently
            foreach ($businesses as $business) {
                $business->images = json_decode($business->images);
            }
            return response()->json(['sucess' => true, 'message' => 'Data Get Sucessfully', 'business' => $businesses], 200);
        } catch (\Exception $e) {
            return response()->json(['sucess' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function searchBusiness(Request $request)
    {
        try {
            if ($request->has('search')) {
                $search = $request->search;
                $businesses = AddBusiness::where(function ($q) use ($search) {
                    $q->where('title', 'LIKE', "%{$search}%")
                        ->orWhere('description', 'LIKE', "%{$search}%");
                })->get();
            }
            foreach ($businesses as $business) {
                $business->images = json_decode($business->images);
            }

            return response()->json(['sucess' => true, 'message' => 'Data Get Sucessfully', 'business' => $businesses], 200);
        } catch (\Exception $e) {
            return response()->json(['sucess' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function orderBusiness(Request $request)
    {
        try {

            $validatedData = $request->validate([
                'user_id' => "required",
                'business_id' => "required",
                'buyer_name' => "required",
                'buyer_contact' => "required",
                'budget' => "required",
                'desired_location' => "required",
            ]);

            $OrderData = Order::create([
                'user_id' => $validatedData['user_id'],
                'business_id' => $validatedData['business_id'],
                'buyer_name' => $validatedData['buyer_name'],
                'buyer_contact' => $validatedData['buyer_contact'],
                'budget' => $validatedData['budget'],
                'desired_location' => $validatedData['desired_location'],
                'status' => "pending",
            ]);
            $businessId = $OrderData['business_id'];
            $businesses = AddBusiness::where('id', $businessId)->first();
            $businesses->images = json_decode($businesses->images);
            $OrderData->business = $businesses;

            return response()->json(['sucess' => true, 'message' => 'Data add sucessfully', 'data' => $OrderData], 201);
        } catch (\Exception $e) {
            return response()->json(['sucess' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function getOrders()
    {
        try {
            $user = Auth()->user();
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not authenticated.'], 401);
            }
            $userId  =  $user->id;
            $orders = Order::where('user_id', $userId)->get();
            foreach ($orders as $order) {
                $businessId = $order['business_id'];
                $businesses = AddBusiness::where('id', $businessId)->first();
                $businesses->images = json_decode($businesses->images);
                $order->business = $businesses;
            }
            return response()->json(['success' => true, 'message' => 'Data add successfully', 'data' => $orders], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }


    public function getBusOrders()
    {
        $orders = Order::all();
        foreach ($orders as $order) {
            $businessId = $order['business_id'];
            $businesses = AddBusiness::where('id', $businessId)->first();
            if($businesses){
                $businesses->images = json_decode($businesses->images);
                $order->business = $businesses;
            }

            $userId = $order['user_id'];
            $user = User::where('id', $userId)->first();
            $order->user = $user;
        }
        return view("orders", ['orders' => $orders]);
    }

    public function getSingleBusinesses($id)
    {
        try {
            $business =  addBusiness::where('id', $id)->first();
            $business->images = json_decode($business->images, true);
            $category = AddCategory::where('id', "$business->category")->first();
            $business->category = $category->category_name;
            $business->category_de = $category->category_name_de;
            $business->date = $business->created_at->format('M d, Y');
            return response()->json(['success' => true, 'message' => "Business add successfully", "data"  =>  $business], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function changeBusinessStatus(Request $request){
        try {

            $validatedData = $request->validate([
                'update_id' => "required",
                'status' => "required",
            ]);
            $business =  addBusiness::where('id', $validatedData['update_id'])->first();
            $business->status = $validatedData['status'];
            $business->update(); 
    
            return response()->json(['success' => true, 'message' => "Business Request Approved"], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
