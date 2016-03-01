<?php
/**
 * Created by PhpStorm.
 * User: henemer
 * Date: 14/08/15
 * Time: 10:36
 */

namespace CodeProject\Presenters;

use CodeProject\Transformers\ProjectTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class ProjectPresenter extends FractalPresenter {

    public function getTransformer()
    {
        return new ProjectTransformer();
    }




}