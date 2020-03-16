<?php

namespace App\JsonAuth\Traits;

use Illuminate\Foundation\Auth\ResetsPasswords;

trait ExtendedResetsPasswords
{
    use ResetsPasswords{
        ResetsPasswords::showResetForm as parentShowResetForm;
        ResetsPasswords::reset as parentReset;
        ResetsPasswords::sendResetResponse as parentSendResetResponse;
        ResetsPasswords::sendResetFailedResponse as parentSendResetFailedResponse;
    }   
}