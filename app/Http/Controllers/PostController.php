<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Log;
use App\Models\Post;
use Exception;

class PostController extends Controller
{
    public function store(PostRequest $request)
    {
        try {
            $data = Post::create($request->validated());

            return response()->json([
                'status' => 'success',
                'data'   => $data,
            ], 200);
        } catch (Exception $ex) {
            Log::error($ex->getMessage());

            return response()->json([
                'status'  => 'error',
                'message' => 'The server has encountered an unexpected condition'
            ], 500);
        }
    }
}
