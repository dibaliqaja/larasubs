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
            $data = Post::firstOrCreate($request->validated());
            $data = $this->transformData($data);

            return $this->responseJSON('success', $data, 200);
        } catch (Exception $ex) {
            Log::error($ex->getMessage());

            return $this->responseJSON('error', 'The server has encountered an unexpected condition', 500);
        }
    }

    private function transformData($data)
    {
        if (!is_object($data)) {
            return $data;
        }

        return [
            'id' => $data->id,
            'title' => $data->title,
            'content' => $data->content,
            'website_id' => $data->website_id
        ];
    }

    private function responseJSON($status, $data, $statusCode)
    {
        return response()->json([
            'status' => $status,
            'data'   => $data,
        ], $statusCode);
    }
}
