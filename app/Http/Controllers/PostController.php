<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use App\Posts;
use App\Comments;
use App\Followers;
use App\Following;
use App\LikesDislikes;
use App\UserTags;
use App\User;


class PostController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Update the post
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        var_export("test");
        exit;
        auth()->user()->update($request->all());

        return back()->withStatus(__('Profile successfully updated.'));
    }

    public function createPost(Request $request) {
      $user = auth()->user()->toArray();

      if ($request->has('image')) {
        $newPost = new Posts;

        $image = $request->file('image');
        // Make a image name based on user name and current timestamp
        $name = Str::slug($user['id'].'_'.time());
        // Define folder path
        $folder = '/uploads/images/';
        // Make a file path where image will be stored [ folder path + file name + file extension]
        $filePath = "storage/" . $folder . $name. '.' . $image->getClientOriginalExtension();
        // Upload image
        $this->uploadOne($image, $folder, 'public', $name);

        $newPost->img_url = $filePath;
        $newPost->user_id = $user['id'];
        $newPost->description = $request->input('description');
        $newPost->views = 0;

        $newPost->save();

        $newUserTags = new UserTags;

        $newUserTags->post_id = $newPost->id;
        $newUserTags->user_id = $user['id'];
        $newUserTags->user_name = $user['name'];

        $newUserTags->save();
        return redirect()->route('home')->with(['status' => 'Post created successfully.']);
      } else {
        return redirect()->back()->with(['status' => 'Error with image. Please try again.']);
      }
    }

    public function getUserNames(Request $request){
        $search = $request->search;

        if($search != ''){
           $users = User::select('id','name')->where('name', 'like', '%' .$search . '%')->limit(25)->get();
        }

        $response = array();
        foreach($users as $user){
           $response[] = array("value"=>$user->id,"label"=>$user->name);
        }

        return response()->json($response);
    }

    public function uploadOne(UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = null)
    {
        $name = !is_null($filename) ? $filename : Str::random(25);

        $file = $uploadedFile->storeAs($folder, $name.'.'.$uploadedFile->getClientOriginalExtension(), $disk);

        return $file;
    }

    public static function buildPosts($posts) {
      $user = auth()->user()->toArray();
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

        //check if user liked this post or not
        $likedImage = self::likedImage($currentPost['id'], $user['id']);

        $currentPostArr = [
          'post'        => $currentPost,
          'user_info'   => $user_info[0],
          'comments'    => $comments,
          'likes'       => $likes['likes'],
          'dislikes'    => $likes['dislikes'],
          'user_tags'   => $user_tags,
          'likedImage'  => $likedImage
        ];

        array_push($returnPosts, $currentPostArr);
      }

      return $returnPosts;
    }

    public static function getPostComments($postId) {
        $comments = Comments::where('post_id', '=', $postId)->get()->toArray();

        $commentsArr = [];
        foreach ($comments as $comment) {
          $currentArr['id'] = $comment['id'];
          $currentArr['comment'] = $comment['comment'];
          $currentArr['postDate'] = $comment['created_at'];
          $userName = User::select('name')->where('id', '=', $comment['id'])->get()->toArray();
          $currentArr['userName'] = $userName[0]['name'];

          array_push($commentsArr, $currentArr);
        }

        return $commentsArr;
    }

    public static function likedImage($postId, $userId) {
        $likedImage = LikesDislikes::where("post_id", '=', $postId)->where('user_id', '=', $userId)->first()->toArray();
        if (count($likedImage) == 0) {
          return 2;
        } else {
          return $likedImage['like'];
        }
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
        $posts = Posts::where('user_id', '=', $user['id'])->orderBy('created_at', 'desc')->get()->toArray();
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

    public static function isFollowingUser($followerId) {
      $user = auth()->user()->toArray();

      $isFollowing = Following::where('user_id', '=', $user['id'])->where('follower_user_id', '=', $followerId)->get()->toArray();

      if (count($isFollowing) > 0) {
        return true;
      } else {
        return false;
      }
    }

    public static function getHCAY() {
        $user = auth()->user()->toArray();
        $likeCount = LikesDislikes::where('user_id', '=', $user['id'])->where('like', '=', 1)->get()->toArray();
        $dislikeCount = LikesDislikes::where('user_id', '=', $user['id'])->where('like', '=', 0)->get()->toArray();
        $hcay = count($likeCount) - count($dislikeCount);

        if( $hcay < 0 )
            $myRating = "Negatively Lame";
        elseif( $hcay < 5 )
            $myRating = "Super Lame";
        elseif( $hcay < 10 )
            $myRating = "Lame";
        elseif( $hcay < 15 )
            $myRating = "Getting There";
        elseif( $hcay < 20 )
            $myRating = "Somewhat Cool";
        elseif( $hcay < 100 )
            $myRating = "Super Awesome";

        return [$hcay, $myRating];
    }

    public static function getPostUserInfo($userId) {
        $userInfo = User::where('id', '=', $userId)->get()->toArray();
        return $userInfo;
    }

    public static function getUserInfo() {
      $user = auth()->user()->toArray();
      $userInfo = User::where('id', '=', $user['id'])->get()->toArray();
      return $userInfo[0];
    }


    // Functions to get user post and profile data
    public static function getUserPosts($userId) {
      $posts = Posts::where('user_id', '=', $userId)->orderBy('created_at', 'desc')->get()->toArray();
      return self::buildPosts($posts);
    }

    public static function getUserFollowers($userId) {
      $followers = Followers::where('user_id', '=', $userId)->get()->toArray();
      return $followers;
    }

    public static function getUserFollowings($userId) {
      $followings = Following::where('user_id', '=', $userId)->get()->toArray();
      return $followings;
    }

    public static function getUserHCAY($userId) {
      $likeCount = LikesDislikes::where('user_id', '=', $userId)->where('like', '=', 1)->get()->toArray();
      $dislikeCount = LikesDislikes::where('user_id', '=', $userId)->where('like', '=', 0)->get()->toArray();
      $hcay = count($likeCount) - count($dislikeCount);

      if( $hcay < 0 )
          $myRating = "Negatively Lame";
      elseif( $hcay < 5 )
          $myRating = "Super Lame";
      elseif( $hcay < 10 )
          $myRating = "Lame";
      elseif( $hcay < 15 )
          $myRating = "Getting There";
      elseif( $hcay < 20 )
          $myRating = "Somewhat Cool";
      elseif( $hcay < 100 )
          $myRating = "Super Awesome";

      return [$hcay, $myRating];
  }

  public static function likePhoto(Request $request) {
    $user = auth()->user()->toArray();

    $postID = $request->post_id;

    $userID = $user['id'];

    $like = LikesDislikes::where('post_id', '=', $postID)->where('user_id', '=', $userID)->first();

    if (empty($like)) {
      $like = new LikesDislikes;
      $like->post_id = $postID;
      $like->user_id = $userID;
    }

    $like->like = 1;

    $like->save();


    $returnArr = self::getPostLikes($postID);

    return response()->json($returnArr);
  }

  public static function dislikePhoto(Request $request) {
    $user = auth()->user()->toArray();

    $postID = $request->post_id;

    $userID = $user['id'];

    $like = LikesDislikes::where('post_id', '=', $postID)->where('user_id', '=', $userID)->first();

    if (empty($like)) {
      $like = new LikesDislikes;
      $like->post_id = $postID;
      $like->user_id = $userID;
    }

    $like->like = 0;

    $like->save();


    $returnArr = self::getPostLikes($postID);

    return response()->json($returnArr);
  }

  public static function incrementViews(Request $request) {
    //increment number of views in posts table
    $postId = $request->post_id;

    $post = Posts::find($postId);

    $numberOfViews = $post['views'] + 1;
    $post->views = $numberOfViews;

    $post->save();

    return response()->json($numberOfViews);
  }
}
