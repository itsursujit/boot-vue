<?php

namespace App\Http\Controllers;

use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Modules\Address\Entities\Address;
use Modules\Contact\Entities\Contact;
use Modules\Event\Entities\Event;
use Modules\Product\Entities\Product;
use Modules\User\Entities\User;

class Welcome extends Controller
{
    public function laravel()
    {
        dd(Event::near(-33.873882, 151.177460))->get();
        /*$faker = Factory::create();
        for($i = 0; $i<=100; $i++)
        {
            $event = Event::create([
                'title' => 'Teej Special Party - ' . rand(1000, 2000),
                'slogan' => 'Teej Special Slogan - ' . rand(1000, 2000),
            ]);
            $addressData = [
                'address_line_1' => $faker->secondaryAddress,
                'address_line_2' => $faker->streetAddress,
                'city' => $faker->city,
                'state' => $faker->state,
                'country' => $faker->country,
                'zip_code' => $faker->postcode,
                'latitude' => $faker->latitude,
                'longitude' => $faker->longitude,
            ];
            $address =Address::create($addressData);
            $event->addresses()->save($address);
        }*/
        return view('laravel');
    }
}
