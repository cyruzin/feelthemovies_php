<?php

namespace App\Http\Controllers;

use App\User;
use ApiHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        try {
            $user = User::where('email', $request->email)->first();

            if ($user) {
                if (Hash::check($request->password, $user->password)) {
                    return response()->json([
                        'message' => 'success',
                        'api_token' => $user->api_token,
                        'id' => $user->id
                    ], 200);
                }
            }

            return response()->json(['message' => 'Authentication failed'], 401);
        } catch (\Exception $e) {
            return ApiHelper::errorHandler($e);
        }
    }


}
