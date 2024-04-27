<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Post;
use Exception;

class PostController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title'      => 'required|string|max:255',
                'content'    => 'required|string',
                'website_id' => 'required|integer|exists:websites,id',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'data'   => $validator->errors(),
                ], 400);
            }

            $data = Post::create($validator->validated());

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
