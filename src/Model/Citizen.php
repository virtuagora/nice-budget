<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Citizen extends Model
{
    public $timestamps = false;
    protected $table = 'citizens';
    protected $visible = [
        'id', 'table','orden','dni', 'fullname', 'year', 'data', 'genre', 'voted','subject'
    ];
    protected $casts = [
        'data' => 'array'
    ];

    public function subject(){
        return $this->hasOne('App\Model\Subject');
    }
    

    // public function getDataAttribute($value)
    // {
    //     // return $this->castAttribute($this->type, $value);
    //     $theData = explode(',', $value);
    //     return [
    //         'name' => $theData[0],
    //         'doc_type' => $theData[1],
    //         'address' => $theData[2]
    //     ];
    // }
}
