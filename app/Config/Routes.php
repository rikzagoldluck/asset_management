<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// ASET TETAP

$routes->set404Override(function () {
    return view('404');
});


// $routes->get('/aset-tetap', 'AsetTetap::index', ['filter' => 'role:administrator']);
// $routes->get('/aset-tetap/distinct/(:alpha)', 'AsetTetap::distinct/$1', ['filter' => 'role:administrator']);


// // ASET BERGERAK
// $routes->get('/aset-bergerak', 'AsetBergerak::index', ['filter' => 'role:administrator,']);
// $routes->get('/aset-bergerak/select2', 'AsetBergerak::select2', ['filter' => 'role:administrator']);
// $routes->get('/aset-bergerak/distinct/(:alpha)', 'AsetBergerak::distinct/$1', ['filter' => 'role:administrator']);

// // ASET BANGUNAN
// $routes->get('/aset-bangunan', 'AsetBangunan::index', ['filter' => 'role:administrator']);
// $routes->get('/aset-bangunan/distinct/(:alpha)', 'AsetBangunan::distinct/$1', ['filter' => 'role:administrator']);


// // MASTER ASET
// $routes->get('/master-aset', 'MasterAset::index', ['filter' => 'role:administrator']);
// $routes->get('/master-aset/distinct/(:alpha)', 'MasterAset::distinct/$1', ['filter' => 'role:administrator']);

// // PELAPORAN
// $routes->get('/pelaporan', 'Pelaporan::index', ['filter' => 'role:administrator, user']);
$routes->get('/pelaporan/transaksi-aset', 'Pelaporan::transaksiAset', ['filter' => 'role:administrator, user']);
$routes->patch('/pelaporan/transaksi-aset', 'Pelaporan::dataTable', ['filter' => 'role:administrator, user']);

$routes->get('/', 'Home::index');
$routes->get('/weeklyStockData', 'Home::weeklyStockData');
$routes->get('/generate-barcode', 'QrCodeController::barcode');

$routes->get('/aset-tetap/dashboard', 'AsetTetap::dashboard', ['filter' => 'role:administrator, user']);
$routes->get('/aset-tetap/search-last-code/(:segment)', 'AsetTetap::searchLastCode/$1');
$routes->post('/aset-tetap/upload', 'AsetTetap::import');
$routes->resource('AsetTetapAPI');

$routes->post('/aset-bergerak/transaksi', 'AsetBergerak::transaction', ['filter' => 'role:administrator']);
$routes->get('/aset-bergerak/dashboard', 'AsetBergerak::dashboard', ['filter' => 'role:administrator, user']);
$routes->resource('AsetBergerakAPI');

$routes->get('/master-aset/search', 'MasterAset::search');
$routes->get('/master-aset/search-last-code', 'MasterAset::searchLastCode');
$routes->resource('MasterAsetAPI');
$routes->resource('AsetBangunanAPI');

$routes->get('/pelaporan', 'Pelaporan::index', ['filter' => 'role:administrator, user']);
