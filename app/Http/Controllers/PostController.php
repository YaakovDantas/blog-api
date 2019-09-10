<?php

namespace App\Http\Controllers;

use App\{Post};
use Illuminate\Http\Request;
use App\Http\Resources\{PostResource, CommentResource};
use Illuminate\Support\Facades\Validator;



class PostController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginate = $request->per_page;
        return PostResource::collection(Post::query()->orderBy('title')->paginate($paginate));
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, 
        [   'title' => 'required|min:15', 
        ],[
            'required' => 'O campo :attribute é obrigatório',
            'title.min' => 'O dado passado no campo :attribute deve ser maior',
        ],[
            'title' => 'title',
        ]);

        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $numberOfPosts = Post::where('title','=',$data['title'])->count();

        if(!$numberOfPosts){
            $post = Post::create($data);
            return new PostResource($post);
        }

        $response = [
            'message' => 'Já cadastrado!'
        ];
        return response()->json($response , 409);


        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $Post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post=Post::find($id);

        if(!is_null($post))
        {
            return new PostResource($post);
        }

        $response = [
            'message' => 'Nada encontrado!'
        ];
        return response()->json( $response, 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $Post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validator = Validator::make($data, 
        [   'title' => 'required|min:15', 
        ],[
            'required' => 'O campo :attribute é obrigatório',
            'title.min' => 'O dado passado no campo :attribute deve ser maior',
        ],[
            'title' => 'title',
        ]);

        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $post = Post::find($id);  

        if(!is_null($post))
        {
            $post->update($data);
            return (new PostResource($post))
                ->response()
                ->setStatusCode(202);
        }

        $response = [
            'message' => 'Nada encontrado!'
        ];
        return response()->json( $response, 404);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $Post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $post = Post::find($id);  
        if(!is_null($post))
        {
            $post->delete();
            return response()->json(null, 204);
        }
        $response = [
            'message' => 'Nada encontrado!'
        ];
        return response()->json( $response, 404);
    }

    public function getPostsComments($id)
    {
        $post = Post::find($id);
        if(!is_null($post))
        {
            $comments =  $post->comments;
            return CommentResource::collection($comments);
        }
        $response = [
            'message' => 'Nada encontrado!'
        ];
        return response()->json( $response, 404);
    }
}
 










