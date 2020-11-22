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

        $myPosts = [];

        foreach($posts as $currentPost) {
            //get get comments
            $comments = $dbController->getPostComments($currentPost['id']);
            //get likes/dislikes
            $likes = $dbController->getPostLikes($currentPost['id']);
            //get user_tags
            $user_tags = $dbController->getPostUserTags($currentPost['id']);

            //get user_info
            $user_info = $dbController->getPostUserInfo($currentPost['user_id']);

            $currentPostArr = [
                'post' => $currentPost,
                'user_info' => $user_info[0],
                'comments' => $comments,
                'likes' => $likes['likes'],
                'dislikes' => $likes['dislikes'],
                'user_tags' => $user_tags
            ];

            array_push($myPosts, $currentPostArr);
        }

        $myFollowers = $dbController->getFollowers();
        $myFollowings = $dbController->getFollowings();
        $mySocialScore = $dbController->getHCAY();

        if( $mySocialScore < 0 )
            $myRating = "Negatively Lame";
        elseif( $mySocialScore < 5 )
            $myRating = "Super Lame";
        elseif( $mySocialScore < 10 )
            $myRating = "Lame";
        elseif( $mySocialScore < 15 )
            $myRating = "Getting There";
        elseif( $mySocialScore < 20 )
            $myRating = "Somewhat Cool";
        elseif( $mySocialScore < 100 )
            $myRating = "Super Awesome";

        // echo "<pre>";
        // var_export($myPosts);
        // echo "</pre>";
        // exit;

        return view('profile.myprofile')->with('myPosts', $myPosts)
                                        ->with('myFollowers', $myFollowers)
                                        ->with('myFollowings', $myFollowings)
                                        ->with('mySocialScore', $mySocialScore)
                                        ->with('myRating', $myRating);
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
