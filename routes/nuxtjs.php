<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| NuxtJS Routing
|--------------------------------------------------------------------------
|
| Here registers the NuxtJs router. Nothing else should come here.
| This route are loaded by the RouteServiceProvider within a group which
| is assigned the "nuxt" middleware group.
|
*/

Route::get('{path}', RouteController::class)->where('path', '(.*)');
