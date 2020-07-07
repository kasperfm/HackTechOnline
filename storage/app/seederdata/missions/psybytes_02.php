<?php

$psyBytesID = App\Classes\Game\Handlers\CorpHandler::getCorporationByName('PsychedelicBytes')->corpID;
$chainParentMission = App\Classes\Game\Handlers\MissionHandler::findMission('PSYBYTES-01-INTRO');

return [
    'shortcode'             => 'PSYBYTES-02-PWDCRACK',
    'title'                 => 'Cr@ck dat konfig pazz',
    'description'           => 'You completed our first task, but now the fun part begins! Open the configuration file you got from the GerMail admin system in your default text editor. Then look for the admin password to their root-domain, crack it using your favourite cracker tool, and send it to us. To send decrypted password to us, please don\'t use email or other crappy methods. But point your browser to "https://sharemypwd.info", and use the unique access token "shrooms4ever" and fill in the cracked password, to share it with us.',
    'complete_message'      => 'Thank you for the password! You better hide your tracks a bit now.',
    'reward_trust'          => 5,
    'reward_credits'        => 175,
    'corp_id'               => $psyBytesID,
    'type'                  => 'submit',
    'objective'             => 'submit 34hYp19kfmd to 78.45.107.4',
    'minimum_trust'         => 5,
    'hidden'                => 0,
    'chain_parent'          => $chainParentMission->id
];