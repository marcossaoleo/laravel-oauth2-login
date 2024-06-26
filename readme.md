# Laravel OAuth2 Login

[![Software License][ico-license]](LICENSE.md)
[![Latest Stable Version][ico-githubversion]][link-releases]
[![Build Status][ico-build]][link-build]

This is a Laravel package that provides a middleware to protect routes requiring an OAuth2 login.

You could describe it as a bridge between Laravel and [league/oauth2-client](https://github.com/thephpleague/oauth2-client).

## Features

* OAuth2 client middleware
* Keeps token in session
* Refreshes expired tokens
* (Cached) resource owner info
* Driver to allow integration with `Auth/auth()`

## Install

* Using composer: `$ composer require marcossaoleo/laravel-oauth2-login`
* Register the service provider (Auto-Discovery enabled): `Marcossaoleo\LaravelOAuth2Login\ServiceProvider`
* Publish the config file: `$ artisan vendor:publish --provider="Marcossaoleo\LaravelOAuth2Login\ServiceProvider"`
* Put the credentials of your OAuth Provider in the published config

## Usage

Add the `Marcossaoleo\LaravelOAuth2Login\CheckOAuth2` middleware to the routes (-groups) you want to protect.

**Bear in mind that this only ensures that some user is logged in**, if you require further authorization checks those will still have to be implemented. This package stores the resource owner info as an Request-attribute to enable you to do so.

This redirects unauthenticated users. If on some routes you only want to check whether a session by this package exists (for instance to display a login/logout button in your template) use `Marcossaoleo\LaravelOAuth2Login\OnlyCheckOAuth`.
It will also refresh tokens and pull up to date resource owner data, but never redirect. On failure it just doesn't set the Request attribute.

### `Auth` guard

This is optional, as adding the middleware redirects the client anyways if not authenticated. If you want to utilize Policies however you will need to define a custom guard. A driver for it is provided by this package.

In your auth config, add the new guard like this:
``` php
  'oauth2' => [
    'driver' => 'oauth2', // Config: oauth2login.auth_driver_key
  ]
```

**You will need to assign a higher priority to `CheckOAuth2` than `\Illuminate\Auth\Middleware\Authenticate`**, do this by overriding `$middlewarePriority` in your Http-Kernel.

If you want to add the middleware globally, best do it as route-middleware, in `middlewareGroups.web`, rather than the very global middleware array.

## Changelog

Please see the [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see the [License File](LICENSE.md) for more information.

[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-githubversion]: https://badge.fury.io/gh/marcossaoleo%2Flaravel-oauth2-login.svg
[ico-build]: https://travis-ci.org/marcossaoleo/laravel-oauth2-login.svg?branch=master

[link-releases]: https://github.com/marcossaoleo/laravel-oauth2-login/releases
[link-contributors]: ../../contributors
[link-build]: https://travis-ci.org/marcossaoleo/laravel-oauth2-login
