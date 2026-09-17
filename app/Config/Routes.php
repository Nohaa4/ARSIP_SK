<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// ==========================
// AUTH
// ==========================

$routes->get('/', 'Auth::index');
$routes->get('/login', 'Auth::index');
$routes->post('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');


// ==========================
// BERANDA
// ==========================

$routes->get('/beranda', 'Home::index');


// ==========================
// DATA IA / SK
// ==========================

$routes->get('/data-ia-sk', 'Surat::index');

$routes->get('/data-ia-sk/tambah', 'Surat::tambah');
$routes->post('/data-ia-sk/simpan', 'Surat::simpan');

$routes->get('/data-ia-sk/detail/(:num)', 'Surat::detail/$1');

$routes->get('/data-ia-sk/edit/(:num)', 'Surat::edit/$1');
$routes->post('/data-ia-sk/update/(:num)', 'Surat::update/$1');

$routes->get('/data-ia-sk/pdf/(:num)', 'Surat::pdf/$1');

$routes->get('/data-ia-sk/hapus/(:num)', 'Surat::hapus/$1');

// ==========================
// TAMBAH DATA IA/SK
// ==========================
$routes->get('/data-ia-sk', 'Surat::index');

$routes->get('/surat/tambah', 'Surat::tambah');
$routes->post('/surat/simpan', 'Surat::simpan');

$routes->get('/surat/download/(:num)', 'Surat::download/$1');

//action data//
$routes->get('/data-ia-sk', 'Surat::index');

$routes->get('/surat/tambah', 'Surat::tambah');
$routes->post('/surat/simpan', 'Surat::simpan');

$routes->get('/surat/detail/(:num)', 'Surat::detail/$1');

$routes->get('/surat/download/(:num)', 'Surat::download/$1');

$routes->get('/surat/edit/(:num)', 'Surat::edit/$1');
$routes->post('/surat/update/(:num)', 'Surat::update/$1');

// ==========================
// PROGRAM
// ==========================

$routes->get('/program', 'Program::index');
$routes->post('/program/simpan', 'Program::simpan');
$routes->post('/program/update/(:num)', 'Program::update/$1');
$routes->get('/program/hapus/(:num)', 'Program::hapus/$1');

// ==========================
// TAMBAH PROGRAM
// ==========================
$routes->get('/program', 'Program::index');
$routes->get('/program/tambah', 'Program::tambah');
$routes->post('/program/simpan', 'Program::simpan');


// ==========================
// DEPARTEMEN
// ==========================

$routes->get('/departemen', 'Departemen::index');
$routes->post('/departemen/simpan', 'Departemen::simpan');
$routes->post('/departemen/update/(:num)', 'Departemen::update/$1');
$routes->get('/departemen/hapus/(:num)', 'Departemen::hapus/$1');

// ==========================
// TAMBAH DEPARTEMEN
// ==========================
$routes->get('/departemen', 'Departemen::index');
$routes->get('/departemen/tambah', 'Departemen::tambah');
$routes->post('/departemen/simpan', 'Departemen::simpan');

// ==========================
// PENGGUNA
// ==========================

$routes->get('/pengguna', 'Pengguna::index');
$routes->post('/pengguna/simpan', 'Pengguna::simpan');
$routes->post('/pengguna/update/(:num)', 'Pengguna::update/$1');
$routes->get('/pengguna/hapus/(:num)', 'Pengguna::hapus/$1');
