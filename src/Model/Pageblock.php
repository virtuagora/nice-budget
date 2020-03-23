<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pageblock extends Model
{
    protected $table = 'page_blocks';
    protected $visible = [
        'id',  'title', 'markdown', 'path', 'picture_name', 'hidden', 'order', 'created_at', 'updated_at'
    ];
    protected $casts = [
        'hidden' => 'boolean',
        'order' => 'integer'
    ];
    
}
