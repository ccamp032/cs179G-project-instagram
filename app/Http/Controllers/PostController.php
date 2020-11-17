<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function createPost($request) {
      var_export("in create function");
      exit;
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
}
