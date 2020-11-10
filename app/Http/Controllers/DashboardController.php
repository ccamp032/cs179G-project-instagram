<?php

namespace App\Http\Controllers;

use App\Following;
use App\Posts;
use App\Comments;
use App\Followers;
use App\LikesDislikes;
use App\UserTags;
use App\User;

class DashboardController extends Controller
{
    /**
     * Load the user's dashboard
     *
     */
     // echo "<pre>";
     // var_export($user['id']);
     // echo "</pre>";
     // exit;
    public function loadDashboard()
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
        $posts = Posts::whereIn('user_id', $followingArr)->orderBy('created_at', 'asc')->get()->toArray();

        $returnPosts = [];
        foreach($posts as $currentPost) {
          //get get comments
          $comments = self::getPostComments($currentPost['id']);
          //get likes/dislikes
          $likes = self::getPostLikes($currentPost['id']);
          //get user_tags
          $user_tags = self::getPostUserTags($currentPost['id']);

          //get user_info
          $user_info = self::getPostUserInfo($currentPost['user_id']);

          $currentPostArr = [
            'post' => $currentPost,
            'user_info' => $user_info[0],
            'comments' => $comments,
            'likes' => $likes['likes'],
            'dislikes' => $likes['dislikes'],
            'user_tags' => $user_tags
          ];

          array_push($returnPosts, $currentPostArr);
        }

        // echo "<pre>";
        // var_export($returnPosts);
        // echo "</pre>";
        // exit;

        return $returnPosts;
    }

    public static function getPostComments($postId) {
        $comments = Comments::where('post_id', '=', $postId)->get()->toArray();

        return $comments;
    }

    public static function getPostLikes($postId) {
        $likeMatch = [
          'post_id' => $postId,
          'like' => 1
        ];
        $likes = LikesDislikes::where($likeMatch)->count();

        $dislikeMatch = [
          'post_id' => $postId,
          'like' => 0
        ];
        $dislikes = LikesDislikes::where($dislikeMatch)->count();

        $returnArr = [
          'likes' => $likes,
          'dislikes' => $dislikes
        ];

        return $returnArr;
    }

    public static function getPostUserTags($postId) {
        $userTags = UserTags::where('post_id', '=', $postId)->get()->toArray();
        $returnArr = [];
        foreach ($userTags as $currentUser) {
          $id = $currentUser['id'];
          $name = $currentUser['user_name'];
          $currentArr = [
            'id' => $id,
            'name' => $name
          ];
          array_push($returnArr, $currentArr);
        }

        return $returnArr;
    }

    public static function getCurrentUserPosts() {
        $user = auth()->user()->toArray();
        $posts = Posts::where('user_id', '=', $user['id'])->get()->toArray();
        return $posts;
    }

    public static function getFollowers() {
        $user = auth()->user()->toArray();
        $followers = Followers::where('user_id', '=', $user['id'])->get()->toArray();
        return $followers;
    }

    public static function getFollowings() {
        $user = auth()->user()->toArray();
        $followings = Following::where('user_id', '=', $user['id'])->get()->toArray();
        return $followings;
    }

    public static function getHCAY() {
        $user = auth()->user()->toArray();
        $likeCount = LikesDislikes::where('user_id', '=', $user['id'])->where('like', '=', 1)->get()->toArray();
        $dislikeCount = LikesDislikes::where('user_id', '=', $user['id'])->where('like', '=', 0)->get()->toArray();
        $hcay = count($likeCount) - count($dislikeCount);
        return $hcay;
    }

    public static function getPostUserInfo($userId) {
        $userInfo = User::where('id', '=', $userId)->get()->toArray();
        return $userInfo;
    }

}
