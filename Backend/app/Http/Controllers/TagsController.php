<?php

namespace App\Http\Controllers;

use App\Tags;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    function show() {
        $tags = Tags::orderBy('number','desc')->paginate(15);
        return $tags;
    }
}
