<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 * */

// New Account Routes
$routes->group('signup', function($routes) {
    $routes->get('/',               'signup\Signup::index');
    $routes->post('create',         'signup\Signup::create');
});

// Login Routes
$routes->group('login', function($routes) {
    $routes->get('/',                   'login\Login::index');
    $routes->post('authenticate',       'login\Login::authenticate');
});

// My Account Routes
$routes->group('myaccount', function($routes) {
    $routes->get('/',                   'myaccount\MyAccount::index');
    $routes->post('update',             'myaccount\MyAccount::update');
});
