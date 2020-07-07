<?php

$fileHost = App\Classes\Game\Handlers\ServerHandler::getServer('87.49.178.2');

return [
    'host'      => $fileHost->hostID,
    'filename'  => 'omnimail.conf',
    'filetype'  => 'txt',
    'content'   => '[server]
ip = 87.49.178.2
hostname = germail.com
port = 80
description = "GerMail - E-Mail für alle"
admin_hash = "NTJuX3Y3P21ga2I"

[database]
db_host = 122.5.55.100
db_port = 5989
db_keyfile = secukey.cert

[externals]
load_config = {
     cfg/omni.smtp.conf
     cfg/omni.pop.conf
     cfg/omni.imap.conf
     cfg/omni.webmail.conf
     cfg/coco.antispam.conf
     cfg/coco.antivirus.conf
     cfg/omni.quota.conf
     cfg/omni.authmodules.conf
     cfg/global.domains.conf
     cfg/global.security.conf
}
load_module = {
     modules/omni.*.omod
     modules/coco.antispam.omod
     modules/coco.antivirus.omod
}

[logs]
log_dir = /mnt/srv_logs/omnimail
max_size = 64M
max_age = 1Y',
    'encrypted' => 0,
    'password'  => null,
    'filesize'  => 4
];