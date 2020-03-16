<?php

namespace App\JsonAuth;

use Illuminate\Support\Facades\Route;

class JsonAuth
{

	public static function routes(array $options = [])
	{
		Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {

			Route::post('login', 'LoginController@login')->name('login');
            Route::post('register', 'RegisterController@register')->name('register');

			Route::group(['middleware' => 'api'], function () {
				Route::post('refresh', 'LoginController@refresh');
				Route::get('me', 'LoginController@me');
			});

			Route::post('logout', 'LoginController@logout')->name('logout');

            // Password Reset Routes...
            if ($options['reset'] ?? true) {
                self::resetPassword();
            }

            // Email Verification Routes...
            if ($options['verify'] ?? true) {
                self::emailVerification();
            }
		});

        
	}

    /**
     * Register the typical reset password routes for an application.
     *
     * @return void
     */
    public static function resetPassword()
    {
        Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');
    }

     /**
     * Register the typical email verification routes for an application.
     *
     * @return void
     */
    public static function emailVerification()
    {
        // Route::get('email/verify', 'VerificationController@show')->name('verification.notice');
        Route::get('email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify');
        Route::get('email/resend', 'VerificationController@resend')->name('verification.resend');
    }

}