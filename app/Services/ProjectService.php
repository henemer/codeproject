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
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;


class ProjectService {

    /**
     * @var ProjectRepository;
     */
    protected  $repository;

    /**
     * @var ProjectValidator;
     */
    private $validator;

    public function __construct(ProjectRepository $repository, ProjectValidator $validator) {
        $this->repository = $repository;
        $this->validator = $validator;
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

}