<?php

test('Not debugging statements are left in our code.')
    ->expect(['dd', 'dump', 'ray'])
    ->not->toBeUsed();

test('Do not directly use Eloquent Models in our APIs.')
    ->expect('App\Models')
    ->not->toBeUsedIn('App\Http\Controllers\Api');

test('Always use Resource classes when responding')
    ->expect('App\Http\Resources')
    ->toBeUsedIn('App\Http\Controllers');
