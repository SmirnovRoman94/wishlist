<?php

namespace App\Http\Controllers\Holiday;

use App\Http\Controllers\Controller;
use App\Http\Requests\Holiday\StoreRequest;
use App\Http\Requests\Holiday\UpdateRequest;
use App\Http\Resources\Holiday\HolidayResource;
use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HolidayController extends Controller
{
    public function create()
    {
        return inertia('Holiday/Create');
    }

    public function store( StoreRequest $request)
    {
        $data = $request->validated();


        Holiday::firstOrCreate([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'date' => $data['date'],
            'user_id' => auth()->id(),
            'holiday_img' => $data['img']
        ]);

        return redirect()->route('dashboard.index');
    }

    public function show(Holiday $holiday)
    {

        $holidayItem = HolidayResource::make($holiday)->resolve();
        return inertia('Holiday/Show', compact('holidayItem'));
    }

    public function edit(Holiday $holiday)
    {
        $holidayItem = HolidayResource::make($holiday)->resolve();
        return inertia('Holiday/Edit', compact('holidayItem'));
    }

    public function update(Holiday $holiday, UpdateRequest $request)
    {
        $data = $request->validated();

        $holiday->update([
            'id' => $holiday->id,
            'date' => $data['date'],
            'title' => $data['title'],
            'user_id' => auth()->id(),
            'description' => $data['description'],
            'holiday_img' => $data['img']
        ]);

        $holidayItem = HolidayResource::make($holiday)->resolve();
        return inertia('Holiday/Show', compact('holidayItem'));
    }

    public function destroy(Holiday $holiday)
    {
        $holiday->delete();

        return redirect()->route('dashboard.index');
    }
}
