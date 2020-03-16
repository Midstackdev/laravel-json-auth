<?php

namespace App\JsonAuth\Traits;

use Illuminate\Http\Request;

trait RegistersUsers
{
    use ExtendedRegistersUsers;  
    use RespondWithToken;

    public function register(Request $request)
    {
        return $this->parentRegister($request);
    } 

    public function registered(Request $request, $user)
    {
        if (request()->ajax() || request()->wantsJson()) {

            // return $this->respondWithToken($this->guard()->tokenById($user->id));
            return response()->json([
                'data'=> [
                    'message' => 'Please check your email to activate your account.',
                ]
            ],200);
        }

        return $this->parentRegistered();
    }
}