<?php
/**
 * Created by PhpStorm.
 * User: henemer
 * Date: 14/08/15
 * Time: 10:20
 */

namespace CodeProject\Transformers;

use CodeProject\Entities\Project;
use League\Fractal\TransformerAbstract;

class ProjectTransformer extends TransformerAbstract {
   protected $defaultIncludes = ['members','client'];


    public function transform(Project $project) {
        return [
            'id' => $project->id,
            'client_id' => $project->client_id,
            'owner_id' => $project->owner_id,
            'name' => $project->name,
            'description' => $project->description,
            'progress' => (int)$project->progress,
            'status' => (int)$project->status,
            'due_date' => $project->due_date
        ];
    }

    public function includeMembers(Project $project) {
        return $this->collection($project->members, new ProjectMemberTransformer());
    }

    public function includeClient(Project $project) {
        return $this->item($project->client, new ClientTransformer());
    }

}