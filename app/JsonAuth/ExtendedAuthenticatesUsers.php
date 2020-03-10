<?php

namespace App\JsonAuth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

trait ExtendedAuthenticatesUsers 
{
	use AuthenticatesUsers {
		AuthenticatesUsers::login as parentLogin;
		AuthenticatesUsers::logout as parentLogout;
		AuthenticatesUsers::showLoginForm as parentShowLoginForm;
		AuthenticatesUsers::attemptLogin as parentAttemptLogin;
		AuthenticatesUsers::authenticated as parentAuthenticated;
	}

	use HandleAuthToken {
		HandleAuthToken::loggedOut insteadof AuthenticatesUsers;
	}
}