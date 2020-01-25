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
    protected $fillable = ['requestor_id','employee','approver_id','on_process_id','ready_id','completed_id', 'req_date','approve_date','process_date','ready_date','complete_date', 'status','typeofrequest', 'remark'];
    // protected $hidden = [];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['req_date','approve_date','process_date','ready_date','complete_date'];
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

    public function on_process(){
        return $this->hasOne('App\Models\BackpackUser', 'id', 'on_process_id');
    }

    public function ready(){
        return $this->hasOne('App\Models\BackpackUser', 'id', 'ready_id');
    }

    public function complete(){
        return $this->hasOne('App\Models\BackpackUser', 'id', 'completed_id');
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
