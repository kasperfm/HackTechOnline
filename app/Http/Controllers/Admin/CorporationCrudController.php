<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CorporationRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\CorporationRequest as StoreRequest;
use App\Http\Requests\CorporationRequest as UpdateRequest;

/**
 * Class CorporationCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class CorporationCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Corporation');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/corporation');
        $this->crud->setEntityNameStrings('corporation', 'corporations');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
       // $this->crud->setFromDb();

        // add asterisk for fields that are required in CorporationRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name'  => 'id',
            'label' => 'ID',
            'type'  => 'number'
        ]);

        $this->crud->addColumn([
            'name'  => 'name',
            'label' => 'Name',
            'type'  => 'text'
        ]);

        $this->crud->addColumn([
            'name'  => 'status',
            'label' => 'Player corp',
            'type'  => 'boolean',
            'options' => [1 => 'No', 2 => 'Yes']
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        $this->crud->setValidation(CorporationRequest::class);

        $this->crud->addField([
            'name' => 'name',
            'label' => 'Name',
            'type' => 'text'
        ]);

        $this->crud->addField([
            'name' => 'description',
            'label' => 'Description',
            'type' => 'text'
        ]);

        $this->crud->addField([  // Select
            'label' => 'Owner',
            'type' => 'select',
            'name' => 'owner_user_id', // the db column for the foreign key
            'entity' => 'owner', // the method that defines the relationship in your Model
            'attribute' => 'username', // foreign key attribute that is shown to user// force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
        ]);

        $this->crud->addField([
            'name' => 'status',
            'label' => 'Player corp',
            'type' => 'select_from_array',
            'options' => ['1' => 'No', '2' => 'Yes'],
            'allows_null' => false,
            'default' => '1'
        ]);
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
        $this->crud->set('show.setFromDb', false);

        $this->crud->addColumn([
            'name'  => 'id',
            'label' => 'ID',
            'type'  => 'number'
        ]);

        $this->crud->addColumn([
            'name'  => 'name',
            'label' => 'Name',
            'type'  => 'text'
        ]);

        $this->crud->addColumn([
            'name'  => 'description',
            'label' => 'Description',
            'type'  => 'text'
        ]);

        $this->crud->addColumn([
            'name'  => 'status',
            'label' => 'Player corp',
            'type'  => 'boolean',
            'options' => [1 => 'No', 2 => 'Yes']
        ]);

        $this->crud->addColumn([  // Select
            'label' => 'Owner',
            'type' => 'select',
            'name' => 'owner_user_id', // the db column for the foreign key
            'entity' => 'owner', // the method that defines the relationship in your Model
            'attribute' => 'username', // foreign key attribute that is shown to user// force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
        ]);
    }
}
