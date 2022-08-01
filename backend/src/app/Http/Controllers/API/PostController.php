<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $post =  Post::create([
            'title'=> $request->title,
            'detail'=> $request->detail,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return response()->json(Post::all(),200);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Int $id)
    {
        $post = Post::find($id);
        return response()->json($post, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Int $id)
    {
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->detail = $request->input('detail');
        $post->updated_at = now();
        $post->save();
        return response()->json($post, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Int $id)
    {
        Post::find($id)->delete();
        return response()->json(Post::all(), 200);
    }
}
