<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EmployeeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class EmployeeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class EmployeeCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Employee');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/employee');
        $this->crud->setEntityNameStrings('employee', 'employees');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        // $this->crud->setFromDb();
        $this->crud->addColumn(['name' => 'employee_id', 'type' => 'text', 'label' => 'Employee Id']);
        $this->crud->addColumn(['name' => 'name', 'type' => 'text', 'label' => 'Name']);
        $this->crud->addColumn([
           // 1-n relationship
           'label' => "Requestor", // Table column heading
           'type' => "select",
           'name' => 'requestor_id', // the column that contains the ID of that connected entity;
           'entity' => 'requestor', // the method that defines the relationship in your Model
           'attribute' => "name", // foreign key attribute that is shown to user
           'model' => "App\Models\BackpackUser", // foreign key model
        ]);
        $this->crud->addColumn([
           // 1-n relationship
           'label' => "User", // Table column heading
           'type' => "select",
           'name' => 'user_id', // the column that contains the ID of that connected entity;
           'entity' => 'user', // the method that defines the relationship in your Model
           'attribute' => "name", // foreign key attribute that is shown to user
           'model' => "App\Models\BackpackUser", // foreign key model
        ]);
        $this->crud->removeButton('show');
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(EmployeeRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        // $this->crud->setFromDb();
        $this->crud->addField([
           // 1-n relationship
           'label' => "User", // Table column heading
           'type' => "select2",
           'name' => 'user_id', // the column that contains the ID of that connected entity;
           'entity' => 'user', // the method that defines the relationship in your Model
           'attribute' => "name", // foreign key attribute that is shown to user
           'model' => "App\Models\BackpackUser", // foreign key model
        ]);
        $this->crud->addField([
           // 1-n relationship
           'label' => "Requestor", // Table column heading
           'type' => "select2",
           'name' => 'requestor_id', // the column that contains the ID of that connected entity;
           'entity' => 'requestor', // the method that defines the relationship in your Model
           'attribute' => "name", // foreign key attribute that is shown to user
           'model' => "App\Models\BackpackUser", // foreign key model
        ]);
        $this->crud->addField(['name' => 'employee_id', 'type' => 'text', 'label' => 'Employee Id']);
        $this->crud->addField(['name' => 'name', 'type' => 'text', 'label' => 'Name']);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
