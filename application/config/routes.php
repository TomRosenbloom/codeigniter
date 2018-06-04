<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'contacts';

$route['dashboard'] = 'dashboard/index';

$route['logout'] = 'auth/logout';
$route['login'] = 'auth/login';

$route['(:num)'] = 'contacts/index/$1';
$route['contacts'] = 'contacts/index';
$route['create'] = 'contacts/create';
$route['confirm_deactivate/(:num)'] = '/contacts/confirm_deactivate/$1';
$route['deactivate/(:any)'] = 'contacts/deactivate/$1';
$route['confirm_reactivate/(:num)'] = '/contacts/confirm_reactivate/$1';
$route['reactivate/(:any)'] = 'contacts/reactivate/$1';
$route['confirm_delete/(:num)'] = '/contacts/confirm_delete/$1';
$route['delete/(:any)'] = 'contacts/delete/$1';
$route['edit/(:num)'] = 'contacts/edit/$1';
$route['contact/(:num)'] = 'contacts/show/$1';


$route['(:num)/(:any)'] = 'contacts/index/$1/$2';
$route['(:any)'] = 'contacts/index/$2';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
