<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectFields extends Model
{
    use SoftDeletes;

    // public $incrementing = false;
    // public $keyType = 'string';
    protected $table = 'project_fields';
    protected $visible = [
        'id',
        'chapter',
        'fields',
        'required',
        'layout',
        'private',
        'enable_budget',
        'enable_detailed_budget',
        'budget_limit',
    ];
    protected $casts = [
        'fields' => 'array',
        'required' => 'array',
        'layout' => 'array',
        'private' => 'array',
        'enable_budget' => 'boolean',
        'enable_detailed_budget' => 'boolean',
        'budget_limit' => 'integer',
    ];
}