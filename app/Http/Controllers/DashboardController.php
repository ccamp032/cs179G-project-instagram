<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Following;
use App\Posts;


class DashboardController extends Controller
{
    /**
     * Load the user's dashboard
     *
     */

    public static function loadDashboard(Request $request) {
        $filterSelection = $request->filter_method;

        $user = auth()->user()->toArray();

        $following = Following::where('user_id', '=', $user['id'])->get()->toArray();
        $followingArr = array_column($following, 'follower_user_id');

        if ($filterSelection == "most_recent") {
            $posts = Posts::whereIn('user_id', $followingArr)->orderBy('created_at', 'desc')->get()->toArray();
        }
        else if ($filterSelection == "most_views") {
            $posts = Posts::whereIn('user_id', $followingArr)->orderBy('views', 'desc')->get()->toArray();
        }
        else if ($filterSelection == "most_likes") {
            $posts = Posts::whereIn('user_id', $followingArr)->orderBy('created_at', 'desc')->get()->toArray();
            $returnPosts = PostController::buildPosts($posts);
            usort($returnPosts, function($a, $b) {
                return $b['likes'] <=> $a['likes'];
            });
            return $returnPosts;
        }
        else if ($filterSelection == "most_dislikes") {
            $posts = Posts::whereIn('user_id', $followingArr)->orderBy('created_at', 'desc')->get()->toArray();
            $returnPosts = PostController::buildPosts($posts);
            usort($returnPosts, function($a, $b) {
                return $b['dislikes'] <=> $a['dislikes'];
            });
            return $returnPosts;
        }
        else {
            $posts = Posts::whereIn('user_id', $followingArr)->orderBy('created_at', 'desc')->get()->toArray();
        }

        $returnPosts = PostController::buildPosts($posts);


        return $returnPosts;
    }
}
