<?php
/**
 * Created by PhpStorm.
 * User: henemer
 * Date: 05/08/15
 * Time: 10:48
 */

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectValidator;
use CodeProject\Validators\ProjectMemberValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\Factory as Storage;


class ProjectService {

    /**
     * @var ProjectRepository;
     */
    protected  $repository;

    /**
     * @var ProjectValidator;
     */
    private $validator;

    /**
     * @var ProjectMemberValidator;
     */
    private $projectMemberValidator;

    /**
     * @var filesystem;
     */
    private $filesystem;
    /**
     * @var Storage
     */
    private $storage;

    public function __construct(ProjectRepository $repository, ProjectValidator $validator,
                ProjectMemberValidator $projectMemberValidator, Filesystem $filesystem,
                Storage $storage) {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->projectMemberValidator = $projectMemberValidator;
        $this->filesystem = $filesystem;
        $this->storage = $storage;
    }

    public function show($id)
    {
        try {
            return $this->repository->find($id);
        } catch(ModelNotFoundException $e) {
            return
                [
                    'error' => true,
                    'message' => 'Project not found'
                ];
        }
    }

    public function create(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
        } catch(ValidatorException $e) {
            return
                [
                    'error' => true,
                    'message' => $e->getMessageBag()
                ];

        }
    }

    public function update(array $data, $id) {
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $id);
        }
        catch(ValidatorException $e) {
            return  [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
        catch(ModelNotFoundException $e) {
            return
                [
                    'error' => true,
                    'message' => 'Project not found'
                ];
        }


    }

    public function delete($id) {
        try {
            $this->repository->delete($id);
        }
        catch(ModelNotFoundException $e) {
            return
                [
                    'error' => true,
                    'message' => 'Project not found'
                ];
        }
        catch(QueryException $e) {
            return
                [
                    'error' => true,
                    'message' => 'Project can not be deleted'
                ];
        }

    }

    public function addMember(array $data)
    {
        try {
            $this->projectMemberValidator->with($data)->passesOrFail();
            return $this->repository->addMember($data['project_id'], $data['user_id']);
        } catch(ValidatorException $e) {
            return
                [
                    'error' => true,
                    'message' => $e->getMessageBag()
                ];

        }
        catch(ModelNotFoundException $e) {
            return
                [
                    'error' => true,
                    'message' => 'Project or User not found'
                ];
        }

    }

    public function removeMember($projectId, $userId)
    {
        try {
            return $this->repository->removeMember($projectId, $userId);
        } catch(ModelNotFoundException $e) {
            return
                [
                    'error' => true,
                    'message' => 'Project or User not found'
                ];
        }

    }


    public function showMembers($idProject) {
        try {
            return $this->repository->find($idProject)->members;
        } catch(ModelNotFoundException $e) {
                return
                    [
                        'error' => true,
                        'message' => 'Project not found'
                    ];
        }

    }

    public function isMember($projectId, $userId)
    {

         if($this->repository->find($projectId)->members->find($userId))
         {
             return true;
         }
        return false;

    }

    public function createFile(array $data) {

        $project = $this->repository->skipPresenter()->find($data['project_id']);
        $projectFile = $project->files()->create($data);

        $this->storage->put($projectFile->id.".".$data['extension'], $this->filesystem->get($data['file']));


    }

}