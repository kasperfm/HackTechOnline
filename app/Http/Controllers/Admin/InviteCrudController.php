<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Http\Requests\InviteRequest;
use App\Http\Requests\InviteRequest as StoreRequest;
use App\Http\Requests\InviteRequest as UpdateRequest;

class InviteCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Invite');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/invite');
        $this->crud->setEntityNameStrings('invite', 'invites');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        //$this->crud->setFromDb();

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'used',
            'label'=> 'Used'
        ],
            false,
            function() {
                $this->crud->addClause('where', 'used', '1');
            });

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'unused',
            'label'=> 'Available'
        ],
            false,
            function() {
                $this->crud->addClause('where', 'used', '0');
            });

        $this->crud->addColumn([
            'name'  => 'key',
            'label' => 'Key',
            'type'  => 'text'
        ]);

        $this->crud->addColumn([
            'name'  => 'used',
            'label' => 'Used',
            'type'  => 'boolean',
        ]);

        $this->crud->addColumn([  // Select
            'label' => 'User',
            'type' => 'select',
            'name' => 'user_id', // the db column for the foreign key
            'entity' => 'user', // the method that defines the relationship in your Model
            'attribute' => 'username', // foreign key attribute that is shown to user
            'model' => "App\Models\User"
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
        $this->crud->setValidation(InviteRequest::class);

        //$this->crud->setFromDb();

        $this->crud->addField([
            'name' => 'key',
            'label' => 'Invite key',
            'type' => 'text'
        ]);
    }

}
