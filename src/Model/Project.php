<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    // public $incrementing = false;
    // public $keyType = 'string';
    protected $table = 'projects';
    protected $visible = [
        'id',
        'chapter',
        'code',
        'title',
        'category_id',
        'category',
        'district_id',
        'district',
        'author_names',
        'author_surnames',
        'organization_name',
        'organization_address',
        'objective',
        'budget_total',
        'picture_name',
        'youtube_id',
        'feasible',
        'state_id',
        'state',
        'feasible',
        'feasibility',
        'selected',
        'final_votes',
        'hidden',
    ];
    protected $fillable = [
        'chapter',
        'code',
        'title',
        'category_id',
        'district_id',
        'author_names',
        'author_surnames',
        'author_dni',
        'author_email',
        'author_phone',
        'organization_name',
        'organization_address',
        'objective',
        'field_values',
        'budget',
        'budget_total',
    ];
    protected $with = [];
    protected $casts = [
        'deleted_at' => 'datetime',
        'budget' => 'array',
        'field_values' => 'array',
        'journal' => 'array',
        'feasible' => 'boolean',
        'selected' => 'boolean',
        'budget_total' => 'integer',
        'hidden' => 'boolean',
        'final_votes' => 'integer',
    ];

    public function author()
    {
        return $this->belongsTo('App\Model\User', 'author_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Model\Category');
    }

    public function district()
    {
        return $this->belongsTo('App\Model\District');
    }

    public function documents()
    {
        return $this->hasMany('App\Model\Document');
    }
    
    public function state()
    {
        return $this->belongsTo('App\Model\ProjectStates');
    }

    public function getRelationsWith($subject)
    {
        $relations = [];
        $user = $this->author;
        if (isset($user) && $user->subject_id == $subject->getId()) {
            $relations[] = 'author';
        }
        return $relations;
    }
}
