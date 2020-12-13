<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Posts;
use App\UserTags;
use App\Followers;


class SearchController extends Controller
{

    public static function search(Request $request)
    {
        $searchString = $request->search;
        $search_method_1 = $request->search_method_1;
        $search_method_2 = $request->search_method_2;

        $users = [];
        $posts = [];

        //Users_name
        if ($search_method_1 == "users") {

          if($search_method_2 == "name") {
            $users = self::getUsersByName($searchString);
          }
          else if($search_method_2 == "follower_count") {
            $users = self::getUserbyFollowers($searchString);
          }
          //User_by post_description
          else if ($search_method_2 == "post_description") {
            $users = self::getUsersByPostDescription($searchString);
          }

        }
        else if ($search_method_1 == "posts") {
          //Post_by_user
          if ($search_method_2 == "user_name") {
            $posts = self::getPostsByUser($searchString);
          }
          //Posts_by_views 
          else if ($search_method_2 == "post_views") {
            $posts = self::getPostsByViews($searchString);
          }
          //Posts_description
          else if ($search_method_2 == "description") {
            $result = self::getPostsByDescription($searchString);
            $posts = PostController::buildPosts($result);
          }
          //User_tags 
          else if ($search_method_2 == "user_tags"){
            $result = self::getPostsByUserTags($searchString);
            $posts = PostController::buildPosts($result);
          }
          //Posts_by_date
          else if ($search_method_2 == "post_date"){
            $posts = self::getPostsByDate($searchString);
          }

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

    
    public static function getPostUserInfo($userId) {
        $userInfo = User::where('id', '=', $userId)->get()->first()->toArray();
        return $userInfo;
    }

    public static function getUsersByPostDescription($searchString)
    {
        $postDescriptions = Posts::where('description', 'like', '%' . $searchString . '%')->orderBy('user_id', 'asc')->get()->toArray();

        $returnArr = [];

        foreach($postDescriptions as $postDescription) {
          $userInfo = self::getPostUserInfo($postDescription['user_id']);
          array_push($returnArr, $userInfo);
        }

        return $returnArr;
    }


    public static function getPostsByUser($searchString)
    {

        $userlist = User::where('name', 'like', '%' . $searchString . '%')->get()->toArray();

        $returnArr = [];

        foreach($userlist as $user) {
          $posts = PostController::getUserPosts($user['id']);
        
          foreach ($posts as $post) {
            array_push($returnArr, $post);
          }
        }
        
        return $returnArr;

    }

    public static function getPostsByViews($searchString)
    {
        //$userInfo = User::where('id', '=', $userId)->get()->toArray();
        $postsViews = Posts::where('views', '=', $searchString)->orderBy('views', 'desc')->get()->toArray();

        return PostController::buildPosts($postsViews);
    }

    public static function getUserbyFollowers($searchString)
    {
        
      $followers = Followers::select('user_id', Followers::raw('COUNT(user_id) as count'))
      ->groupBy('user_id')
      ->orderby('count', 'desc')
      ->get()
      ->toArray();

      $returnArr = [];

      foreach($followers as $follower) {
        if($follower['count'] == $searchString) {
          $userInfo = self::getPostUserInfo($follower['user_id']);
          array_push($returnArr, $userInfo);
        }
      }

      return $returnArr;
    }

    public static function getPostsByDate($searchString)
    {

      $postsDates = Posts::whereDate('created_at', date($searchString))->orderBy('created_at', 'desc')->get()->toArray();
      
      dd($postsDates);
    }

}
