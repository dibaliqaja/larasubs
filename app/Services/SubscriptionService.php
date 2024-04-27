<?php

namespace App\Services;

use App\Contracts\SubscriptionServiceContract;
use App\Models\Subscription;
use Illuminate\Support\Facades\Validator;

class SubscriptionService implements SubscriptionServiceContract
{
    public function createSubscription(array $data)
    {
        try {
            $subscription = Subscription::firstOrCreate($data);

            return [
                'status' => 'success',
                'data'   => $subscription,
                'statusCode' => 200,
            ];
        } catch (\Exception $ex) {
            \Log::error($ex->getMessage());

            return [
                'status' => 'error',
                'data'   => 'The server has encountered an unexpected condition',
                'statusCode' => 500,
            ];
        }
    }
}
