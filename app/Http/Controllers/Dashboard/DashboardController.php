<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\Holiday\HolidayResource;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $holidays = auth()->user()->holidays()->get();
        $holidays = HolidayResource::collection($holidays)->resolve();


        return inertia('Dashboard', compact('holidays'));
    }
}
