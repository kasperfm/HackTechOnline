<?php

namespace App\Classes\Game\Modules\System\Mailbox;

use App\Classes\Game\Handlers\UserHandler;
use App\Classes\Game\Mailbox as UserMailbox;
use App\Models\Message;
use App\Classes\Game\Module;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Mailbox extends Module
{
    public function setup(){
        $this->name = "Mailbox";
        $this->title = "Mailbox";

        $this->size = array(
            "width"     => 600,
            "height"    => 520
        );
    }

    public function returnHTML()
    {
        $username = UserHandler::getUser(Auth::id())->username;
        $cssPath = '/modules/css/';
        $jsPath = '/modules/js/';
        $view = view('Modules::System.Mailbox.Views.index',
            [
                'username' => $username,
                'cssPath' => $cssPath,
                'jsPath' => $jsPath
            ]
        );

        return $view->render();
    }

    public function ajaxLoadInbox(Request $request)
    {
        $user = UserHandler::getUser(Auth::id());
        $messages = $user->mailbox->listMessages();
        $renderedView = view('Modules::System.Mailbox.Views.inbox', [
            'messages' => $messages
        ])->render();

        $result = array(
            'answer' => true,
            'view' => $renderedView
        );

        return $result;
    }

    public function ajaxDelete(Request $request)
    {
        $user = UserHandler::getUser(Auth::id());
        $message = Message::where('to_user_id', $user->userID)->where('id', $request->get('mailid'))->first();

        if($message){
            $user->mailbox->deleteMessage($message);
            $result = array(
                'result' => true
            );
        }else{
            $result = array(
                'result' => false
            );
        }

        return $result;
    }

    public function ajaxGetMessage(Request $request)
    {
        $user = UserHandler::getUser(Auth::id());
        $message = Message::where('to_user_id', $user->userID)->where('id', $request->get('mailid'))->first();
        $response = array();

        if($message) {
            $user->mailbox->markAsRead($message->id);

            $response['message'] = $message->message;
            $response['subject'] = $message->subject;
            $response['from_username'] = $message->fromUser->username;
            $response['is_read'] = $message->status;
            $response['date'] = date("Y-m-d H:i:s", strtotime($message->created_at));
            $response['result'] = true;
        }else{
            $response['result'] = false;
        }

        return $response;
    }

    public function ajaxSend(Request $request)
    {
        $user = UserHandler::getUser(Auth::id());
        $response = array();

        if( empty($request->get('userto')) || empty($request->get('mailsubject')) || empty($request->get('mailcontent')) ){
            $response['result'] = false;
        }else{
            if($user->mailbox->checkSpamTimer()) {
                $sendEmailToUser = User::where('username', $request->get('userto'))->where('verified', 1)->first();

                $user->mailbox->sendNewMessage($sendEmailToUser->id, $request->get('mailsubject'), $request->get('mailcontent'));
                $response['result'] = true;
            }
        }

        return $response;
    }
}
