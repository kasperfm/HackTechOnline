<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('notifications.{id}', function ($user, $id) {
    Auth::check();
    return md5($user->id) === $id;
});

Broadcast::channel('handleapp.{id}', function ($user, $id) {
    Auth::check();
    return md5($user->id) === $id;
});