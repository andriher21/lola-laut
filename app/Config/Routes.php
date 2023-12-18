<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//AUTH
$routes->get('/', 'Auth::index');
$routes->post('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');

//DASHBOARD
$routes->get('/dashboard', 'Dashboard::index');

//Account
$routes->get('/account', 'Account::index');
$routes->post('/accountUpdate', 'Account::edit');


//Transaction
$routes->get('/transaction', 'Transaction::daily');
$routes->get('/transaction/(:segment)', 'Transaction::daily/$1');
$routes->get('transaction/transaction/(:segment)', 'Transaction::daily/$1');
$routes->get('/printReport/(:segment)', 'Transaction::printReport/$1');
$routes->get('/exportCsv/(:segment)', 'Transaction::exportCsv/$1');
$routes->post('/deletetransaksi', 'Transaction::delete');
$routes->post('/edittransaksi', 'Transaction::edit');

//Report
$routes->get('/report', 'Report::index');
$routes->get('/report/(:segment)/(:segment)', 'Report::index/$1/$2');
$routes->get('/printReportData/(:segment)/(:segment)', 'Report::printReportData/$1/$2');
$routes->get('/exportReportData/(:segment)/(:segment)', 'Report::exportCsv/$1/$2');
$routes->post('/deleteDataReport', 'Report::delete');
$routes->post('/restorereport', 'Report::RestoreData');

//Report Trash
$routes->get('/reporttrash', 'ReportTrash::index');

//Company
$routes->get('/company', 'Company::index');
$routes->post('/addcompany', 'Company::add');
$routes->post('/editcompany', 'Company::edit');
$routes->post('/deletecompany', 'Company::delete');
$routes->post('/readCSVcompany', 'Company::readCSV');
$routes->post('/doImportcompany', 'Company::doImport');
$routes->post('/restorecompany', 'Company::RestoreData');
$routes->post('/synccompany', 'Company::sync');

//Item
$routes->get('/item', 'Item::index');
$routes->post('/additem', 'Item::add');
$routes->post('/edititem', 'Item::edit');
$routes->post('/deleteitem', 'Item::delete');
$routes->post('/readCSVitem', 'Item::readCSV');
$routes->post('/doImportitem', 'Item::doImport');
$routes->post('/restoreitem', 'Item::RestoreData');
$routes->post('/syncitem', 'Item::sync');

//Tujuan
$routes->get('/tujuan', 'Tujuan::index');
$routes->post('/addtujuan', 'Tujuan::add');
$routes->post('/edittujuan', 'Tujuan::edit');
$routes->post('/deletetujuan', 'Tujuan::delete');
$routes->post('/readCSVtujuan', 'Tujuan::readCSV');
$routes->post('/doImporttujuan', 'Tujuan::doImport');
$routes->post('/restoretujuan', 'Tujuan::RestoreData');
$routes->post('/synctujuan', 'Tujuan::sync');

//Trans
$routes->get('/trans', 'Trans::index');
$routes->post('/addtrans', 'Trans::add');
$routes->post('/edittrans', 'Trans::edit');
$routes->post('/deletetrans', 'Trans::delete');
$routes->post('/readCSVtrans', 'Trans::readCSV');
$routes->post('/doImporttrans', 'Trans::doImport');
$routes->post('/restoretrans', 'Trans::RestoreData');
$routes->post('/synctrans', 'Trans::sync');

//PLant
$routes->get('/plant', 'Plant::index');
$routes->post('/addplant', 'Plant::add');
$routes->post('/editplant', 'Plant::edit');
$routes->post('/deleteplant', 'Plant::delete');
$routes->post('/readCSVplant', 'Plant::readCSV');
$routes->post('/doImportplant', 'Plant::doImport');
$routes->post('/restoreplant', 'Plant::RestoreData');
$routes->post('/syncplant', 'Plant::sync');

//Flasi
$routes->get('/flasi', 'Flasi::index');
$routes->post('/addflasi', 'FLasi::add');
$routes->post('/editflasi', 'Flasi::edit');
$routes->post('/deleteflasi', 'FLasi::delete');
$routes->post('/readCSVflasi', 'Flasi::readCSV');
$routes->post('/doImportflasi', 'Flasi::doImport');
$routes->post('/restoreflasi', 'Flasi::RestoreData');
$routes->post('/syncflasi', 'Flasi::sync');

//Driver
$routes->get('/driver', 'Driver::index');
$routes->post('/adddriver', 'Driver::add');
$routes->post('/editdriver', 'Driver::edit');
$routes->post('/deletedriver', 'Driver::delete');
$routes->post('/readCSVdriver', 'Driver::readCSV');
$routes->post('/doImportdriver', 'Driver::doImport');
$routes->post('/restoredriver', 'Driver::RestoreData');
$routes->post('/syncdriver', 'Driver::sync');

