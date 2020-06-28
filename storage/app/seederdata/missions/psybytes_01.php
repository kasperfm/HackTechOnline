<?php

$psyBytesID = App\Classes\Game\Handlers\CorpHandler::getCorporationByName('PsychedelicBytes')->corpID;

return [
    'title'             => 'Show us your skills',
    'description'       => 'We think you are kind of interesting. If you can complete a few small tasks for us, and show what kind of hacker you are, we will reward you with some nice cash$$. And of course more jobs if you do this good enough... We "magically" got the admin login informations for the German email service "GerMail", and want you to connect to their administration system at http://admin.germail.com, and download the config file for their system. The username for the system is "gottfried-adm" and password "gg7320vb38f". If you complete that task without further questions, we will have plenty of jobs for you later on.',
    'complete_message'  => 'Nice, you did it! Come back for the next task if you want...',
    'reward_trust'      => 5,
    'reward_credits'    => 100,
    'corp_id'           => $psyBytesID,
    'type'              => 'get',
    'objective'         => 'get omnimail.conf from 87.49.178.2',
    'minimum_trust'     => 0,
    'hidden'            => 0,
    'chain_parent'      => 0
];