<?php

namespace App\JsonAuth\Traits;

use Illuminate\Foundation\Auth\RegistersUsers;


trait ExtendedRegistersUsers
{
    use RegistersUsers {
        RegistersUsers::register as parentRegister;
        RegistersUsers::showRegistrationForm as parentShowRegistrationForm;
        RegistersUsers::registered as parentRegistered;

    }

}