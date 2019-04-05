<?php

namespace App\Http\Controllers\Backend\Project;

use App\Models\Project\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\Project\CreateResponse;
use App\Http\Responses\Backend\Project\EditResponse;
use App\Repositories\Backend\Project\ProjectRepository;
use App\Repositories\Backend\Technology\TechnologyRepository;
use App\Models\Technology\Technology;
use App\Http\Requests\Backend\Project\ManageProjectRequest;
use App\Http\Requests\Backend\Project\CreateProjectRequest;
use App\Http\Requests\Backend\Project\StoreProjectRequest;
use App\Http\Requests\Backend\Project\EditProjectRequest;
use App\Http\Requests\Backend\Project\UpdateProjectRequest;
use App\Http\Requests\Backend\Project\DeleteProjectRequest;
use Illuminate\Support\Facades\Auth;
use DB;
/**
 * ProjectsController
 */
class ProjectsController extends Controller
{
    /**
     * variable to store the repository object
     * @var ProjectRepository
     */
    protected $repository;
    protected $technology;


    /**
     * contructor to initialize repository object
     * @param ProjectRepository $repository;
     */
    public function __construct(ProjectRepository $repository)
    {
        $this->repository = $repository;
        $this->technology = new TechnologyRepository;

    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\Project\ManageProjectRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageProjectRequest $request)
    {
        return new ViewResponse('backend.projects.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateProjectRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Project\CreateResponse
     */
    public function create(CreateProjectRequest $request)
    {
    //    $technology['technology']=DB::table('technologies')->get();
    $technology['technology']=Technology::getSelectData('technology_name');
        return view('backend.projects.create',$technology);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreProjectRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreProjectRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        
        //$input['']
        $this->repository->create($input);
        //return with successfull message

        if($request->hasfile('file'))
        {
            foreach($request->file('file') as $files)
            {
                $name = $files->getClientOriginalName();
                $files = move(public_path().'/app/public/',$name);
                $data[] = $name;
            }
        }

        $form = new Project();
            $form->file=json_encode($data);
            $form->save(); 
        return new RedirectResponse(route('admin.projects.index'), ['flash_success' => trans('alerts.backend.projects.created')]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Project\Project  $project
     * @param  EditProjectRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Project\EditResponse
     */
    public function edit(Project $project, EditProjectRequest $request)
    {
        
    $technology['technology']=Technology::getSelectData('technology_name');
        //$technology = $this->technology->getAll();
       // dd($technology);
        return new EditResponse($project,$technology);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateProjectRequestNamespace  $request
     * @param  App\Models\Project\Project  $project
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $project, $input );
        //return with successfull message
        return new RedirectResponse(route('admin.projects.index'), ['flash_success' => trans('alerts.backend.projects.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteProjectRequestNamespace  $request
     * @param  App\Models\Project\Project  $project
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Project $project, DeleteProjectRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($project);
        //returning with successfull message
        return new RedirectResponse(route('admin.projects.index'), ['flash_success' => trans('alerts.backend.projects.deleted')]);
    }    
}
