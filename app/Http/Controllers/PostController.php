<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return Post::all();
    }
 
    public function show($id)
    {
        return Post::find($id);
    }

    public function store(Request $request)
    {

        $authorization = $request->header('Authorization');
        $token = null;
        if (substr($authorization, 0, 7) === "Bearer ") {
            $token = substr($authorization, 7);
        }     

        if ($token === null) {
            abort(403);
        }

        $user = Auth::user();

        $data  = New Post();

        $data->user_id = $user->id;
        $data->title = $request->title;
        $data->text = $request->text;
        return $data->save();
    }

    public function update(Request $request, $id)
    {

        $authorization = $request->header('Authorization');
        $token = null;
        if (substr($authorization, 0, 7) === "Bearer ") {
            $token = substr($authorization, 7);
        }     

        if ($token === null) {
            abort(403);
        }        

        $Post = Post::findOrFail($id);

        $Post->update($request->all());

        return $Post;
    }

    public function delete(Request $request, $id)
    {
        $authorization = $request->header('Authorization');
        $token = null;
        if (substr($authorization, 0, 7) === "Bearer ") {
            $token = substr($authorization, 7);
        }     

        if ($token === null) {
            abort(403);
        }

        $Post = Post::findOrFail($id);
        $Post->delete();

        return 204;
    }
}