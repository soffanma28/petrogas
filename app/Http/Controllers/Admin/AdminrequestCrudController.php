<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminrequestRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class AdminrequestCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AdminrequestCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Adminrequest');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/adminrequest');
        $this->crud->setEntityNameStrings('adminrequest', 'adminrequests');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->addColumn([
            'label' => 'Requestor',
            'name' => 'request_id',
            'key' => 'request_name',
            'type' => 'reqname',
        ]);
        $this->crud->addColumn([
            'label' => 'Request Date',
            'name' => 'request_id',
            'key' => 'request_date',
            'type' => 'reqdate',
        ]);
        $this->crud->addColumn([
            'label' => 'Status',
            'name' => 'adminstatus',
            'type' => 'text',
        ]);
        // $this->crud->addColumn([
        //    // 1-n relationship
        //    'label' => "Status", // Table column heading
        //    'type' => "select",
        //    'name' => 'request_id', // the column that contains the ID of that connected entity;
        //    'entity' => 'itemrequest', // the method that defines the relationship in your Model
        //    'attribute' => "status", // foreign key attribute that is shown to user
        //    'model' => "App\Models\Item_request", // foreign key model
        // ]);
        $this->crud->setListView('adminrequest.list');
        $this->crud->removeButton('create');
        $this->crud->addButtonFromView('line', 'statusadmin_update', 'statusadmin_update', 'beginning');
        $this->crud->enableExportButtons();
        // $this->crud->setFromDb();
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(AdminrequestRequest::class);

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
        $this->crud->setShowView('adminrequest.show');

        // COLUMN 
        $this->crud->addColumn([
            'label' => 'Requestor',
            'name' => 'request_id',
            'key' => 'request_name',
            'type' => 'reqname',
        ]);
        $this->crud->addColumn([
           // 1-n relationship
           'label' => "Approver", // Table column heading
           'type' => "select",
           'name' => 'adminprove_id', // the column that contains the ID of that connected entity;
           'entity' => 'approver', // the method that defines the relationship in your Model
           'attribute' => "name", // foreign key attribute that is shown to user
           'model' => "App\Models\BackpackUser", // foreign key model
        ]);
        $this->crud->addColumn([
           // 1-n relationship
           'label' => "Complete by", // Table column heading
           'type' => "select",
           'name' => 'admincompleted_id', // the column that contains the ID of that connected entity;
           'entity' => 'complete', // the method that defines the relationship in your Model
           'attribute' => "name", // foreign key attribute that is shown to user
           'model' => "App\Models\BackpackUser", // foreign key model
        ]);
        $this->crud->addColumn([
            'label' => 'Request Date',
            'name' => 'request_id',
            'key' => 'request_date',
            'type' => 'reqdate',
        ]);
        $this->crud->addColumn([
            'name' => 'request_id', 
            'key' => 'request_item_list', 
            'type' => 'itemlistadmin', 
            'label' => 'Item list'
        ]);
        

    }

}
