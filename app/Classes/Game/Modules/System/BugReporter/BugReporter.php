<?php

namespace App\Classes\Game\Modules\System\BugReporter;

use App\Classes\Game\Handlers\UserHandler;
use App\Classes\Game\BugReport;
use App\Classes\Game\Module;
use App\Models\Bug;
use App\Models\BugCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BugReporter extends Module
{
    public function setup(){
        $this->name = "bugreporter";
        $this->title = "Bug Reporter";

        $this->size = array(
            "width"     => 660,
            "height"    => 425
        );
    }

    public function returnHTML()
    {
        $cssPath = '/modules/css/';
        $jsPath = '/modules/js/';
        $categories = BugCategory::get();

        $view = view('modules.system.bugreporter.views.index',
            [
                'cssPath' => $cssPath,
                'jsPath' => $jsPath,
                'categories' => $categories
            ]
        );

        return $view->render();
    }

    public function ajaxSubmit(Request $request)
    {
        $subject = $request->get('title');
        $description = $request->get('content');
        $category = $request->get('category');

        $result = array(
            'answer' => true
        );

        if(empty($subject) || empty($description) || empty($category)){
            $result = array(
                'answer' => false
            );

            return $result;
        }

        $user = UserHandler::getUser(Auth::id());
        $report = $user->bugreporter->newReport($subject, $description, $category);

        if(empty($report)){
            $result = array(
                'answer' => false
            );
        }

        return $result;
    }
}
