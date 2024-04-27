<?php

namespace App\Http\Controllers;

use App\Contracts\SubscriptionServiceContract;
use App\Http\Requests\SubscriptionRequest;

class SubscriptionController extends Controller
{
    protected $subscriptionService;

    public function __construct(SubscriptionServiceContract $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    public function store(SubscriptionRequest $request)
    {
        $result     = $this->subscriptionService->createSubscription($request->validated());
        $status     = $result['status'];
        $data       = $this->transformData($result['data']);
        $statusCode = $result['statusCode'];

        return $this->responseJSON($status, $data, $statusCode);
    }

    private function transformData($data)
    {
        if (!is_object($data)) {
            return $data;
        }

        return [
            'id' => $data->id,
            'email' => $data->email,
            'post_id' => $data->post_id
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
