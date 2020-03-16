<?php

namespace App\JsonAuth\Traits;

trait RespondWithToken
{
	protected function respondWithToken($token)
	{
		return response()->json([
			'data' => [
                'user' => $this->guard()->user(),
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => $this->guard()->factory()->getTTL() * 60
            ]
		]);
	}
}