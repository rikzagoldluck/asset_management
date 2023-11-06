<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// ASET TETAP

$routes->set404Override(function () {
    return view('404');
});

$routes->get('/', 'Home::index');
$routes->get('/weeklyStockData', 'Home::weeklyStockData');
$routes->get('/aset-tetap', 'AsetTetap::index', ['filter' => 'role:administrator']);
$routes->get('/aset-tetap/distinct/(:alpha)', 'AsetTetap::distinct/$1', ['filter' => 'role:administrator']);
$routes->resource('AsetTetapAPI', ['filter' => 'role:administrator']);

// ASET BERGERAK
$routes->get('/aset-bergerak', 'AsetBergerak::index', ['filter' => 'role:administrator']);
$routes->get('/aset-bergerak/select2', 'AsetBergerak::select2', ['filter' => 'role:administrator']);
$routes->get('/aset-bergerak/distinct/(:alpha)', 'AsetBergerak::distinct/$1', ['filter' => 'role:administrator']);
$routes->post('/aset-bergerak/transaksi', 'AsetBergerak::transaction', ['filter' => 'role:administrator']);
$routes->resource('AsetBergerakAPI', ['filter' => 'role:administrator']);


// ASET BANGUNAN
$routes->get('/aset-bangunan', 'AsetBangunan::index', ['filter' => 'role:administrator']);
$routes->get('/aset-bangunan/distinct/(:alpha)', 'AsetBangunan::distinct/$1', ['filter' => 'role:administrator']);
$routes->resource('AsetBangunanAPI', ['filter' => 'role:administrator']);

// MASTER ASET
$routes->get('/master-aset', 'MasterAset::index', ['filter' => 'role:administrator']);
$routes->get('/master-aset/distinct/(:alpha)', 'MasterAset::distinct/$1', ['filter' => 'role:administrator']);
$routes->resource('MasterAsetAPI', ['filter' => 'role:administrator']);


// PELAPORAN
$routes->get('/pelaporan', 'Pelaporan::index', ['filter' => 'role:administrator, user']);
$routes->get('/pelaporan/transaksi-aset', 'Pelaporan::transaksiAset', ['filter' => 'role:administrator, user']);
$routes->patch('/pelaporan/transaksi-aset', 'Pelaporan::dataTable', ['filter' => 'role:administrator, user']);
$routes->get('/pelaporan/(:alpha)', 'Pelaporan::index/$1', ['filter' => 'role:administrator, user']);
$routes->get('/pelaporan/getDataAndColumns/(:alpha)', 'Pelaporan::getDataAndColumns/$1', ['filter' => 'role:administrator, user']);

$routes->get('/excel-importer', 'ExcelImporter::index');
$routes->post('/excel-importer/import', 'ExcelImporter::import');
