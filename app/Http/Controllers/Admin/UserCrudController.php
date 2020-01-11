<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\User');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/user');
        $this->crud->setEntityNameStrings('user', 'users');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        // $this->crud->setFromDb();
        $this->crud->addColumn([
           // 1-n relationship
           'label' => "Department", // Table column heading
           'type' => "select",
           'name' => 'department_id', // the column that contains the ID of that connected entity;
           'entity' => 'department', // the method that defines the relationship in your Model
           'attribute' => "name", // foreign key attribute that is shown to user
           'model' => "App\Models\Department", // foreign key model
        ]);
        $this->crud->addColumn(['name' => 'name', 'type' => 'text', 'label' => 'Name']);
        $this->crud->addColumn(['name' => 'username', 'type' => 'text', 'label' => 'Username']);
        $this->crud->addColumn(['name' => 'email', 'type' => 'email', 'label' => 'Email']);
        $this->crud->addColumn(['name' => 'role', 'type' => 'text', 'label' => 'Role']);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(UserRequest::class);
        $this->crud->addField([  // Select2
           'label' => "Department",
           'type' => 'select2',
           'name' => 'department_id', // the db column for the foreign key
           'entity' => 'department', // the method that defines the relationship in your Model
           'attribute' => 'name', // foreign key attribute that is shown to user
           'model' => "App\Models\Department", // foreign key model

           // optional
           // 'default' => 2, // set the default value of the select2
           // 'options'   => (function ($query) {
           //      return $query->orderBy('name', 'ASC')->where('depth', 1)->get();
           //  }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
        ]);
        $this->crud->addField(['name' => 'name', 'type' => 'text', 'label' => 'Name']);
        $this->crud->addField(['name' => 'email', 'type' => 'email', 'label' => 'Email']);
        $this->crud->addField(['name' => 'username', 'type' => 'text', 'label' => 'Username']);
        $this->crud->addField(['name' => 'password', 'type' => 'password', 'label' => 'Password']);
        $this->crud->addField([   // select2_from_array
            'name' => 'role',
            'label' => "Role",
            'type' => 'select2_from_array',
            'options' => ['Admin' => 'Admin', 'Manager' => 'Manager', 'User' => 'User'],
            'allows_null' => false,
            'default' => 'User',
            // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
        ]);
        // TODO: remove setFromDb() and manually define Fields
        // $this->crud->setFromDb();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
