<?php

namespace App\JsonAuth\Traits;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

trait VerifiesEmails {
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function verify(Request $request)
    {
        $user = User::findOrFail($request->route('id'));
        // dd($user);
        if (! hash_equals((string) $request->route('id'), (string) $user->getKey())) {
            throw new AuthorizationException;
        }

        if (! hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            throw new AuthorizationException;
        }

        if ($user->hasVerifiedEmail()) {
            return $request->wantsJson()
                        ? $this->verified($request)
                        : redirect($this->redirectPath());
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        if ($response = $this->verified($request)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new Response('', 204)
                    : redirect($this->redirectPath())->with('verified', true);
    }

    /**
     * The user has been verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function verified(Request $request = null)
    {
        return response()->json([
            'data' => [
                'message' => 'Your email is verified.'
            ]
        ], 200);
    }

    /**
     * Resend the email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $request->wantsJson()
                        ? new Response('', 204)
                        : redirect($this->redirectPath());
        }

        $request->user()->sendEmailVerificationNotification();

        return $request->wantsJson()
                    ? new Response('', 202)
                    : back()->with('resent', true);
    }
}