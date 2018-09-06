<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Hash;
use Modules\User\Entities\User;

Route::group(['domain' => '{domain}', 'middleware' => ['site']], function() {
    //$user = User::with('contacts', 'contacts.addresses')->first();
    //dd($user);
    /*$contact = new \Modules\Contact\Entities\Contact([
       'first_name' => 'rand-' . rand(1000, 2000),
       'middle_name' => 'rand-' . rand(1000, 2000),
       'last_name' => 'rand-' . rand(1000, 2000),
       'mobile' => '9856034616',
       'email' => 'rand-' . rand(1000, 2000) . '@gmail.com',
       'website' => 'https://sujitbaniya.com.np'
    ]);
    $address = new \Modules\Address\Entities\Address([
        //'short_description' => 'Battisputali, Kathmandu Nepal',
        //'long_description' => 'House No 81/81 Ka, Battisputali, Kathmandu 44600, Bagmati Nepal',
        'address_line_1' => 'House No 81/81 Ka',
        'address_line_2' => 'Battisputali',
        'city' => 'Kathmandu',
        'state' => 'Bagmati',
        'country' => 'Nepal',
        'zip_code' => '44600',
    ]);
    $user->contacts()->save($contact);
    $contact->addresses()->save($address);*/
});
Route::get('/', function () {
    return view('welcome');
});
Route::get('/laravel.io', 'Welcome@laravel');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
