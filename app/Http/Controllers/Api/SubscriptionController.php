<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Models\Website;
use App\Models\User;
use App\Models\Subscription;

class SubscriptionController extends Controller {
    /**
     * Subscribe a user to a website.
     *
     * This method validates the request to ensure a user ID is provided, then
     * checks if the user exists. If the user is not found, a 404 response is returned.
     * If the user is already subscribed to the website, a 409 response is returned.
     * Otherwise, the user is subscribed to the website, and a 201 response is returned
     * indicating a successful subscription.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Website $website
     * @return \Illuminate\Http\JsonResponse
     */
    public function subscribe(Request $request, Website $website): JsonResponse {
        $request->validate([
            'user_id' => 'required|integer',
        ]);

        $userId = $request->input('user_id');

        $user = User::find($userId);

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        if ($website->subscribers()->where('user_id', $userId)->exists()) {
            return response()->json(['message' => 'User is already subscribed.'], 409);
        }

        $website->subscribers()->attach($userId);

        return response()->json(['message' => 'Subscription successful.'], 201);
    }
}
