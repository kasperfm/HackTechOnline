<?php

$psyBytesID = App\Classes\Game\Handlers\CorpHandler::getCorporationByName('PsychedelicBytes')->corpID;
$chainParentMission = App\Classes\Game\Handlers\MissionHandler::findMission('PSYBYTES-02-PWDCRACK');

return [
    'shortcode'             => 'PSYBYTES-03-NEWIP',
    'title'                 => 'Cover your tracks',
    'description'           => 'As the very final task for now, you should change your gateway\'s IP address as soon as possible! We know it\'s not a very good way to try to be safe, but it\'s better than nothing. So get an IP Renewer tool, and change your IP... NOW!',
    'complete_message'      => 'Phew, that was close. Let us hope that this will slow their tracers down a bit.',
    'reward_trust'          => 10,
    'reward_credits'        => 30,
    'corp_id'               => $psyBytesID,
    'type'                  => 'renewip',
    'objective'             => '',
    'minimum_trust'         => 10,
    'hidden'                => 0,
    'chain_parent'          => $chainParentMission->id
];