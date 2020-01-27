<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Item_requestRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\User;
use App\Models\Item_request_detail;
use Carbon\Carbon;

/**
 * Class Item_requestCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class Item_requestCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation { show as traitShow; }

    public function setup()
    {
        $this->crud->setModel('App\Models\Item_request');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/item_request');
        $this->crud->setEntityNameStrings('item_request', 'item_requests');
        $this->crud->enableExportButtons();
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        // $this->crud->setFromDb();
        // $this->crud->addColumn(['name' => 'employee', 'type' => 'text', 'label' => 'Employee']);
        $this->crud->addColumn([
           // 1-n relationship
           'label' => "Requestor", // Table column heading
           'type' => "select",
           'name' => 'requestor_id', // the column that contains the ID of that connected entity;
           'entity' => 'requestor', // the method that defines the relationship in your Model
           'attribute' => "name", // foreign key attribute that is shown to user
           'model' => "App\Models\BackpackUser", // foreign key model
        ]);
        $this->crud->addColumn(['name' => 'req_date', 'type' => 'datetime', 'label' => 'Request Date']);
        $this->crud->addColumn(['name' => 'typeofrequest', 'type' => 'text', 'label' => 'Type of Request']);
        $this->crud->addColumn(['name' => 'status', 'type' => 'text', 'label' => 'Status']);
        $this->crud->addButtonFromView('line', 'status_update', 'status_update', 'beginning');
        $this->crud->setListView('item_request.list');

    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(Item_requestRequest::class);
        // $this->crud->setCreateView('item_request.create');   
        // TODO: remove setFromDb() and manually define Fields
        // $this->crud->setFromDb();
    }

    protected function setupUpdateOperation()
    {
        // $this->setupCreateOperation();
    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);
        $this->crud->setShowContentClass('col-md-8');
        $this->crud->setShowView('item_request.show');

        // COLUMN 
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
           'label' => "Approver", // Table column heading
           'type' => "select",
           'name' => 'approver_id', // the column that contains the ID of that connected entity;
           'entity' => 'approver', // the method that defines the relationship in your Model
           'attribute' => "name", // foreign key attribute that is shown to user
           'model' => "App\Models\BackpackUser", // foreign key model
        ]);
        $this->crud->addColumn([
          'name' => 'employee',
          'type' => 'employee',
          'label' => 'Employee'
        ]);
        $this->crud->addColumn(['name' => 'req_date', 'type' => 'datetime', 'label' => 'Request Date']);
        $this->crud->addColumn(['name' => 'remark', 'type' => 'text', 'label' => 'Remark']);
        // $this->crud->addColumn(['name' => 'status', 'type' => 'text', 'label' => 'Status']);
        $this->crud->addColumn(['name' => 'id', 'type' => 'itemlist', 'label' => 'Item list']);

        // BUTTON

    }

}
