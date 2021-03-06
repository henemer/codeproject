<?php
/**
 * Created by PhpStorm.
 * User: henemer
 * Date: 28/07/15
 * Time: 10:58
 */

namespace CodeProject\Repositories;

use CodeProject\Entities\Client;
use Prettus\Repository\Eloquent\BaseRepository;
use CodeProject\Presenters\ClientPresenter;

class ClientRepositoryEloquent extends BaseRepository implements ClientRepository {

    protected  $fieldSearchable = [
        'name'
    ];

    public function model() {
        return Client::class;
    }

    public function presenter()
    {
        return ClientPresenter::class;
    }

    public function boot() {
        $this->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
    }

}