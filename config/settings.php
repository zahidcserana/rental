<?php

return [
    'title' => 'House Rent Management',
    'domain' => env('APP_URL', 'http://hrent-aj.herokuapp.com/'),
    'images' => [
        'house' => 'assets/images/house.jpg',
        'user' => 'assets/images/user.png',
    ],
    'company' => [
        'year' => '2021',
        'title' => 'AnalyticalJ',
        'name' => 'Analytical Journey',
        'email' => 'analyticalzahid@gmail.com',
        'website' => 'https://analyticalj.herokuapp.com',
        'about' => 'https://analyticalj.herokuapp.com/#about',
        'contact' => 'https://analyticalj.herokuapp.com/#contact',
        'mobile' => '01970887754',
        'moto' => 'Business Solution Software',
        'caption' => 'Software Solution Company',
        'address' => 'Dhaka, Bangladesh',
        'images' => [
            'reload' => 'assets/images/aj/reload.png',
            'logo' => 'assets/images/aj/logo.jpg',
            'top' => 'assets/images/analytical-logo.png',
            'profile' => 'assets/images/aj/profile.png',
            'sidebar' => 'assets/images/aj/sm_sidebar.png',
            'header' => 'assets/images/aj/header.png',
        ],
    ],
    'invoice_status' => [
        'due' => 'Due',
        'paid' => 'Paid',
        'unpaid' => 'Unpaid',
    ],

    'flat_status' => [
        'available' => 'Available',
        'rented' => 'Rented',
        'unavailable' => 'Unavailable',
    ],

    'common_status' => [
        'pending' => 'pending',
        'active' => 'active',
        'inactive' => 'inactive',
    ],

];
