<?php
/**
 * Created by PhpStorm.
 * User: henemer
 * Date: 05/08/15
 * Time: 10:42
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectMemberValidator extends LaravelValidator {
    protected $rules = [
        'project_id' => 'required|integer',
        'user_id' => 'required|integer'

    ];


}