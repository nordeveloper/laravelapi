<?php

namespace App\Http\Controllers;

use App\PostLike;
use Illuminate\Http\Request;

class PostlikeController extends Controller
{
    public function store(Request $request)
    {

        // dump($request['liks']);
        // if(  OR !empty($request['disliks']) ){
        //     return PostLike::create($request->all());
        // }  
        
        $data = new PostLike();

        if(!empty($request['like'])){
            $data->liks=$request->like;
        }
        
        if(!empty($request['dislik'])){
            $data->disliks=$request->dislik;
        }

        $data->post_id = $request->post_id;
        return $data->save();        
    }
}