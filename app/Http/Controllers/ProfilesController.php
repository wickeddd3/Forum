<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Repositories\ProfileRepositoryInterface;

class ProfilesController extends Controller
{
    protected $profileRepository;

    public function __construct(ProfileRepositoryInterface $profileRepository)
    {
        $this->middleware('auth');

        $this->profileRepository = $profileRepository;
    }

    public function index()
    {
        $authUser = $this->profileRepository->authUser();

        return view('profile.profile')->with('profile', $authUser);
    }

    public function profile($username)
    {
        $profile = $this->profileRepository->profile($username);

        if(request()->wantsJson()) {
            return response()->json([
                'profile' => $profile['authUser'],
                'threads' => $profile['threads'],
                'replies' => $profile['replies'],
                'activity' => $profile['activity']
            ]);
        }
    }

    public function store(ProfileUpdateRequest $request)
    {
        $this->profileRepository->update($request);

        return redirect()->back();
    }

}
