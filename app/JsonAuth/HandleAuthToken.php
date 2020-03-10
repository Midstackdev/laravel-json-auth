<?php

namespace App\JsonAuth;

use Illuminate\Http\Request;

trait HandleAuthToken
{
	use RespondWithToken;

	public function me()
	{
		return response()->json([
			'user' => $this->guard()->user()
		]);
	}

	public function loggedOut(Request $request)
	{
		if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['message' => 'Successfully logged out']);
        }

        return parent::loggedOut($request);
	}
}