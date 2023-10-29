<?php

namespace App\Http\Controllers\Present;

use App\Http\Controllers\Controller;
use App\Http\Requests\Link\LinkRequest;
use App\Http\Requests\Present\PresentImageRequest;
use App\Http\Requests\Present\StoreRequest;
use App\Http\Requests\Present\UpdateRequest;
use App\Http\Resources\Holiday\HolidayResource;
use App\Http\Resources\Present\PresentResource;
use App\Http\Resources\Present\PresentUserResource;
use App\Models\Present;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;

class PresentController extends Controller
{
    public function createLink(LinkRequest $request)
    {
        $data = $request->validated();

        $client = new Client();
        $res = $client->get($data['link']);

        $content = (string) $res->getBody();
        preg_match_all('/property="og\b[^>]*/i',$content, $items );
        $twitters = $items[0];

        $obj =  (object) 'item';
        if(count($twitters) > 0){
            foreach ($twitters as $twit){
                $matches = array();
                preg_match('/property="([\w\s:-]+)"\scontent=["\']([^"\']+)["\']/', $twit, $matches);
                if (count($matches) === 3) {
                    $property = $matches[1];
                    $content = $matches[2];

                    // Проверяем, является ли свойство "og:locale", "og:title", "og:url" или "og:image"
                    if ($property === 'og:title' || $property === 'og:url' || $property === 'og:image') {
                        $propertyParts = explode(':', $property);
                        $obj->{$propertyParts[1]} = $content;
                    }
                }
            }
        }

        return response()->json($obj);

    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $present = Present::firstOrCreate([
            'holiday_id' => $data['holiday_id'],
            'name' => $data['title'],
            'url_link' => $data['link'],
            'description' => $data['description'],
            'image' => $data['image']
        ]);

        return PresentResource::make($present)->resolve();
    }

    public function destroy(Present $present)
    {
        $present->delete();

        return response()->json(['result' => 1]);
    }

    public function update(UpdateRequest $request, Present $present)
    {
        $data = $request->validated();

        $present->update([
            'id' => $present->id,
            'holiday_id' => $data['holiday_id'],
            'name' => $data['title'],
            'url_link' => $data['link'],
            'description' => $data['description'],
            'image' => $data['image']
        ]);


        return PresentResource::make($present)->resolve();

    }

    public function addPresent(UpdateRequest $request, Present $present)
    {
        $data = $request->validated();

        $present->users()->attach(auth()->id());
        $present->update([
            'id' => $present->id,
            'choose_present' => 1,
            'comment' => $data['comment']
        ]);

        return PresentResource::make($present)->resolve();
    }

    public function show()
    {
        $items = auth()->user()->presents;
        $presentsItems = PresentUserResource::collection($items)->resolve();

        return inertia('Presents/Show', compact('presentsItems'));
    }

}
