<?php

namespace App\Classes\Game\Modules\System\CorpStatus;

use App\Classes\Game\Handlers\CorpHandler;
use App\Classes\Game\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CorpStatus extends Module
{
    public function setup(){
        $this->name = "CorpStatus";
        $this->title = "Corporation Status";

        $this->size = array(
            "width"     => 480,
            "height"    => 300
        );
    }

    public function ajaxJoin(Request $request)
    {
        currentPlayer()->joinCorporation($request->get('invitekey'));
    }

    public function ajaxLeave(Request $request)
    {
        currentPlayer()->leaveCorporation();
    }

    public function ajaxCreate(Request $request)
    {
        $result = array(
            'answer' => false
        );

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:corporations|max:64',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return $result;
        }

        $newCorpModel = CorpHandler::createCorporation($request->get('name'), $request->get('description'), Auth::id());
        $newCorpObj = CorpHandler::getCorporation($newCorpModel->id);
        $inviteKey = $newCorpObj->newInviteKey();

        if(currentPlayer()->joinCorporation($inviteKey)){
            $result['answer'] = true;
            return $result;
        }

        $result['answer'] = false;
        return $result;
    }

}
