<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\BugRequest as StoreRequest;
use App\Http\Requests\BugRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class BugCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class BugCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Bug');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/bug');
        $this->crud->setEntityNameStrings('bug', 'bugs');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->setFromDb();

        // add asterisk for fields that are required in BugRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');

        $this->crud->addFilter([ // add a "simple" filter called Draft
            'type' => 'simple',
            'name' => 'fixed',
            'label'=> 'Fixed'
        ],
            false,
            function() {
                $this->crud->addClause('where', 'fixed', '1');
        });

        $this->crud->addFilter([ // add a "simple" filter called Draft
            'type' => 'simple',
            'name' => 'open',
            'label'=> 'Open'
        ],
            false,
            function() {
                $this->crud->addClause('where', 'fixed', '0');
            });

        $this->crud->addField([  // Select
            'label' => "User",
            'type' => 'select',
            'name' => 'user_id', // the db column for the foreign key
            'entity' => 'user', // the method that defines the relationship in your Model
            'attribute' => 'username', // foreign key attribute that is shown to user
            'model' => "App\Models\User",

            // optional
            'options'   => (function ($query) {
                return $query->orderBy('username', 'ASC')->whereNotNull('username')->where('verified', 1)->get();
            }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
        ]);

        $this->crud->addField([
            'label' => "Category",
            'type' => 'select',
            'name' => 'category_id',
            'entity' => 'category',
            'attribute' => 'title',
            'model' => "App\Models\BugCategory",
            'options'   => (function ($query) {
                return $query->orderBy('title', 'ASC')->get();
            }),
        ]);

        $this->crud->addField([
            'label' => "Fixed",
            'type' => 'checkbox',
            'name' => 'fixed',
        ]);
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
