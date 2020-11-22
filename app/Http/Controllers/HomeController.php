<?php

namespace App\Http\Controllers;
use App\Http\Controllers\DashboardController;

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
        $dbController = new DashboardController();
        $postsArr = $dbController->loadDashboard();
        $myPosts = $dbController->getCurrentUserPosts();
        $myFollowers = $dbController->getFollowers();
        $myFollowings = $dbController->getFollowings();
        $mySocialRating = $dbController->getHCAY();

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
