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
$routes->get('/aset-tetap', 'AsetTetap::index');
$routes->get('/aset-tetap/distinct/(:alpha)', 'AsetTetap::distinct/$1');
$routes->resource('AsetTetapAPI');

// ASET BERGERAK
$routes->get('/aset-bergerak', 'AsetBergerak::index');
$routes->get('/aset-bergerak/distinct/(:alpha)', 'AsetBergerak::distinct/$1');
$routes->resource('AsetBergerakAPI');

// MASTER ASET
$routes->get('/master-aset', 'MasterAset::index');
$routes->get('/master-aset/distinct/(:alpha)', 'MasterAset::distinct/$1');
$routes->resource('MasterAsetAPI');

// PELAPORAN
$routes->get('/pelaporan', 'Pelaporan::index');
$routes->get('/pelaporan/(:alpha)', 'Pelaporan::index/$1');
$routes->get('/pelaporan/getDataAndColumns/(:alpha)', 'Pelaporan::getDataAndColumns/$1');
$routes->get('/pelaporan/getAllTables', 'Pelaporan::getAllTables');
