<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/******************** ACP *************************/
$route['acp'] = 'backend/home';
//Auth
$route['acp/login'] = 'backend/auth/login';
$route['acp/logout'] = 'backend/auth/logout';
$route['acp/change_password'] = 'backend/auth/change_password';
$route['acp/deny'] = 'backend/auth/deny';
//User
$route['acp/user'] = 'backend/user';
$route['acp/user/page'] = 'backend/user';
$route['acp/user/page/(:num)'] = 'backend/user';
$route['acp/user/add'] = 'backend/user/add';
$route['acp/user/show/(:num)'] = 'backend/user/show/$1';
$route['acp/user/edit/(:num)'] = 'backend/user/edit/$1';
$route['acp/user/delete/(:num)'] = 'backend/user/delete/$1';
$route['acp/user/search'] = 'backend/user/search';
$route['acp/user/search/page'] = 'backend/user/search';
$route['acp/user/search/page/(:num)'] = 'backend/user/search';

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
