<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index', ['filter' => 'login']);
$routes->get('rider/(:any)', 'Home::rider/$1', ['filter' => 'login']);
$routes->get('pdf', 'Home::pdf', ['filter' => 'login']);
$routes->get('pdf/(:num)', 'Home::pdf_for_rider/$1', ['filter' => 'login']);
$routes->post('pdf/send', 'Home::generate_pdf', ['filter' => 'login']);
$routes->get('remove/rider/(:num)', 'Home::remove/$1', ['filter' => 'login']);
$routes->get('edit/rider/(:num)',  'Home::show_edit/$1', ['filter' => 'login']);
$routes->post('edit/rider/(:num)',  'Home::edit/$1', ['filter' => 'login']);
$routes->get('add/rider', 'Home::show_add', ['filter' => 'login']);
$routes->post('add/rider', 'Home::add', ['filter' => 'login']);
$routes->get('graph', 'Home::graph', ['filter' => 'login']);
$routes->get('login', 'Home::login');
$routes->post('login', 'Home::check_login');