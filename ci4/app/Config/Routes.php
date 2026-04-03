<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
// $routes->get('/artikel', 'Artikel::index'); // dihapus, gunakan /user/artikel
// $routes->get('/artikel/(:segment)', 'Artikel::view/$1'); // dihapus, gunakan /user/artikel
// $routes->get('/artikel/(:any)', 'Artikel::view/$1'); // dihapus
$routes->get('/about', 'Page::about');
$routes->get('/contact', 'Page::contact');
$routes->get('/faqs', 'Page::faqs');

$routes->get('/login', 'User::login');
$routes->post('/login', 'User::login');
$routes->get('/register', 'User::register');
$routes->post('/register', 'User::register');
$routes->get('/guest', 'User::guest');
$routes->get('/logout', 'User::logout');

$routes->group('user', function($routes) {
    $routes->get('artikel', 'Artikel::index');
    $routes->get('artikel/(:segment)', 'Artikel::view/$1');
});

$routes->group('admin', function($routes) { 
    $routes->get('', 'Artikel::admin_home');
    $routes->get('home', 'Artikel::admin_home'); 
    $routes->get('artikel', 'Artikel::admin_index'); 
    $routes->add('artikel/add', 'Artikel::add'); 
    $routes->add('artikel/edit/(:any)', 'Artikel::edit/$1'); 
    $routes->get('artikel/delete/(:any)', 'Artikel::delete/$1'); 
}); 