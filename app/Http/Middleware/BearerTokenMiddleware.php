<?php

// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Support\Facades\Auth;
// use App\Models\User;
// use Illuminate\Support\Facades\Log;

// // Debugging token dan user
// Log::info('Received Token:', ['token' => $token]);

// $user = User::where('api_token', $token)->first();
// if (!$user) {
//     Log::info('User not found for token');
//     return response()->json(['message' => 'Unauthorized'], 401);
// }

// Log::info('User authenticated:', ['user' => $user]);

// if ($user->token_expires_at && now()->greaterThan($user->token_expires_at)) {
//     Log::info('Token expired at:', ['expired_at' => $user->token_expires_at]);
//     return response()->json(['message' => 'Token expired'], 401);
// }

// Auth::login($user);
// return $next($request);


// class BearerTokenMiddleware
// {
//     public function handle($request, Closure $next)
//     {
//         $token = $request->bearerToken();

//         if (!$token) {
//             return response()->json(['message' => 'Unauthorized'], 401);
//         }

//         $user = User::where('api_token', $token)->first();

//         if (!$user) {
//             return response()->json(['message' => 'Unauthorized'], 401);
//         }

//         if ($user->token_expires_at && now()->greaterThan($user->token_expires_at)) {
//     return response()->json(['message' => 'Token expired'], 401);
// }


//         Auth::guard('api')->setUser($user);

//         return $next($request);
//     }
// }
