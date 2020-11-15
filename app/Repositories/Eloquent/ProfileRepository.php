<?php

namespace App\Repositories\Eloquent;

use App\Models\Activity;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ProfileRepositoryInterface;

class ProfileRepository implements ProfileRepositoryInterface
{
    public function authUser()
    {
        return Auth::user();
    }

    public function profile($username)
    {
        $authUser = $this->authUser();
        $threads = Thread::where('user_id', Auth::id())->get();
        $replies = Reply::where('user_id', Auth::id())->with('thread')->get();
        // $activity = Activity::feed($this->authUser());

        return ["authUser" => $authUser, "threads" => $threads, "replies" => $replies, "activity" => []];
    }

    public function update($request)
    {
        $user = $this->authUser();

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
    }
}
