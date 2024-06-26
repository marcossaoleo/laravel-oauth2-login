<?php

Route::get(config('oauth2login.oauth_redirect_path'),
    'Marcossaoleo\LaravelOAuth2Login\OAuthLoginController@authorizeCallback')
    ->middleware('web')
    ->name('oauth2login.oauth_redirect_route')
;
