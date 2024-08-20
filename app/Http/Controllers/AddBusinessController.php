<?php

namespace App\Http\Controllers;

use App\Models\AddBusiness;
use App\Models\AddCategory;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Calculation\Category;
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
                'video' => 'nullable',
                'category' => 'required',
                'title' => 'required',
                'country' => 'required',
                'city' => 'required',
                'description' => 'required',
                'price' => 'required',
            ]);

            $imageFields = ['bus_img1', 'bus_img2', 'bus_img3', 'bus_img4'];
            $imagePaths = [];

            foreach ($imageFields as $index => $imageField) {
                if ($request->hasFile($imageField)) {
                    $image = $request->file($imageField);
                    $imageName = time() . ($index + 1) . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('public/busniess_images', $imageName);
                    $validatedData[$imageField] = 'storage/busniess_images/' . $imageName;
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
            }

            $add_business = AddBusiness::create([
                'images' => json_encode($imagePaths),
                'video' => $videoPath,
                'category' => $validatedData['category'],
                'title' => $validatedData['title'],
                'country' => $validatedData['country'],
                'city' => $validatedData['city'],
                'description' => $validatedData['description'],
                'price' => $validatedData['price'],
            ]);

            $add_business->save();
            return redirect('businesses');
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function businesses()
    {
        $bussinesses = AddBusiness::all();
        $categories = AddCategory::all();
        return view('businesses_list', compact('bussinesses', 'categories'));
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
            $businesses = AddBusiness::all();
            foreach ($businesses as $business) {
                $business->images = json_decode($business->images);
            }
            return response()->json(['sucess' => true, 'message' => 'Data Get Sucessfully', 'business' => $businesses], 200);
        } catch (\Exception $e) {
            return response()->json(['sucess' => false, 'message' => $e->getMessage()], 500);
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
                'businuess_id' => "required",
            ]);

            $OrderData = Order::create([
                'user_id' => $validatedData['user_id'],
                'businuess_id' => $validatedData['businuess_id'],
                'status' => "pending",
            ]);
            $businessId = $OrderData['businuess_id'];
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
                $businessId = $order['businuess_id'];
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
            $businessId = $order['businuess_id'];
            $businesses = AddBusiness::where('id', $businessId)->first();
            $businesses->images = json_decode($businesses->images);
            $order->business = $businesses;

            $userId = $order['user_id'];
            $user = User::where('id', $userId)->first();
            $order->user = $user;
        }
        return view("orders", ['orders' => $orders]);
    }
    public function show($id)
    {
        $business = AddBusiness::findOrFail($id);

        return response()->json([
            'title' => $business->title,
            'category' => $business->category,
            'city' => $business->city,
            'country' => $business->country,
            'description' => $business->description,
            'video' => asset($business->video),
            'images' => $business->images, // Assuming images is a JSON field
            'date' => $business->created_at->format('M d, Y'), // Format the date as needed
            'uploaded_at' => $business->created_at->format('M d, Y H:i:s'), // Format the uploaded date
        ]);
    }
}
