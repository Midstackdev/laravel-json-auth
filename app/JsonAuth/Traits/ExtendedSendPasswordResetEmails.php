<?php

namespace App\JsonAuth\Traits;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;


trait ExtendedSendPasswordResetEmails
{
    use SendsPasswordResetEmails {
        SendsPasswordResetEmails::showLinkRequestForm as parentShowLinkRequestForm;
        SendsPasswordResetEmails::sendResetLinkEmail as parentSendResetLinkEmail;
        SendsPasswordResetEmails::sendResetLinkResponse as parentSendResetLinkResponse;
        SendsPasswordResetEmails::sendResetLinkFailedResponse as parentSendResetLinkFailedResponse;
    }
}