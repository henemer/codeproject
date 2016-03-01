<?php
/**
 * Created by PhpStorm.
 * User: henemer
 * Date: 05/08/15
 * Time: 10:42
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectValidator extends LaravelValidator {
    protected $rules = [
        'name' => 'required|max:255',
        'owner_id' => 'required|integer',
        'client_id'=> 'required|integer',
        'progress' => 'required',
        'status' => 'required',
        'due_date' => 'required'

    ];


}