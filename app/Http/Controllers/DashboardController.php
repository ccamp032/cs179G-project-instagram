<?php

namespace App\Http\Controllers;

// use App\Http\Requests\ProfileRequest;
// use App\Http\Requests\PasswordRequest;
// use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    /**
     * Load the user's dashboard
     *
     */
    public function loadDashboard()
    {
        //get the logged in user's id
        //array of the people that id is following
        //get posts of the 'following' people and sort by date (newest first) and
        //paginate
        //on paginated data, get comments, likes, dislikes, user tags
        //possibly make data pretty for front end
        //send to route
        $user = auth()->user();
        echo "<pre>";
        var_export($user);
        echo "</pre>";
        exit;

        auth()->user()->update($request->all());

        return back()->withStatus(__('Profile successfully updated.'));
    }
}
