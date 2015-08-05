<?php
/**
 * Created by PhpStorm.
 * User: henemer
 * Date: 04/08/15
 * Time: 10:52
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;

class ClientValidator extends LaravelValidator {
    protected $rules = [
        'name' => 'required|max:255',
        'responsible' => 'required|max:255',
        'email'=> 'required|email',
        'phone' => 'required',
        'address' => 'required'
    ];

}