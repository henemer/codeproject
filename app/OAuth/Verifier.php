<?php
/**
 * Created by PhpStorm.
 * User: henemer
 * Date: 12/08/15
 * Time: 10:54
 */

namespace CodeProject\OAuth;

use Auth;

class Verifier {
    public function verify($username, $password)
    {
        $credentials = [
            'email'    => $username,
            'password' => $password,
        ];

        if (Auth::once($credentials)) {
            return Auth::user()->id;
        }

        return false;
    }

}