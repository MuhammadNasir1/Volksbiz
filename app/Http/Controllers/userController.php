<?php

namespace App\Http\Controllers;

use App\Models\parents;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use  Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use App\Models\AddBusiness;
use App\Models\Contact_us;
use App\Models\Order;
use App\Models\students;
use App\Models\teacher;
use App\Models\teacher_rec;
use App\Models\training;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class userController extends Controller
{


    public function language_change(Request $request)
    {
        App::setLocale($request->lang);
        session()->put('locale', $request->lang);
        return redirect()->back();
    }

    public function Dashboard()
    {
        $totalUserCount = User::whereNot('role' , 'admin')->count();
        $totalBusinessCount = AddBusiness::whereNot('status' , 'sold')->count();
        $totalOrderCount = Order::whereNot('status' , 'sold')->count();
        $totalOfferCount = AddBusiness::where('status' , 'pending')->count();
        $reservedBusinessCount = AddBusiness::where('status' , 'reserved')->count();
        $soldBusinessCount = AddBusiness::where('status' , 'sold')->count();
        $lastFiveBusinesses = AddBusiness::whereNot('status', 'sold')->latest()->take(5)->get();

        // return response()->json($lastFiveBusinesses);
        return view('dashboard', [
            'totalUserCount' => $totalUserCount, 
            'totalBusinessCount' => $totalBusinessCount, 
            'totalOrderCount' => $totalOrderCount, 
            'totalOfferCount' => $totalOfferCount, 
            'reservedBusinessCount' => $reservedBusinessCount, 
            'soldBusinessCount' => $soldBusinessCount, 
            'lastFiveBusinesses' => $lastFiveBusinesses
        ]);
        
    }   

    // dashboard  Users Couny
    public function customers()
    {
        $customers =  User::where('role', 'user')->get();
        return view('customers', ['customers'  => $customers]);
    }

    public function  addCustomer(Request $request)
    {
        try {
            $validateData = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'phone_no' => 'required',
                'address' => 'required',
                'user_id' => 'required'
            ]);
            $customer =  User::create([
                'user_id' => $validateData['user_id'],
                'name' => $validateData['name'],
                'email' => $validateData['email'],
                'password' => Hash::make(12345678),
                'phone' => $validateData['phone_no'],
                'role' => "customer",
                'address' => $validateData['address'],
            ]);

            return response()->json(['success' => true, 'message' => "Customer Add Successfully"]);
        } catch (\Exception $e) {
            return response()->json(['success' => true, 'message' => $e->getMessage()]);
        }
    }

    public function delCustomer($user_id)
    {
        $user = User::find($user_id);
        $user->delete();
        return redirect('customers');
    }
    public function CustomerUpdateData($user_id)
    {
        try {

            $customer = User::find($user_id);
            return response()->json(['success' => true,  'message' => "Data  Get Successfully", 'customer' => $customer]);
        } catch (\Exception $e) {
            return response()->json(['success' => false,  'message' => $e->getMessage()]);
        }
    }
    public function userUpdate(Request $request, $user_id)
    {
        try {

            $customer = User::find($user_id);

            $validatedData = $request->validate([
                'name' => 'nullable',
                'email' => 'nullable',
                'phone' => 'nullable',
            ]);

            $customer->name = $validatedData['name'];
            $customer->phone = $validatedData['phone'];
            $customer->email = $validatedData['email'];
            $customer->update();
            return response()->json(['success' => true,  'message' => "Data  Get Successfully", 'customer' => $customer]);
        } catch (\Exception $e) {
            return response()->json(['success' => false,  'message' => $e->getMessage()]);
        }
    }

    public function getCustomer()
    {

        try {
            $customers =  User::all();
            return response()->json(['success' => true,  'message' => "Customer get successfully ", 'customers' => $customers]);
        } catch (\Exception $e) {
            return response()->json(['success' => false,  'message' => $e->getMessage()]);
        }
    }

    public function blog(Request $request)
    {
        $blog  =   json_encode($request['addBlog']);
        echo $blog;
    }
    public function savecontent(Request $request)
    {
        // $contentHtml = json_encode($request->input('content'));
        // $contentHtml = $request->input('content');
        $contentHtml = htmlspecialchars($request->content);

        // Save content to database
        echo $contentHtml;
    }
}
