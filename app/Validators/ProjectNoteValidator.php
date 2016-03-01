<?php
/**
 * Created by PhpStorm.
 * User: henemer
 * Date: 05/08/15
 * Time: 10:42
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectNoteValidator extends LaravelValidator {
    protected $rules = [
      'project_id' => 'required|integer',
      'title'=> 'required',
      'note' => 'required'
    ];


}