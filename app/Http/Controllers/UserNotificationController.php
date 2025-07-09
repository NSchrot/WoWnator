<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserNotificationController extends Controller
{
    public function markAsRead()
    {
        Auth::user()->notifications()->whereNull('read_at')->update(['read_at' => now()]);

        return response()->json(['status' => 'success']);
    }
}
