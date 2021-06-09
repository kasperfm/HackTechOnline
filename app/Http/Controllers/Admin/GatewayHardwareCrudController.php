<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GatewayHardwareRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class GatewayHardwareCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class GatewayHardwareCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\GatewayHardware::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/gatewayhardware');
        CRUD::setEntityNameStrings('Gateway Hardware', 'Gateway Hardware');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addFilter([
            'type' => 'simple',
            'name' => 'NET',
            'label'=> 'Network'
        ],
            false,
            function() {
                $this->crud->addClause('where', 'type', 0);
            });

        CRUD::addFilter([
            'type' => 'simple',
            'name' => 'CPU',
            'label'=> 'CPU'
        ],
            false,
            function() {
                $this->crud->addClause('where', 'type', 1);
            });

        CRUD::addFilter([
            'type' => 'simple',
            'name' => 'RAM',
            'label'=> 'RAM'
        ],
            false,
            function() {
                $this->crud->addClause('where', 'type', 2);
            });

        CRUD::addFilter([
            'type' => 'simple',
            'name' => 'HDD',
            'label'=> 'Storage'
        ],
            false,
            function() {
                $this->crud->addClause('where', 'type', 3);
            });

        CRUD::addColumn([
            'name' => 'id',
            'label' => 'ID',
            'type' => 'number'
        ]);
        CRUD::column('part_name')->type('text');
        CRUD::column('price')->type('number');
        CRUD::addColumn([
            'name'  => 'type',
            'label' => 'Type',
            'type'  => 'select_from_array',
            'options' => [0 => 'NET', 1 => 'CPU', 2 => 'RAM', 3 => 'HDD']
        ]);
        CRUD::column('value')->type('number');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(GatewayHardwareRequest::class);

        CRUD::field('part_name')->type('text');
        CRUD::field('price')->type('number');
        CRUD::addField([
            'name'  => 'type',
            'label' => 'Type',
            'type'  => 'select_from_array',
            'options' => [0 => 'NET', 1 => 'CPU', 2 => 'RAM', 3 => 'HDD']
        ]);
        CRUD::field('value')->type('number');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation()
    {
        CRUD::set('show.setFromDb', false);

        CRUD::addColumn([
            'name' => 'id',
            'label' => 'Database ID',
            'type' => 'number'
        ]);

        CRUD::column('part_name')->type('text');
        CRUD::column('price')->type('number');
        CRUD::addColumn([
            'name'  => 'type',
            'label' => 'Type',
            'type'  => 'select_from_array',
            'options' => [0 => 'NET', 1 => 'CPU', 2 => 'RAM', 3 => 'HDD']
        ]);
        CRUD::column('value')->type('number');
    }
}
