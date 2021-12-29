<?php
return [
    'route' => [
        'prefix' => env('SELLER_ROUTE_PREFIX', 'seller'),
    ],
    'title' => 'Seller Center',
    'logo' => '/vendor/seller/images/logo.svg',
    'logo_dark' => '/vendor/seller/images/logo_dark.svg',
    'logo_sm' => '/vendor/seller/images/logo_sm.svg',
    'logo_sm_dark' => '/vendor/seller/images/logo_sm_dark.svg',
    'copyright' => '2014 - ' . date('Y') . ' ' . config('app.name'),
];
