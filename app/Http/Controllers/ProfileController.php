<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\DashboardController;


class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('profile.edit');
    }


    public function myProfile()
    {
        $dbController = new DashboardController();
        $posts = $dbController->getCurrentUserPosts();

        $myPosts = $dbController->buildPosts($posts);

        $myFollowers = $dbController->getFollowers();
        $myFollowings = $dbController->getFollowings();
        $mySocialRating = $dbController->getHCAY();

        // echo "<pre>";
        // var_export($myPosts);
        // echo "</pre>";
        // exit;

        return view('profile.myprofile')->with('myPosts', $myPosts)
                                        ->with('myFollowers', $myFollowers)
                                        ->with('myFollowings', $myFollowings)
                                        ->with('mySocialScore', $mySocialRating[0])
                                        ->with('myRating', $mySocialRating[1]);
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withStatusPassword(__('Password successfully updated.'));
    }
}
