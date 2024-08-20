<?php

namespace App\Http\Controllers;

use App\Models\Contact_us;
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

    public function updateStatus(Request $request)
    {

        try {
            return response()->json(['success' => true,  'message'  => "Data add successfully"], 201);
        } catch (\Exception $e) {
            return response()->json(['success', false, 'message' => $e->getMessage()], 500);
        }
    }
}
