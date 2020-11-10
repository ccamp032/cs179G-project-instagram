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
        // var_export($postsArr);
        // echo "</pre>";
        // exit;
        return view('dashboard')
            ->with('postsArr', $postsArr)
            ->with('myPosts', $myPosts)
            ->with('myFollowers', $myFollowers)
            ->with('myFollowings', $myFollowings)
            ->with('mySocialScore', $mySocialScore)
            ->with('myRating', $myRating);
    }
}
