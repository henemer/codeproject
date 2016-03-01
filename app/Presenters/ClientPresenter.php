<?php
/**
 * Created by PhpStorm.
 * User: henemer
 * Date: 14/08/15
 * Time: 10:36
 */

namespace CodeProject\Presenters;

use CodeProject\Transformers\ClientTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class ClientPresenter extends FractalPresenter {

    public function getTransformer()
    {
        return new ClientTransformer();
    }




}