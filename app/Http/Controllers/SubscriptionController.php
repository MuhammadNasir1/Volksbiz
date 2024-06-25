<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{

    public function index()
    {
        $subscriptionData = Subscription::all();
        return view('subscription_plan', compact('subscriptionData'));
    }
    public function insert(Request $request)
    {

        try {

            $validateData =    $request->validate([

                'name' => 'required',
                'price' => 'required',
                'option' => 'required',
            ]);
            $optionsJson = json_encode($validateData['option']);
            $subscribtion = Subscription::create([

                'name' => $validateData['name'],
                'price' => $validateData['price'],
                'option' => $optionsJson,
            ]);


            return redirect('subscriptionPlan');
        } catch (\Exception $e) {
            return redirect('subscriptionPlan');
        }
    }

    public function getSubscriptionData()
    {

        try {

            $subscriptionData = Subscription::all();
            foreach ($subscriptionData as  $data) {
                $data->option = json_decode($data->option);
            }
            return response()->json(['success' => true, 'message' => "Data get successfully", 'data' => $subscriptionData], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
