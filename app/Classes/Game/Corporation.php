<?php

namespace App\Classes\Game;

use App\Models\Corporation as Model;
use App\Models\User;

class Corporation
{
    protected $user;
    protected $model = null;

    public $corpID;
    public $name;
    public $description;
    public $status;
    public $owner;

    public function __construct(Model $corpModel)
    {
        $this->model = $corpModel;

        $this->corpID = $corpModel->id;
        $this->name = $corpModel->name;
        $this->description = $corpModel->description;
        $this->status = $corpModel->status;
        $this->owner = $corpModel->owner;
    }
}
