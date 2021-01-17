<?php

namespace App\Repositories;

use App\Interfaces\ProfileRepositoryInterface;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\Activity;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileRepository implements ProfileRepositoryInterface
{
    protected $thread, $reply;

    public function __construct(Thread $thread, Reply $reply)
    {
        $this->thread = $thread;
        $this->reply = $reply;
    }
    public function authUser()
    {
        return Auth::user();
    }

    public function profile($username)
    {
        $authUser = $this->authUser();
        $authUserThreads = $this->thread->where('user_id', Auth::id())->get();
        $authUserReplies = $this->reply->where('user_id', Auth::id())->with('thread')->get();
        // $activity = Activity::feed($this->authUser());

        return ["authUser" => $authUser, "threads" => $authUserThreads, "replies" => $authUserReplies, "activity" => []];
    }

    public function update($request)
    {
        $user = $this->authUser();

        if($request->filled('avatar')) {
            $avatar = $request->avatar;
            $new_name = time().'.' . explode('/', explode(':', substr($avatar, 0, strpos($avatar, ';')))[1])[1];
            \Image::make($avatar)->save(public_path('/storage/uploads/avatars/').$new_name);
            if($user->avatar != 'uploads/avatars/default_avatar.png'){
                $user->deleteAvatar();
            }
            $user->avatar = 'uploads/avatars/'.$new_name;
        }

        if($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;

        $user->save();
    }
}
