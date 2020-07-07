<?php

$fileHost = App\Classes\Game\Handlers\ServerHandler::getServer('31.113.213.227');

return [
    'host'      => $fileHost->hostID,
    'filename'  => 'red_pill.bin',
    'filetype'  => 'bin',
    'content'   => 'Follow the white rabbit...',
    'encrypted' => 0,
    'password'  => null,
    'filesize'  => 58
];