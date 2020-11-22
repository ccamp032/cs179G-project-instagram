<?php

namespace App\Http\Controllers;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        //return view('dashboard');
        $postsArr = DashboardController::loadDashboard();

        $myPosts = PostController::getCurrentUserPosts();
        $myFollowers = PostController::getFollowers();
        $myFollowings = PostController::getFollowings();
        $mySocialRating = PostController::getHCAY();

        // echo "<pre>";
        // var_export($postsArr);
        // echo "</pre>";
        // exit;
        return view('dashboard')
            ->with('postsArr', $postsArr)
            ->with('myPosts', $myPosts)
            ->with('myFollowers', $myFollowers)
            ->with('myFollowings', $myFollowings)
            ->with('mySocialScore', $mySocialRating[0])
            ->with('myRating', $mySocialRating[1]);
    }
}
