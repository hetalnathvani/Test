<?php

namespace App\Models\Technology;

use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\Technology\Traits\TechnologyAttribute;
use App\Models\Technology\Traits\TechnologyRelationship;

class Technology extends Model
{
    use ModelTrait,
        TechnologyAttribute,
    	TechnologyRelationship {
            // TechnologyAttribute::getEditButtonAttribute insteadof ModelTrait;
        }

    /**
     * NOTE : If you want to implement Soft Deletes in this model,
     * then follow the steps here : https://laravel.com/docs/5.4/eloquent#soft-deleting
     */

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'technology';

    /**
     * Mass Assignable fields of model
     * @var array
     */
    protected $fillable = [
       // 'tech_id'
        'tech_name',
        'created_by',
        'updated_by',
    ];

    /**
     * Default values for model fields
     * @var array
     */
    protected $attributes = [

    ];

    /**
     * Dates
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Guarded fields of model
     * @var array
     */
   protected $guarded = [
    'tech_id'     
    ];

    /**
     * Constructor of Model
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
