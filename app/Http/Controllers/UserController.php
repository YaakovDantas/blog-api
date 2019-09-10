<?php

namespace App\Http\Controllers;

use App\{User};
use Illuminate\Http\Request;
use App\Http\Resources\{PostResource, UserResource, CommentResource};
use Illuminate\Support\Facades\Validator;



class UserController extends Controller
{
    public function getUserPosts($id)
    {
        $user = User::find($id);
        if(!is_null($user))
        {
            $posts =  $user->posts;
            return PostResource::collection($posts);
        }
        $response = [
            'message' => 'Nada encontrado!'
        ];
        return response()->json( $response, 404);
    }

    public function getUserComments($id)
    {
        $user = User::find($id);
        if(!is_null($user))
        {
            $comments =  $user->comments;
            return CommentResource::collection($comments);
        }
        $response = [
            'message' => 'Nada encontrado!'
        ];
        return response()->json( $response, 404);
    }
}
 










