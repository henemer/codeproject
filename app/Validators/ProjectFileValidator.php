<?php
/**
 * Created by PhpStorm.
 * User: henemer
 * Date: 04/08/15
 * Time: 10:52
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectFileValidator extends LaravelValidator {
    protected $rules = [
        'project_id' => 'required',
        'name' => 'required',
        'file'=> 'required|mimes:jpeg,jpg,png,gif,pdf,zip',
        'description' => 'required'
    ];

}