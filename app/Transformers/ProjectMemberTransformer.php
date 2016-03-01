<?php
/**
 * Created by PhpStorm.
 * User: henemer
 * Date: 14/08/15
 * Time: 10:20
 */

namespace CodeProject\Transformers;

use CodeProject\Entities\User;
use League\Fractal\TransformerAbstract;

class ProjectMemberTransformer extends TransformerAbstract {
    public function transform(User $member) {
        return [
            'member_id' => $member->id,
            'name' => $member->name
        ];
    }


}