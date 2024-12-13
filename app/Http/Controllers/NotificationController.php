<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::orderBy('created_at', 'desc')->get();
        $notifications->each(function ($item) {
            $item->time_ago = $item->created_at->diffForHumans();
        });

        // return response()->json($notifications);
        return view('notifications', compact('notifications'));
    }
    public function delete($id)
    {

        try {
            $notifications = Notification::find($id);
            if (!$notifications) {
                return response()->json(["success"  => false, "message" => "There is some problem reload the page"], 422);
            }
            $notifications->delete();
            return response()->json(["success"  => true, "message" => "Move succesfully"], 200);
        } catch (\Exception $e) {
            return response()->json(["success"  => false, "message" => $e->getMessage()], 500);
        }
    }
}
