<?php

namespace App\Classes\Game\Modules\System\CorpStatus;

use App\Classes\Game\Handlers\CorpHandler;
use App\Classes\Game\Handlers\UserHandler;
use App\Classes\Game\Module;
use App\Models\Corporation;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CorpStatus extends Module
{
    public function setup(){
        $this->name = "CorpStatus";
        $this->title = "Corporation Status";

        $this->size = array(
            "width"     => 500,
            "height"    => 300
        );
    }

    public function ajaxLoadMemberPage(Request $request)
    {
        $member = getUser($request->get('memberId'));
        if($member->corporation->corpID != currentPlayer()->corporation->corpID){
            return array(
                'answer' => false
            );
        }

        $renderedView = view('Modules::System.CorpStatus.Views.memberpage', [
            'memberInfo' => $member,
            'corp'       => currentPlayer()->corporation
        ])->render();

        return array(
            'answer' => true,
            'view' => $renderedView
        );

    }

    public function ajaxKickMember(Request $request)
    {
        $member = getUser($request->get('memberId'));
        if($member->corporation->corpID != currentPlayer()->corporation->corpID){
            return array(
                'answer' => false
            );
        }

        $profile = UserProfile::where('user_id', $member->userID)->first();
        $profile->corporation_id = null;
        $profile->save();

        return array(
            'answer' => true
        );
    }

    public function ajaxPromoteMember(Request $request)
    {
        if(currentPlayer()->userID != currentPlayer()->corporation->owner->id){
            return array(
                'answer' => false
            );
        }

        $member = getUser($request->get('memberId'));
        if($member->corporation->corpID != currentPlayer()->corporation->corpID){
            return array(
                'answer' => false
            );
        }

        currentPlayer()->corporation->setOwner($member->userID);
        $myUser = UserHandler::getUser(Auth::id(), true); // Force update the session.

        return array(
            'answer' => true
        );
    }

    public function ajaxLoadMembers(Request $request)
    {
        if(!currentPlayer()->corporation){
            return array(
                'answer' => false
            );
        }

        if(currentPlayer()->userID != currentPlayer()->corporation->owner->id){
            return array(
                'answer' => false
            );
        }

        $corpMembers = currentPlayer()->corporation->getMembers();
        $renderedView = view('Modules::System.CorpStatus.Views.memberstab', [
            'corpMembers' => $corpMembers
        ])->render();

        $result = array(
            'answer' => true,
            'view' => $renderedView
        );

        return $result;
    }

    public function ajaxJoin(Request $request)
    {
        currentPlayer()->joinCorporation($request->get('invitekey'));
    }

    public function ajaxLeave(Request $request)
    {
        currentPlayer()->leaveCorporation();
    }

    public function ajaxEdit(Request $request)
    {
        $result = array(
            'answer' => false
        );

        $validator = Validator::make($request->all(), [
            'description' => 'string|max:2048',
        ]);

        $corpModel = Corporation::where('id', currentPlayer()->corporation->corpID)->where('owner_user_id', currentPlayer()->userID)->first();

        if ($validator->fails() || !$corpModel) {
            return $result;
        }

        $corpModel->description = $request->get('description');
        $corpModel->save();

        $result['answer'] = true;
        return $result;
    }

    public function ajaxCreate(Request $request)
    {
        $result = array(
            'answer' => false
        );

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:corporations|max:64',
            'description' => 'string|required|max:2048',
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
