<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class ImgUrl extends Eloquent
{
    protected $collection = 'img_url';
    protected $primaryKey = 'id';
    protected $connection = 'mongodb';
    protected $fillable = ['id'];
}
