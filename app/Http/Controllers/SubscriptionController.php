<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\SubscriptionServiceContract;

class SubscriptionController extends Controller
{

    protected $subscriptionService;

    public function __construct(SubscriptionServiceContract $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    public function store(Request $request)
    {
        $result = $this->subscriptionService->createSubscription($request->all());

        if ($result['status'] === 'error') {
            return response()->json([
                'status' => 'error',
                'data'   => $result['data'],
            ], 400);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $result['data'],
        ], 200);
    }
}
