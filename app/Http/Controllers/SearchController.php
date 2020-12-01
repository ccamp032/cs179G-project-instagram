<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Posts;
use App\UserTags;


class SearchController extends Controller
{

    public static function search(Request $request)
    {
        $searchString = $request->search;
        $search_method = $request->search_method;

        $users = [];
        $posts = [];

        //Users_name
        if ($search_method == "users") {
          $users = self::getUsersByName($searchString);
        } 
        //Posts_description
        else if ($search_method == "description") {
          $result = self::getPostsByDescription($searchString);
          $posts = PostController::buildPosts($result);
        }
        //User_tags
        else {
          $result = self::getPostsByUserTags($searchString);
          $posts = PostController::buildPosts($result);
        }

        return view('search.search')->with('searchUser', $users)
                                    ->with('searchPosts', $posts);
    }

    public static function getUsersByName($searchString)
    {
        $currentUser = auth()->user()->toArray();
        $userList = User::where('name', 'like', '%' . $searchString . '%')->get()->toArray();
        $userList = self::removeElementWithValue($userList, 'id', $currentUser['id']);
        return $userList;
    }

    private static function removeElementWithValue($array, $key, $value) {  
        foreach($array as $subKey => $subArray){
             if($subArray[$key] == $value){
                  unset($array[$subKey]);
             }
        }
        return $array;
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
