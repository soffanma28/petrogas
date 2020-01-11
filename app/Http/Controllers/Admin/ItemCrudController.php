<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ItemRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ItemCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ItemCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Item');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/item');
        $this->crud->setEntityNameStrings('item', 'items');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        // $this->crud->setFromDb();
        $this->crud->addColumn([
           // 1-n relationship
           'label' => "Item Category", // Table column heading
           'type' => "select",
           'name' => 'category_id', // the column that contains the ID of that connected entity;
           'entity' => 'category', // the method that defines the relationship in your Model
           'attribute' => "name", // foreign key attribute that is shown to user
           'model' => "App\Models\Item_category", // foreign key model
        ]);
        $this->crud->addColumn(['name' => 'name', 'type' => 'text', 'label' => 'Name']);
        $this->crud->addColumn(['name' => 'qty', 'type' => 'text', 'label' => 'Quantity']);
        $this->crud->addColumn(['name' => 'price', 'type' => 'number', 'label' => 'Price']);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(ItemRequest::class);
        $this->crud->addField([  // Select2
           'label' => "Item Category",
           'type' => 'select2',
           'name' => 'category_id', // the db column for the foreign key
           'entity' => 'category', // the method that defines the relationship in your Model
           'attribute' => 'name', // foreign key attribute that is shown to user
           'model' => "App\Models\Item_category", // foreign key model

           // optional
           // 'default' => 2, // set the default value of the select2
           // 'options'   => (function ($query) {
           //      return $query->orderBy('name', 'ASC')->where('depth', 1)->get();
           //  }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
        ]);
        $this->crud->addField(['name' => 'name', 'type' => 'text', 'label' => 'Name']);
        // $this->crud->addField(['name' => 'qty', 'type' => 'hidden', 
        //     'default' => '0',
        //     'attributes' => [
        //        'hidden' => 'hidden',
        //      ], // change the HTML attributes of your input
        // ]);
        $this->crud->addField(['name' => 'qty', 'type' => 'number','default' => 0,'label' => 'Quantity']);
        $this->crud->addField(['name' => 'price', 'type' => 'number', 'label' => 'Price']);

        // TODO: remove setFromDb() and manually define Fields
        // $this->crud->setFromDb();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
