<?php

namespace App\Http\Controllers;

use App\Models\Contact_us;
use App\Models\Notification;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function insert(Request $request)
    {
        try {
            $validateData = $request->validate([
                "name" => "required",
                "email" => "required",
                "subject" => "nullable",
                "status" => "nullable",
                "message" => "required",

            ]);

            $contactData = Contact_us::create([
                "name" => $validateData['name'],
                "email" => $validateData['email'],
                "subject" => $validateData['subject'],
                "status" => "pending",
                "message" => $validateData['message'],

            ]);

            Notification::create([
                'heading' =>  $validateData['name'] . ' ' .  "Add query",
                'description' => "New query  added ",
                'type' => "inquiry",

            ]);

            return response()->json(['success' => true,  'message'  => "Data add successfully", "data" => $contactData], 201);
        } catch (\Exception $e) {
            return response()->json(['success', false, 'message' => $e->getMessage()], 500);
        }
    }
    public function getInquiry()
    {

        $inquiries = Contact_us::all();
        return view("inquiry",  compact("inquiries"));
    }
    public function editInquiryData($id)
    {

        $inquiries = Contact_us::all();
        $inquiryData = Contact_us::find($id);
        return view("inquiry",  compact("inquiries", 'inquiryData'));
    }

    public function updateStatus(Request $request)
    {

        try {
            $upd_id = $request['inquiry_id'];
            $inquiry = Contact_us::find($upd_id);
            $inquiry->status = $request['status'];
            $inquiry->update();
            return redirect('inquiry');
            // return response()->json(['success' => $upd_id,  'message'  => "Data add successfully"], 201);
        } catch (\Exception $e) {
            return redirect('inquiry');
            // return response()->json(['success', false, 'message' => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        $inquiry = Contact_us::find($id);
        $inquiry->delete();
        return redirect('inquiry');
    }
}
