<?php
/**
 * Created by PhpStorm.
 * User: henemer
 * Date: 05/08/15
 * Time: 10:36
 */

namespace CodeProject\Repositories;

use CodeProject\Entities\Project;
use Prettus\Repository\Eloquent\BaseRepository;
use CodeProject\Presenters\ProjectPresenter;

class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository {
    public function model() {
        return Project::class;
    }

    public function addMember($projectId, $userId) {
        $this->find($projectId)->members()->attach($userId);
    }

    public function removeMember($projectId, $userId) {
        $this->find($projectId)->members()->detach($userId);
    }

    public function isOwner($projectId, $userId) {
        if(count($this->skipPresenter()->findWhere(['id' =>$projectId, 'owner_id' => $userId])) > 0) {
            return true;
        }

        return false;
    }
    public function isMember($projectId, $userId) {

        $project = $this->skipPresenter()->find($projectId);

        foreach($project->members as $member) {
            if($member->id == $userId) {
                return true;
            }
        }

        return false;
    }


    public function presenter()
    {
        return ProjectPresenter::class;
    }
}