<?php

namespace App\Http\Controllers;
use App\User;
use App\Posts;


class SearchController extends Controller
{

    public static function search()
    {
        var_export(1);
        exit;
        //$search = $request->input('search');
        //$posts = getPostsByDescription($search);
    }

    public static function getUsersByName($searchString)
    {  
        return User::where('name', '=', $searchString)->get()->toArray();
    }

    public static function getPostsByDescription($searchString)
    {
        return Posts::where('description', '=', $searchString)->orderBy('created_at', 'desc')->get()->toArray();
    }

}