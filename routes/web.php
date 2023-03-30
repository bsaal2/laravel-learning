<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
// use App\Services\TestService;

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


// This route show the search view page
Route::get('/search-page', function() {
    return view('search');
});

/**
 * This route handles the search from the search view
 * It tries to validate the request first
 * If failed then redirect to same page along with the flashing of old input
 * If we want to flash input in the custom way then we can do by using the flash() method of request
 */
Route::get('search', function(Request $request) {
    $request->validate([
        'search' => 'required|min:5'
    ]);
    $request->flash();
    return view('search', ['search' => $request->old('search')]);
});
