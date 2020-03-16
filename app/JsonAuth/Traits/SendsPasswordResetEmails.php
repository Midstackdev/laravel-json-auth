<?php

namespace App\JsonAuth\Traits;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

trait SendsPasswordResetEmails
{
    use ExtendedSendPasswordResetEmails;

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        if(request()->ajax() || request()->wantsJson()) {
            return [];
        }
        return $this->parentShowLinkRequestForm();
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        return $this->parentSendResetLinkEmail($request);
    }

    /**
     * Get the response for a successful password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkResponse(Request $request, $response)
    {
        if(request()->ajax() || request()->wantsJson()) {
            return response()->json([
            'data' => [
                    'message' => trans($response)
                ]
            ], 200);
        }
        return $this->parentSendResetLinkResponse($request, $response);
    }

    /**
     * Get the response for a failed password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        if ($request->wantsJson() || $request->ajax()) {
            throw ValidationException::withMessages([
                'email' => [trans($response)],
            ]);
        }

        return $this->parentSendResetLinkFailedResponse($request, $response);
    }
}