//Client
$routes->get('/client', 'Client::index');
$routes->post('/addclient', 'Client::add');
$routes->post('/editclient', 'Client::edit');
$routes->post('/deleteclient', 'Client::delete');
$routes->post('/setStatus', 'Client::setStatus');

//ClientLog
$routes->get('/clientlog', 'ClientLog::index');

//User
$routes->get('/user', 'User::index');
$routes->post('/adduser', 'User::add');
$routes->post('/edituser', 'User::edit');
$routes->post('/deleteuser', 'User::delete');

//REST API
$routes->get('/restapi/company/', 'RestApi::companyindex/');
$routes->get('/restapi/item/', 'RestApi::itemindex/');
$routes->post('/restapi/company', 'RestApi::companypost/');
$routes->put('/restapi/company/', 'RestApi::companyput/');
$routes->delete('/restapi/company/', 'RestApi::companydelete/');
$routes->post('/restapi/item/', 'RestApi::itempost/');
$routes->put('/restapi/item/', 'RestApi::itemput/');
$routes->delete('/restapi/item/', 'RestApi::itemdelete/');
$routes->get('/restapi/trans/', 'RestApi::transindex/');
$routes->post('/restapi/trans/', 'RestApi::transpost/');
$routes->put('/restapi/trans/', 'RestApi::transput/');
$routes->patch('/restapi/trans/', 'RestApi::transpatch/');
$routes->delete('/restapi/trans/', 'RestApi::transdelete/');
$routes->get('/restapi/driver/', 'RestApi::driverindex/');
$routes->post('/restapi/driver/', 'RestApi::driverpost/');
$routes->put('/restapi/driver/', 'RestApi::driverput/');;
$routes->delete('/restapi/driver/', 'RestApi::driverdelete/');
$routes->get('/restapi/flasi/', 'RestApi::flasiindex/');
$routes->post('/restapi/flasi/', 'RestApi::flasipost/');
$routes->put('/restapi/flasi/', 'RestApi::flasiput/');;
$routes->delete('/restapi/flasi/', 'RestApi::flasidelete/');
$routes->get('/restapi/plant/', 'RestApi::plantindex/');
$routes->post('/restapi/plant/', 'RestApi::plantpost/');
$routes->put('/restapi/plant/', 'RestApi::plantput/');;
$routes->delete('/restapi/plant/', 'RestApi::plantdelete/');
$routes->get('/restapi/type/', 'RestApi::typeindex/');
$routes->post('/restapi/type/', 'RestApi::typepost/');
$routes->put('/restapi/type/', 'RestApi::typeput/');;
$routes->delete('/restapi/type/', 'RestApi::typedelete/');
$routes->get('/restapi/tujuan/', 'RestApi::tujuanindex/');
$routes->post('/restapi/tujuan/', 'RestApi::tujuanpost/');
$routes->put('/restapi/tujuan/', 'RestApi::tujuanput/');;
$routes->delete('/restapi/tujuan/', 'RestApi::tujuandelete/');
$routes->get('/restapi/transaksi/', 'RestApi::transaksiindex/');
$routes->post('/restapi/transaksi/', 'RestApi::transaksipost/');


$routes->get('/api/customer/(:segment)', 'Api::customerget/$1');
$routes->post('/api/customer', 'Api::customerpost');
$routes->patch('/api/customer/(:segment)', 'Api::customerpatch/$1');
$routes->delete('/api/customer/(:segment)', 'Api::customerdelete/$1');

$routes->get('/api/vehicle', 'Api::vehicleindex');
$routes->get('/api/vehicle/(:segment)', 'Api::vehicleget/$1');
$routes->post('/api/vehicle', 'Api::vehiclepost');
$routes->patch('/api/vehicle/(:segment)', 'Api::vehiclepatch/$1');
$routes->delete('/api/vehicle/(:segment)', 'Api::vehicledelete/$1');

$routes->get('/api/material', 'Api::materialindex');
$routes->get('/api/material/(:segment)', 'Api::materialget/$1');
$routes->post('/api/material', 'Api::materialpost');
$routes->patch('/api/material/(:segment)', 'Api::materialpatch/$1');
$routes->delete('/api/material/(:segment)', 'Api::materialdelete/$1');

$routes->get('/api/clientid', 'Api::clientidindex');
$routes->get('/api/clientid/(:segment)', 'Api::clientidget/$1');

$routes->get('/client', 'Client::index');

$routes->get('/client/customer', 'Client::customerindex');

$routes->get('/client/vehicle', 'Client::vehicleindex');

$routes->get('/client/material', 'Client::materialindex');

$routes->get('/client/record', 'Client::recordindex');
//$routes->get('/client/record/(:segment)', 'Client::recordget/$1');
$routes->post('/client/record', 'Client::recordpost');
$routes->delete('/client/record/(:segment)', 'Client::recorddelete/$1');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
