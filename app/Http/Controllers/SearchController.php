<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Posts;
use App\UserTags;
use App\Http\Controllers\DashboardController as DashboardController;


class SearchController extends Controller
{

    public static function search(Request $request)
    {
        $searchString = $request->search;
        $search_method = $request->search_method;

        if ($search_method == "users") {
          $result = self::getUsersByName($searchString);
          return view('search')->with('searchUser', $result);
        } else if ($search_method == "description") {
          $result = self::getPostsByDescription($searchString);
          $posts = DashboardController::buildPosts($result);
          var_export($posts);
          exit;
          return view('search')->with('searchDescription', $posts);
        } else {
          //User_tags
          $result = self::getPostsByUserTags($searchString);
          $posts = DashboardController::buildPosts($result);
          return view('search')->with('searchUserTags', $posts);
        }
    }

    public static function getUsersByName($searchString)
    {
        return User::where('name', 'like', '%' . $searchString . '%')->get()->toArray();
    }

    public static function getPostsByDescription($searchString)
    {
        return Posts::where('description', 'like', '%' . $searchString . '%')->orderBy('created_at', 'desc')->get()->toArray();
    }

    public static function getPostsByUserTags($searchString)
    {
        $tags = UserTags::where('user_name', 'like', '%' . $searchString . '%')->orderBy('created_at', 'desc')->get()->toArray();

        $returnArr = [];
        foreach ($tags as $tag) {
          $posts = Posts::where('id', '=', $tag['post_id'])->orderBy('created_at', 'desc')->get()->toArray();
          foreach ($posts as $post) {
            array_push($returnArr, $post);
          }
        }
        return $returnArr;
    }

}
