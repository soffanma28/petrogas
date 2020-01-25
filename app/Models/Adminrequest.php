<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Adminrequest extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'adminrequests';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = ['request_id', 'adminprove_id', 'admincompleted_id', 'adminprove_date', 'admincomplete_date', 'adminstatus'];
    // protected $hidden = [];
    protected $dates = ['adminprove_date', 'admincomplete_date'];

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
    public function itemrequest(){
        return $this->hasOne('App\Models\Item_request', 'id', 'request_id');
    }

    public function approver(){
        return $this->hasOne('App\Models\BackpackUser', 'id', 'adminprove_id');
    }

    public function complete(){
        return $this->hasOne('App\Models\BackpackUser', 'id', 'admincompleted_id');
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
