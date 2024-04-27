<?php

namespace App\Services;

use App\Contracts\SubscriptionServiceContract;
use App\Models\Subscription;
use Illuminate\Support\Facades\Validator;

class SubscriptionService implements SubscriptionServiceContract
{
    public function createSubscription(array $data)
    {
        $validator = Validator::make($data, [
            'email'   => 'required|string|email|max:255',
            'post_id' => 'required|integer|exists:posts,id',
        ]);

        if ($validator->fails()) {
            return [
                'status' => 'error',
                'data'   => $validator->errors(),
            ];
        }

        try {
            $subscription = Subscription::firstOrCreate($data);
            return [
                'status' => 'success',
                'data'   => $subscription,
            ];
        } catch (\Exception $ex) {
            \Log::error($ex->getMessage());
            return [
                'status' => 'error',
                'data'   => 'The server has encountered an unexpected condition'
            ];
        }
    }
}
