<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Thread;
use App\Reply;
use App\Activity;

class ProfilesController extends Controller
{
    public function index()
    {
        return view('profile.profile')->with('profile', Auth::user());
    }

    public function profile($username)
    {
        if(request()->wantsJson()) {
            return response()->json([
                'profile' => Auth::user(),
                'threads' => Thread::where('user_id', Auth::id())->get(),
                'replies' => Reply::where('user_id', Auth::id())->with('thread')->get(),
                'activity' => Activity::feed(Auth::user())
            ]);
        }
    }

    /**
     * Update Authenticated User Profile
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,'.$user->id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
        ]);

        if($request->filled('avatar')) {
            $avatar = $request->avatar;
            $new_name = time().'.' . explode('/', explode(':', substr($avatar, 0, strpos($avatar, ';')))[1])[1];
            \Image::make($avatar)->save(public_path('/storage/uploads/avatars/').$new_name);
            if($user->profile->avatar != 'uploads/avatars/default_avatar.png'){
                $user->deleteAvatar();
            }
            $user->profile->avatar = 'uploads/avatars/'.$new_name;
            $user->push();
        }

        if($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->profile->about = $request->about;
        $user->push();

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;

        $user->save();

        return redirect()->back();
    }

}
