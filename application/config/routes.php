<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'VivliaController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
//route admin
//$route['adm/(:any)'] = 'AdminController';
$route['adm/home'] = 'AdminController/home';
$route['adm/dashboard'] = 'AdminController/dashboard';
$route['adm/products'] = 'AdminController/products';
$route['adm/products/(:any)'] = 'AdminController/products';
$route['adm/products/(:any)/(:any)'] = 'AdminController/products';
$route['adm/notifications'] = 'AdminController/notifications';
$route['adm/notifications/(:any)'] = 'AdminController/notifications';
$route['adm/editprofile'] = 'AdminController/editProfile';

$route['adm/changeBookChart'] = 'AdminController/changeBookChart';
$route['adm/changeStoreChart'] = 'AdminController/changeStoreChart';
$route['adm/getBooksByGenre'] = 'AdminController/getBooksByGenre';
$route['adm/changeNotifDetail'] = 'AdminController/changeNotifDetail';
$route['adm/changeNotifFlag'] = 'AdminController/changeNotifFlag';
$route['adm/tes'] = 'AdminController/tes';
//route cashier
$route['csh/home'] = 'CashierController/home';
$route['csh/dashboard'] = 'CashierController/dashboard';
$route['csh/buy'] = 'CashierController/buy';
$route['csh/products'] = 'CashierController/products';
$route['csh/products/(:any)'] = 'CashierController/products';
$route['csh/products/(:any)/(:any)'] = 'CashierController/products';
$route['csh/notifications'] = 'CashierController/notifications';
$route['csh/notifications/(:any)'] = 'CashierController/notifications';
$route['csh/tes'] = 'CashierController/tes';
//route manager
$route['mgr/home'] = 'ManagerController/home';
$route['mgr/dashboard'] = 'ManagerController/dashboard';
$route['mgr/products'] = 'ManagerController/products';
$route['mgr/request_products'] = 'ManagerController/request';
$route['mgr/products/(:any)'] = 'ManagerController/products';
$route['mgr/products/(:any)/(:any)'] = 'ManagerController/products';
$route['mgr/notifications'] = 'ManagerController/notifications';
$route['mgr/notifications/(:any)'] = 'ManagerController/notifications';
$route['mgr/changeNotifDetail'] = 'ManagerController/changeNotifDetail';
$route['mgr/changeNotifFlag'] = 'ManagerController/changeNotifFlag';