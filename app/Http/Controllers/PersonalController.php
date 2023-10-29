<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserRequest;
use App\Http\Requests\User\UserSearchRequest;
use App\Http\Resources\User\UserHolidayResource;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PersonalController extends Controller
{
    public function edit()
    {
        $user = UserResource::make(auth()->user())->resolve();
        return inertia('Personal/Personal', compact('user'));
    }

    public function update(UserRequest $request)
    {
        $data = $request->validated();
//        $path = Storage::disk('public')->put('/avatars', $data['avatar']);

        auth()->user()->update([
            'avatar' => $data['avatar'],
            'about' => $data['content'],
            'birthday' => $data['date']
        ]);

       return redirect()->route('dashboard.index');
    }

    public function listUsers()
    {
        $oderUsers = User::where('id', '!=', auth()->id())->get();
        $users = UserResource::collection($oderUsers)->resolve();
        return inertia('Personal/Users', compact('users'));
    }

    public function usersSearch(UserSearchRequest $request)
    {
        $data = $request->validated();

        $user = User::where('nick',$data['nick'])->get();

        return UserResource::collection($user)->resolve();
    }

    public function show(User $user)
    {
        $user = UserHolidayResource::make($user)->resolve();
        return inertia('Personal/UserShow', compact('user'));
    }

}
