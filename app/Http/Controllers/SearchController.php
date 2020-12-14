<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Posts;
use App\UserTags;
use App\Followers;
use App\LikesDislikes;
use App\Comments;


class SearchController extends Controller
{

    public static function search(Request $request)
    {
        $searchString = $request->search;
        $search_method_1 = $request->search_method_1;
        $search_method_2 = $request->search_method_2;
        $search_method_3 = $request->search_method_3;

        $users = [];
        $posts = [];

        //Users_name
        if ($search_method_1 == "users") {

          if($search_method_2 == "name") {
            $users = self::getUsersByName($searchString);
          }
          else if($search_method_2 == "follower_count") {
            $users = self::getUserbyFollowers($searchString, $search_method_3);
          }
          //User_by post_description
          else if ($search_method_2 == "post_description") {
            $users = self::getUsersByPostDescription($searchString);
          }
          //User_by user_tags
          else if ($search_method_2 == "user_tags") {
            $users = self::getUsersByUserTags($searchString);
          }
          //User_by misc_tags
          else if ($search_method_2 == "misc_tags") {
            $users = self::getUsersByMiscTags($searchString);
          }
          //User_by_likes
          else if ($search_method_2 == "like_count"){
            $users = self::getUsersByLikeCount($searchString, $search_method_3);
          }
          //User_by_posts
          else if ($search_method_2 == "post_count"){
            $users = self::getUsersByPostCount($searchString, $search_method_3);
          }

        }
        else if ($search_method_1 == "posts") {
          //Post_by_user
          if ($search_method_2 == "user_name") {
            $posts = self::getPostsByUser($searchString);
          }
          //Posts_by_views
          else if ($search_method_2 == "post_views") {
            $posts = self::getPostsByViews($searchString, $search_method_3);
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
          //Misc_tags
          else if ($search_method_2 == "misc_tags"){
            $result = self::getPostsByMiscTags($searchString);
            $posts = PostController::buildPosts($result);
          }
          //Posts_by_date
          else if ($search_method_2 == "post_date"){
            $posts = self::getPostsByDate($request->post_date);
          }
          //Posts_by_likes
          else if ($search_method_2 == "like_count"){
            $posts = self::getPostsByLikeCount($searchString, $search_method_3);
          }
          //Posts_by_comments
          else if ($search_method_2 == "comments_count"){
            $posts = self::getPostsByCommentCount($searchString, $search_method_3);
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

    public static function getPostsByMiscTags($searchString)
    {
        $posts = Posts::where('misc_tags', 'like', '%' . $searchString . '%')->orderBy('created_at', 'desc')->get()->toArray();

        $returnArr = [];
        foreach ($posts as $post) {
          array_push($returnArr, $post);
        }
        return $returnArr;
    }

    public static function getUsersByUserTags($searchString)
    {
        $tags = UserTags::where('user_name', 'like', '%' . $searchString . '%')->orderBy('created_at', 'desc')->get()->toArray();

        $returnArr = [];
        foreach ($tags as $tag) {
          $posts = Posts::where('id', '=', $tag['post_id'])->orderBy('created_at', 'desc')->get()->toArray();
          foreach ($posts as $post) {
            $userInfo = self::getPostUserInfo($post['user_id']);
            if(!in_array($userInfo, $returnArr, true)){
                array_push($returnArr, $userInfo);
            }
          }
        }
        return $returnArr;
    }

    public static function getUsersByMiscTags($searchString)
    {
        $posts = Posts::where('misc_tags', 'like', '%' . $searchString . '%')->orderBy('created_at', 'desc')->get()->toArray();

        $returnArr = [];
        foreach ($posts as $post) {
          $userInfo = self::getPostUserInfo($post['user_id']);
          if(!in_array($userInfo, $returnArr, true)){
              array_push($returnArr, $userInfo);
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

    public static function getPostsByViews($searchString, $searchMethod)
    {
        //$userInfo = User::where('id', '=', $userId)->get()->toArray();
        if($searchMethod == "less_than") {
          $postsViews = Posts::where('views', '<', $searchString)->orderBy('views', 'desc')->get()->toArray();
        } else if($searchMethod == "equal_to") {
          $postsViews = Posts::where('views', '=', $searchString)->orderBy('views', 'desc')->get()->toArray();
        }else if($searchMethod == "greater_than") {
          $postsViews = Posts::where('views', '>', $searchString)->orderBy('views', 'desc')->get()->toArray();
        }
        

        return PostController::buildPosts($postsViews);
    }

    // Cant use search string of 0
    public static function getUserbyFollowers($searchString, $searchMethod)
    {
      $users = User::select('*')->get()->toArray();

      $followers = [];

      foreach($users as $user) {
        array_push($followers, ['user_id'=> $user['id'], 'follower_count'=>count(PostController::getUserFollowers($user['id']))]);
      }

      $returnArr = [];

      foreach($followers as $follower) {
        if($searchMethod == "less_than") {
          if(intval($follower['follower_count']) < intval($searchString)) {
            array_push($returnArr, self::getPostUserInfo($follower['user_id']));
          }
        }else if($searchMethod == "equal_to") {
          if($follower['follower_count'] == $searchString) {
            array_push($returnArr, self::getPostUserInfo($follower['user_id']));
          }
        }else if($searchMethod == "greater_than") {
          if(intval($follower['follower_count']) > intval($searchString)) {
            array_push($returnArr, self::getPostUserInfo($follower['user_id']));
          }
        }
      }

      return $returnArr;
    }

    public static function getPostsByDate($searchString)
    {
      // regex to match date of format mm-dd-yyyy or m-d-yyyy
      $date_pattern1 = "/([0-9]{1,2})-([0-9]{1,2})-([0-9]{4})/i";

      // if date entered in format mm-dd-yyyy or m-d-yyyy reformat to yyyy-mm-dd or yyyy-m-d for searching posts
      if(preg_match($date_pattern1, $searchString, $matches)) {
        //dd($matches);
        $searchString = $matches[3] . "-" . $matches[1] . "-" . $matches[2];
      }
      
      //dd($searchString);
      $postsDates = Posts::whereDate('created_at', date($searchString))->orderBy('created_at', 'desc')->get()->toArray();

      //dd($postsDates);
      return PostController::buildPosts($postsDates);
    }

    // Cant use search string of 0
    public static function getPostsByLikeCount($searchString, $searchMethod)
    {

      $postLikes = LikesDislikes::select('post_id', LikesDislikes::raw('COUNT(post_id) as count'))
      ->where('like', '=', 1)
      ->groupBy('post_id')
      ->orderby('count', 'desc')
      ->get()
      ->toArray();

      $returnArr = [];
      
      foreach($postLikes as $postLike) {
        if($searchMethod == "less_than") {
          if(intval($postLike['count']) < intval($searchString)) {
            array_push($returnArr, Posts::where('id', '=', $postLike['post_id'])->get()->first()->toArray());
          }
        }else if($searchMethod == "equal_to") {
          if($postLike['count'] == $searchString) {
            array_push($returnArr, Posts::where('id', '=', $postLike['post_id'])->get()->first()->toArray());
          }
        }else if($searchMethod == "greater_than") {
          if(intval($postLike['count']) > intval($searchString)) {
            array_push($returnArr, Posts::where('id', '=', $postLike['post_id'])->get()->first()->toArray());
          }
        }
      }

      //dd($returnArr);
      return PostController::buildPosts($returnArr);
    }

    public static function getUsersByLikeCount($searchString, $searchMethod) {
      $postLikes = LikesDislikes::select('user_id', LikesDislikes::raw('COUNT(user_id) as count'))
      ->where('like', '=', 1)
      ->groupBy('user_id')
      ->orderby('count', 'desc')
      ->get()
      ->toArray();

      $returnArr = [];

      foreach($postLikes as $postLike) {
        if($searchMethod == "less_than") {
          if(intval($postLike['count']) < intval($searchString)) {
            array_push($returnArr, self::getPostUserInfo($postLike['user_id']));
          }
        }else if($searchMethod == "equal_to") {
          if($postLike['count'] == $searchString) {
            array_push($returnArr, self::getPostUserInfo($postLike['user_id']));
          }
        }else if($searchMethod == "greater_than") {
          if(intval($postLike['count']) > intval($searchString)) {
            array_push($returnArr, self::getPostUserInfo($postLike['user_id']));
          }
        }
      }

      return $returnArr;
    }

    public static function getUsersByPostCount($searchString, $searchMethod) {
      $postCounts= Posts::select('user_id', LikesDislikes::raw('COUNT(user_id) as count'))
      ->groupBy('user_id')
      ->orderby('count', 'desc')
      ->get()
      ->toArray();

      $returnArr = [];

      foreach($postCounts as $postCount) {
        if($searchMethod == "less_than") {
          if(intval($postCount['count']) < intval($searchString)) {
            array_push($returnArr, self::getPostUserInfo($postCount['user_id']));
          }
        }else if($searchMethod == "equal_to") {
          if($postCount['count'] == $searchString) {
            array_push($returnArr, self::getPostUserInfo($postCount['user_id']));
          }
        }else if($searchMethod == "greater_than") {
          if(intval($postCount['count']) > intval($searchString)) {
            array_push($returnArr, self::getPostUserInfo($postCount['user_id']));
          }
        }
      }

      return $returnArr;
    }

    // Cant use search string of 0 becuse they do not exixt in the commnets table
    public static function getPostsByCommentCount($searchString, $searchMethod)
    {
      $postComments = Comments::select('post_id', Comments::raw('COUNT(post_id) as count'))
      ->groupBy('post_id')
      ->get()
      ->toArray();

      $returnArr = [];
      //dd($postComments);
      foreach($postComments as $postComment) {
        if($searchMethod == "less_than") {
          if(intval($postComment['count']) < intval($searchString)) {
            array_push($returnArr, Posts::where('id', '=', $postComment['post_id'])->get()->first()->toArray());
          }
        }else if($searchMethod == "equal_to") {
          if($postComment['count'] == $searchString) {
            array_push($returnArr, Posts::where('id', '=', $postComment['post_id'])->get()->first()->toArray());
          }
        }else if($searchMethod == "greater_than") {
          if(intval($postComment['count']) > intval($searchString)) {
            array_push($returnArr, Posts::where('id', '=', $postComment['post_id'])->get()->first()->toArray());
          }
        }
      }

      //dd($returnArr);
      return PostController::buildPosts($returnArr);
    }

}
