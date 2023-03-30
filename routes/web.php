<?php

use Illuminate\Support\Facades\Route;
use App\Services\TestService;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// $testService1 = TestService::setValue('Bishal');
// dump($testService1->getName());

// $testService2 = TestService::setValue('Ram');
// dump($testService2->getName());

// $app1 = app()->make(TestService::class);
// $app1->setName('Hey!');

// $app2 = app()->make(TestService::class);
// $app2->setName('Hello!');

// $app1 = TestService::staticSetFruit('Apple');
// $app2 = TestService::staticSetFruit('Mango');

// dump($app1->getFruit());
// dump($app2->getFruit());

// dump(TestService::staticGetFruit());

Route::get('/', function () {
    return view('welcome');
});
