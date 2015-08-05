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

class ClientRepositoryEloquent extends BaseRepository implements ClientRepository {

    public function model() {
        return Client::class;
    }
}