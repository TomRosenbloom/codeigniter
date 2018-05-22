<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'contacts';

$route['create'] = 'contacts/create';
$route['delete/(:any)'] = 'contacts/delete/$1';
$route['edit/(:any)'] = 'contacts/edit/$1';
$route['update'] = 'contacts/update';
$route['contact/(:any)'] = 'contacts/show/$1';
$route['contacts'] = 'contacts/index';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
