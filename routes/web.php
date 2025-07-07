<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return 'Hello World From Laravel v' . app()->version() . ' (PHP v' . PHP_VERSION . ')';
});