<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'contacts';

$route['dashboard'] = 'dashboard/index';

$route['logout'] = 'contacts/logout';
$route['login'] = 'contacts/login';

$route['(:num)'] = 'contacts/index/$1';
$route['contacts'] = 'contacts/index';
$route['create'] = 'contacts/create';
$route['deactivate/(:any)'] = 'contacts/deactivate/$1';
$route['reactivate/(:any)'] = 'contacts/reactivate/$1';
$route['delete/(:any)'] = 'contacts/delete/$1';
$route['edit/(:num)'] = 'contacts/edit/$1';
$route['update'] = 'contacts/update';
$route['contact/(:num)'] = 'contacts/show/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
