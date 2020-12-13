<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Posts;
use App\Followers;


class PopularController extends Controller
{
    public static function popularUsers() {
        $users = [];
        
        $followers = Followers::select('user_id', Followers::raw('COUNT(user_id) as count'))
        ->groupBy('user_id')
        ->orderby('count', 'desc')
        ->take(20)
        ->get()
        ->toArray();

        foreach($followers as $follower) {
            $followerCount = ['follower_count' => $follower['count']];
            $u = [User::where('id', '=', $follower['user_id'])->get()->first()->toArray(), $followerCount];

            array_push($users, $u);
        }

        // echo "<pre>";
        // var_export($users);
        // echo "</pre>";
        // exit;

        return view('popular.popusers')->with('popularUsers', $users);
    }

    public static function popularPosts() {
        $posts = Posts::select('*', 'views')
        ->groupBy('id')
        ->orderBy('views', 'desc')
        ->take(20)
        ->get()
        ->toArray();

        $posts = PostController::buildPosts($posts);

        // echo "<pre>";
        // var_export($posts);
        // echo "</pre>";
        // exit;

        return view('popular.popposts')->with('popularPosts', $posts);
    }
}
