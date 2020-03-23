<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $incrementing = false;
    protected $table = 'roles';
    protected $visible = [
        'id', 'name'
    ];
}
