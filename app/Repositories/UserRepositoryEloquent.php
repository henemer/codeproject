<?php
/**
 * Created by PhpStorm.
 * User: henemer
 * Date: 28/07/15
 * Time: 10:58
 */

namespace CodeProject\Repositories;

use CodeProject\Entities\User;
use Prettus\Repository\Eloquent\BaseRepository;

class UserRepositoryEloquent extends BaseRepository implements UserRepository {

    public function model() {
        return User::class;
    }


}