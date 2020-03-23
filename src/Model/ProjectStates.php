<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectStates extends Model
{
    // use SoftDeletes;

    // public $incrementing = false;
    // public $keyType = 'string';
    protected $table = 'project_states';
    protected $visible = [
        'id',
        'chapter',
        'name',
        'description',
    ];
    protected $casts = [
        // 'fields' => 'array',
        // 'required' => 'array',
        // 'layout' => 'array',
        // 'private' => 'array',
        // 'enable_budget' => 'boolean',
        // 'enable_detailed_budget' => 'boolean',
        // 'budget_limit' => 'integer',
    ];
}