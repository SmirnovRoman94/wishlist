<?php

namespace App\Http\Controllers;

use App\Http\Requests\PresentImage\StoreRequest;
use App\Http\Resources\PresentImage\PresentImageResource;
use App\Models\PresentImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PresentImageController extends Controller
{
    public function store(StoreRequest $request)
    {
        $path = Storage::disk('public')->put('/presents', $request['image']);
        $image = PresentImage::create([
            'path' => $path,
            'holiday_id' => $request['holiday_id']
        ]);

        return new PresentImageResource($image);

    }
}
