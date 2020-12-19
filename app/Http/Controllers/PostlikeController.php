<?php

namespace App\Http\Controllers;

use App\PostLike;
use Illuminate\Http\Request;

class PostlikeController extends Controller
{
    public function store(Request $request)
    {

        return PostLike::create($request->all());
    }
}