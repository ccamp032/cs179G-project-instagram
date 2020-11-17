<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Posts;
use App\UserTags;


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
}
