<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;
use Illuminate\Support\Facades\Validator;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginate = $request->per_page;
        return CommentResource::collection(Comment::paginate($paginate));
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
        [   'comment' => 'required|min:10', 
            'post_id' => 'required',
            'user_id' => 'required'
        ],[
            'required' => 'O campo :attribute é obrigatório',
            'comment.min' => 'O dado passado no campo :attribute deve ser maior',
        ],[
            'comment' => 'comment',
        ]);

        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        

        $comment = Comment::create($data);
        return new CommentResource($comment);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $Comment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment=Comment::find($id);

        if(!is_null($comment))
        {
            return new CommentResource($comment);
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
     * @param  \App\Comment  $Comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        
        $data = $request->all();

        $validator = Validator::make($data, 
        [   'comment' => 'required|min:10', 
        ],[
            'required' => 'O campo :attribute é obrigatório',
            'comment.min' => 'O dado passado no campo :attribute deve ser maior',
        ],[
            'comment' => 'comment',
        ]);

        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $comment = Comment::find($id);  

        if(!is_null($comment))
        {
            $comment->update($data);
            return (new CommentResource($comment))
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
     * @param  \App\Comment  $Comment
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $comment = Comment::find($id);  
        if(!is_null($comment))
        {
            $comment->delete();
            return response()->json(null, 204);
        }
        $response = [
            'message' => 'Nada encontrado!'
        ];
        return response()->json( $response, 404); 
    }
}
