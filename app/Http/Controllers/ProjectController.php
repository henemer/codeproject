<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectService;
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ProjectController extends Controller
{
    /**
     * @var ProjectService
     */
    private $service;

    /**
     * @var ProjectRepository
     */
    private $repository;
<<<<<<< HEAD

=======
>>>>>>> 7425b587e2d0f95a41ada881039c80a47bcec263
    /**
     * @param ProjectRepository $repository
     * @param ProjectService $service
     */
<<<<<<< HEAD
    public function __construct(ProjectRepository $repository, ProjectService $service) {
=======
    public function __construct(ProjectService $service, ProjectRepository $repository) {
>>>>>>> 7425b587e2d0f95a41ada881039c80a47bcec263
        $this->service = $service;
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->repository->with(['owner','client'])->findWhere(['owner_id'=>Authorizer::getResourceOwnerId()]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {

        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
           if($this->checkProjectPermissions($id) == false)  {
            return['error'=>'Access forbidden'];
        }
        return $this->service->show($id);


    }


    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        if($this->checkProjectPermissions($id) == false)  {
            return['error'=>'Access forbidden'];
        }

        return $this->service->update($request->all(), $id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if($this->checkProjectOwner($id) == false)  {
            return['error'=>'Access forbidden'];
        }

        $this->service->delete($id);
    }

    public function addMember(Request $request)
    {

        return $this->service->addMember($request->all());
    }

    public function showMembers($idProject)
    {

        return $this->service->showMembers($idProject);
    }

    public function removeMember($id, $UserId)
    {

        return $this->service->removeMember($id, $UserId);
    }

    private function checkProjectOwner($projectId) {
        return $this->repository->isOwner($projectId, Authorizer::getResourceOwnerId());

    }

    private function checkProjectMember($projectId) {
        return $this->repository->isMember($projectId, Authorizer::getResourceOwnerId());

    }

    private function checkProjectPermissions($projectId) {
        if($this->checkProjectOwner($projectId) or
           $this->checkProjectMember($projectId)) {
               return true;
        }

        return false;

    }

}
