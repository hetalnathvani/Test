<?php

namespace App\Repositories\Backend\Project;

use DB;
use Carbon\Carbon;
use App\Models\Project\Project;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectRepository.
 */
class ProjectRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Project::class;

    /**
     * This method is used by Table Controller
     * For getting the table data to show in
     * the grid
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                config('module.projects.table').'.id',
                config('module.projects.table').'.project_name',
                config('module.projects.table').'.project_details',
                config('module.projects.table').'.tech_id',
                config('module.projects.table').'.file',
                config('module.projects.table').'.created_at',
                config('module.projects.table').'.updated_at',
            ]);
    }

    /**
     * For Creating the respective model in storage
     *
     * @param array $input
     * @throws GeneralException
     * @return bool
     */
    public function create(array $input)
    {
        if (Project::create($input)) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.projects.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param Project $project
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(Project $project, array $input)
    {
    	if ($project->update($input))
            return true;

        throw new GeneralException(trans('exceptions.backend.projects.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param Project $project
     * @throws GeneralException
     * @return bool
     */
    public function delete(Project $project)
    {
        if ($project->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.projects.delete_error'));
    }
}
