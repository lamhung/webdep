<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/******************** ACP *************************/
$route['acp'] = 'backend/home';

//User
$route['acp/user'] = 'backend/user';
$route['acp/user/add'] = 'backend/user/add';
$route['acp/user/show/(:num)'] = 'backend/user/show/$1';



$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
