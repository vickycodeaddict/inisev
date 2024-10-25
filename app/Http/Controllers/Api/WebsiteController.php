<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Models\Website;
use App\Models\Post;

class WebsiteController extends Controller {
    /**
     * Store a newly created post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Website  $website
     * @return \Illuminate\Http\JsonResponse
     */
    public function createPost(Request $request, Website $website): JsonResponse {
        $request->validate([
            'title' => 'required|string|max:254',
            'description' => 'required|string',
        ]);

        $post = $website->posts()->create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return response()->json([
            'message' => 'Post created successfully.',
            'post' => $post,
        ], 201);
    }
}
