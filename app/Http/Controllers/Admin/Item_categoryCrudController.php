<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Item_categoryRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class Item_categoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class Item_categoryCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Item_category');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/item_category');
        $this->crud->setEntityNameStrings('item_category', 'item_categories');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        // $this->crud->setFromDb();
        $this->crud->addColumn(['name' => 'name', 'type' => 'text', 'label' => 'Name']);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(Item_categoryRequest::class);
        $this->crud->addField(['name' => 'name', 'type' => 'text', 'label' => 'Name']);
        // TODO: remove setFromDb() and manually define Fields
        // $this->crud->setFromDb();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
