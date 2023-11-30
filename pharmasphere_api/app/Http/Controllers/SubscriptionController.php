<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
    // app/Http/Controllers/SubscriptionController.php

    public function subscribe(Request $request)
    {
        $user = $request->user();
        $plan = $request->input('plan');

        // Implement logic to validate the plan, calculate expiration, etc.

        $subscription = Subscription::create([
            'user_id' => $user->id,
            'plan' => $plan,
            'expires_at' => now()->addMonths(1), // Example: subscribe for 1 month
        ]);

        return response()->json(['message' => 'Subscription successful', 'subscription' => $subscription]);
    }

    public function unsubscribe(Request $request)
    {
        $user = $request->user();

        // Implement logic to find and cancel the user's subscription

        return response()->json(['message' => 'Unsubscribed successfully']);
    }

    public function getSubscription(Request $request)
    {
        $user = $request->user();

        // Get all subscriptions from the database
        return response()->json(['subscriptions' => $user->subscriptions]);
    }

    }
