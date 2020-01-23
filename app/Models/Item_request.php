<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Item_request extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'item_requests';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = ['requestor_id','employee','approver_id', 'req_date', 'status','typeofrequest', 'remark'];
    // protected $hidden = [];
    // protected $dates = [];
    protected $casts = [
        'items' => 'array',
        'employee' => 'array',
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function requestor(){
        return $this->hasOne('App\Models\BackpackUser', 'id', 'requestor_id');
    }

    public function approver(){
        return $this->hasOne('App\Models\BackpackUser', 'id', 'approver_id');
    }

    public function employee(){
        return $this->hasMany('App\Models\Employee', 'id', 'employee');
    }

    public function details(){
        return $this->hasMany('App\Models\Item_request_detail', 'id', 'req_id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    
}
