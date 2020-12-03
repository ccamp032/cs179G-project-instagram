<?php

namespace App\Http\Controllers;

use App\Followers;
use App\Following;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


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
        $posts = PostController::getCurrentUserPosts();
        $myPosts = PostController::buildPosts($posts);
        $myFollowers = PostController::getFollowers();
        $myFollowings = PostController::getFollowings();
        $mySocialRating = PostController::getHCAY();
        $myInfo = PostController::getUserInfo();

        // echo "<pre>";
        // var_export($myInfo);
        // echo "</pre>";
        // exit;

        return view('profile.myprofile')->with('myInfo', $myInfo)
                                        ->with('myPosts', $myPosts)
                                        ->with('myFollowers', $myFollowers)
                                        ->with('myFollowings', $myFollowings)
                                        ->with('mySocialScore', $mySocialRating[0])
                                        ->with('myRating', $mySocialRating[1]);
    }

    public static function getProfile($userId)
    {
        $userPosts = PostController::getUserPosts($userId);
        $userFollowers = PostController::getUserFollowers($userId);
        $userFollowings = PostController::getUserFollowings($userId);
        $userSocialRating = PostController::getUserHCAY($userId);
        $userInfo = PostController::getPostUserInfo($userId)[0];
        // echo "<pre>";
        // var_export($userInfo);
        // echo "</pre>";
        // exit;
        return view('profile.userprofile')->with('userInfo', $userInfo)
                                          ->with('userPosts', $userPosts)
                                          ->with('userFollowers', $userFollowers)
                                          ->with('userFollowings', $userFollowings)
                                          ->with('userSocialScore', $userSocialRating[0])
                                          ->with('userRating', $userSocialRating[1]);
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

    public static function followUser(Request $request) {
        $currentUser = $user = auth()->user()->toArray();
        $user = $request->user_id;

        $following = new Following();
        $following->user_id = $currentUser['id'];
        $following->follower_user_id = $user['id'];

        $follower = new Followers();
        $follower->user_id = $user['id'];
        $follower->followe_user_id = $currentUser['id'];

        $following->save();
        $follower->save();
        return response()->json("test1");
    }

    public static function unfollowUser(Request $request) {
        $currentUser = $user = auth()->user()->toArray();
        $user = $request->user_id;
        return response()->json("test2");
    }
}
