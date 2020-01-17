<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Item_requestRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\User;
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
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Item_request');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/item_request');
        $this->crud->setEntityNameStrings('item_request', 'item_requests');
        $this->crud->with('user');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(Item_requestRequest::class);
        $this->crud->addField([   // date_picker
           'name' => 'req_date',
           'type' => 'date_picker',
           'label' => 'Request Date',
           'default' => Carbon::now()->toDateString(),
           // optional:
           'date_picker_options' => [
              'todayBtn' => 'linked',
              'format' => 'dd-mm-yyyy',
              'language' => 'en',
           ],
        ]);
        $this->crud->addField([  // Select2
           'label' => "Requestor",
           'type' => 'select2',
           'name' => 'user_id', // the db column for the foreign key
           'entity' => 'user', // the method that defines the relationship in your Model
           'attribute' => 'name', // foreign key attribute that is shown to user
           'model' => "App\Models\User", // foreign key model

           // optional
           // 'default' => 2, // set the default value of the select2
           // 'options'   => (function ($query) {
           //      return $query->orderBy('name', 'ASC')->where('depth', 1)->get();
           //  }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
        ]);
        $this->crud->addField([  // Select2
           'label' => "Requestor",
           'type' => 'select2',
           'name' => 'user_id', // the db column for the foreign key
           'entity' => 'user', // the method that defines the relationship in your Model
           'attribute' => 'email', // foreign key attribute that is shown to user
           'model' => "App\Models\User", // foreign key model

           // optional
           // 'default' => 2, // set the default value of the select2
           // 'options'   => (function ($query) {
           //      return $query->orderBy('name', 'ASC')->where('depth', 1)->get();
           //  }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
        ]);
        $this->crud->addField(['name' => 'status', 'type' => 'text', 'label' => 'Status', 'default' => 'Ready']);
        $this->crud->addField([   // Textarea
            'name' => 'remark',
            'label' => 'Remark',
            'type' => 'textarea'
        ]);
        $this->crud->addField([   // Table
            'name' => 'items',
            'label' => 'Item',
            'type' => 'table',
            'entity_singular' => 'item', // used on the "Add X" button
            'columns' => [
                'item_name' => 'Item name',
                'qty' => 'Quantity'
            ],
            'max' => 10, // maximum rows allowed in the table
            'min' => 0, // minimum rows allowed in the table
        ]);
        // $this->crud->setCreateView('item_request.create');   
        // TODO: remove setFromDb() and manually define Fields
        // $this->crud->setFromDb();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
