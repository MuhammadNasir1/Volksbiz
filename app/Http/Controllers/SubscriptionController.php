<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use NunoMaduro\Collision\Adapters\Phpunit\Subscribers\Subscriber;

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
                'plan_for' => 'required',
            ]);
            $optionsJson = json_encode($validateData['option']);
            $subscribtion = Subscription::create([

                'name' => $validateData['name'],
                'price' => $validateData['price'],
                'option' => $optionsJson,
                'plan_for' => $validateData['plan_for'],
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

    public function delete($id)
    {
        $subscribtion = Subscription::find($id);
        $subscribtion->delete();
        return redirect('../subscriptionPlan');
    }
}
