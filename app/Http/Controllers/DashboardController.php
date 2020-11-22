<?php

namespace App\Http\Controllers;

use App\Following;
use App\Posts;


class DashboardController extends Controller
{
    /**
     * Load the user's dashboard
     *
     */
    public static function loadDashboard()
    {
        //get the logged in user's id - DONE
        //array of the people that id is following - DONE
        //get posts of the 'following' people and sort by date (newest first) and
        //paginate - DONE
        //on paginated data, get comments, likes, dislikes, user tags -DONE
        //possibly make data pretty for front end -DONE
        //send to route
        $user = auth()->user()->toArray();

        $following = Following::where('user_id', '=', $user['id'])->get()->toArray();
        $followingArr = array_column($following, 'follower_user_id');
        $posts = Posts::whereIn('user_id', $followingArr)->orderBy('created_at', 'desc')->get()->toArray();

        $returnPosts = PostController::buildPosts($posts);

        // echo "<pre>";
        // var_export($returnPosts);
        // echo "</pre>";
        // exit;

        return $returnPosts;
    }
}
