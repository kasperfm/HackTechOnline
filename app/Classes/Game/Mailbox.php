<?php

/**
 * App\Classes\Game\Mailbox
 *
 * @package HackTech Online
 * @author Kasper F. Mikkelsen
 * @copyright 2018
 * @version 1.0
 * @access public
 */

namespace App\Classes\Game;

use App\Models\Message;
use App\Models\User;

class Mailbox
{
    public $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function sendNewMessage($to, $subject, $message){
        $newMessage = new Message();
        $newMessage->from_user_id = $this->user->id;
        $newMessage->to_user_id = $to;
        $newMessage->subject = strip_tags($subject);
        $newMessage->message = strip_tags(nl2br($message), '<br>');
        $newMessage->save();

        activity('game')->performedOn($newMessage)->withProperties(['message_id' => $newMessage->id])->causedBy($this->user->model)->log('Ingame mail sent');
    }

    public function deleteMessage(Message $message){
        activity('game')->performedOn($message)->withProperties(['message_id' => $message->id])->causedBy($this->user->model)->log('Ingame mail deleted');
        $message->delete();
    }

    public function checkSpamTimer(){
        $secondsBetweenMessages = 30;
        $lastMessage = Message::where('from_user_id', $this->user->id)->orderBy('created_at', 'desc')->first();

        if(!$lastMessage){
            return true;
        }

        if(strtotime($lastMessage->created_at) < time() - $secondsBetweenMessages){
            return true;
        }

        return false;
    }

    public function listMessages(){
        $messages = Message::where('to_user_id', $this->user->id)->get();
        return $messages;
    }

    public function markAsRead($messageID){
        try {
            $message = Message::where('id', $messageID)->firstOrFail();
            $this->setStatus($message, 1);
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return false;
        }

        return true;
    }

    public function markAsUnread($messageID){
        try {
            $message = Message::where('id', $messageID)->firstOrFail();
            $this->setStatus($message, 0);
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return false;
        }

        return true;
    }

    private function setStatus(Message $message, $status){
        $message->status = $status;
        $message->save();
    }
}