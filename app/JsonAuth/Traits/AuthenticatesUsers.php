<?php

namespace App\JsonAuth\Traits;

use Illuminate\Http\Request;


trait AuthenticatesUsers
{
	use ExtendedAuthenticatesUsers;

	public function login(Request $request)
	{
		return $this->parentLogin($request);
	}

	public function authenticated(Request $request, $user)
	{
		if (!$user->hasVerifiedEmail()) {
			return response()->json([
	            'data' => [
	                'message' => 'Verify your email to actiavte your account.'
	            ]
	        ], 401);
		}

		if (request()->ajax() || request()->wantsJson()) {

            return $this->respondWithToken($this->guard()->tokenById($user->id));
        }

        return $this->parentAuthenticated($request, $user);
	}

	public function attemptLogin(Request $request)
	{
		return $this->guard()->attempt($this->credentials($request));
	}

}