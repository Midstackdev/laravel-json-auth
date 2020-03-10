<?php

namespace App\JsonAuth;

use Illuminate\Support\Facades\Route;

class JsonAuth
{

	public static function routes(array $options = [])
	{
		Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {

			Route::post('login', 'LoginController@login')->name('login');
			
			Route::post('logout', 'LoginController@logout')->name('logout');
		});
	}

}