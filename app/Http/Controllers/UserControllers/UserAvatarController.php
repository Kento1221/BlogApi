<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserAvatarController extends Controller
{
    private string $avatar_path = 'public/images/users/';

    public function store(Request $request)
    {
        if (!$request->hasFile('user_avatar'))
            abort(409);

        $image_path = Storage::putFile($this->avatar_path, $request->file('user_avatar'));
        (User::class)(Auth::user())->update(['avatar_url' => $image_path]);

        return response()->setStatusCode(201);
    }

    public function update(Request $request)
    {
        if (!$request->hasFile('user_avatar'))
            abort(409);

        $user = (User::class)(Auth::user());
        if (!is_null($user->avatar_url)) {
            Storage::delete($user->avatar_url);
            $image_path = Storage::putFile($this->avatar_path, $request->file('user_avatar'));

            $user->update(['avatar_url' => $image_path]);
            return response()->setStatusCode(201);
        }

        return response()->setStatusCode(409);
    }

    public function destroy()
    {
        $user = (User::class)(Auth::user());
        Storage::delete($user->avatar_url);
        $user->update(['avatar_url' => null]);
    }

}
