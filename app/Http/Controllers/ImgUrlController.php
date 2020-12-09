<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ImgUrl;


class ImgUrl extends Controller
{

  public function create($postId, $url) {
    $img_url = new ImgUrl;

    // $newPost->img_url = $filePath;
    $img_url->id = $postId;
    $img_url->url = $url;

    $img_url->save();
  }

  public function get($postId) {
    $img_url =
    ImgUrl::where('id', $postId)
        ->get()->first()->toArray();

    return $img_url;
  }
}
