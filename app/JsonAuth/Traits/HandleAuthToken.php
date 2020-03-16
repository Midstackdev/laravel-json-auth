<?php

namespace App\JsonAuth\Traits;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;

trait HandleAuthToken
{
	use RespondWithToken;

	public function me()
	{
		return response()->json([
			'data' => [
                'user' => $this->guard()->user()
            ]
		]);
	}

	public function refresh()
	{
		try {
            return $this->respondWithToken($this->guard()->refresh());
        } catch (JWTException $e) {
            return response()->json([
                'data' => [
                        'error' => [
                        'token_absent' => $e->getMessage()
                    ]
                ]
            ], 401);
        }
	}

	public function loggedOut(Request $request)
	{
		if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'data' => [
                    'message' => 'Successfully logged out'
                ]
            ]);
        }

        return parent::loggedOut($request);
	}
}