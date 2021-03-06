<?php
/**
 * Created by PhpStorm.
 * User: henemer
 * Date: 05/08/15
 * Time: 10:48
 */

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectTaskRepository;
use CodeProject\Validators\ProjectTaskValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;


class ProjectTaskService {

    /**
     * @var ProjectTaskRepository;
     */
    protected  $repository;

    /**
     * @var ProjectTaskValidator;
     */
    private $validator;

    public function __construct(ProjectTaskRepository $repository, ProjectTaskValidator $validator) {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function show($id, $taskId)
    {
        try {
            return $this->repository->findWhere(['project_id' => $id, 'id' => $taskId]);
        } catch(ModelNotFoundException $e) {
            return
                [
                    'error' => true,
                    'message' => 'Project task not found'
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
                    'message' => 'Project task not found'
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
                    'message' => 'Project task not found'
                ];
        }
        catch(QueryException $e) {
            return
                [
                    'error' => true,
                    'message' => 'Project note can not be deleted'
                ];
        }

    }

}