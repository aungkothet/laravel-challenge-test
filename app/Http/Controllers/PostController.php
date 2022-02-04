<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function list()
    {
        // $posts = Post::get();

        // $data = collect();
        // foreach ($posts as $post) {
        //     $data->add([
        //         'id'          => $post->id,
        //         'title'       => $post->title,
        //         'description' => $post->description,
        //         'tags'        => $post->tags,
        //         'like_counts' => $post->likes->count(),
        //         'created_at'  => $post->created_at,
        //     ]);
        // }
        // return response()->json([
        //     'data' => $data,
        // ]);

        $posts = Post::with('tags')->get(['id', 'title', 'description', 'created_at']);
        return response()->json([
            'data' => $posts,
        ]);
    }

    public function toggleReaction(PostRequest $request)
    {
        $post = Post::find($request->post_id);  
        if ($post->author_id == auth()->id()) {
            return response()->json([
                'status' => 500,
                'message' => 'You cannot like your post'
            ]);
        }
        $isLiked = $post->likes->firstWhere('user_id', auth()->id());
        if($request->like && $isLiked){
            return response()->json([
                'status' => 500,
                'message' => 'You already liked this post'
            ]);
        }elseif( $request->like && !$isLiked){
            $post->likes()->save(new Like(['user_id' =>auth()->id() ]));
                return response()->json([
                    'status' => 200,
                    'message' => 'You like this post successfully'
                ]);
        }else{
            $isLiked->delete();
               return response()->json([
                'status' => 200,
                'message' => 'You unlike this post successfully'
            ]);
        }

    }
}
