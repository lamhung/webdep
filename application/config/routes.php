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

//Banner
$route['acp/banner'] = 'backend/banner';
$route['acp/banner/page'] = 'backend/banner';
$route['acp/banner/page/(:num)'] = 'backend/banner';
$route['acp/banner/add'] = 'backend/banner/add';
$route['acp/banner/show/(:num)'] = 'backend/banner/show/$1';
$route['acp/banner/edit/(:num)'] = 'backend/banner/edit/$1';
$route['acp/banner/delete/(:num)'] = 'backend/banner/delete/$1';
$route['acp/banner/search'] = 'backend/banner/search';
$route['acp/banner/search/page'] = 'backend/banner/search';
$route['acp/banner/search/page/(:num)'] = 'backend/banner/search';

//News
$route['acp/get_news'] = 'backend/get_news';
$route['acp/get_news/add'] = 'backend/get_news/add';
$route['acp/news'] = 'backend/news';
$route['acp/news/page'] = 'backend/news';
$route['acp/news/page/(:num)'] = 'backend/news';
$route['acp/news/add'] = 'backend/news/add';
$route['acp/news/show/(:num)'] = 'backend/news/show/$1';
$route['acp/news/edit/(:num)'] = 'backend/news/edit/$1';
$route['acp/news/delete/(:num)'] = 'backend/news/delete/$1';
$route['acp/news/search'] = 'backend/news/search';
$route['acp/news/search/page'] = 'backend/news/search';
$route['acp/news/search/page/(:num)'] = 'backend/news/search';

//News
$route['acp/get_news'] = 'backend/get_news';
$route['acp/get_news/add'] = 'backend/get_news/add';
$route['acp/news'] = 'backend/news';
$route['acp/news/page'] = 'backend/news';
$route['acp/news/page/(:num)'] = 'backend/news';
$route['acp/news/add'] = 'backend/news/add';
$route['acp/news/show/(:num)'] = 'backend/news/show/$1';
$route['acp/news/edit/(:num)'] = 'backend/news/edit/$1';
$route['acp/news/delete/(:num)'] = 'backend/news/delete/$1';
$route['acp/news/search'] = 'backend/news/search';
$route['acp/news/search/page'] = 'backend/news/search';
$route['acp/news/search/page/(:num)'] = 'backend/news/search';

//Category_group
$route['acp/category_group'] = 'backend/category_group';
$route['acp/category_group/page'] = 'backend/category_group';
$route['acp/category_group/page/(:num)'] = 'backend/category_group';
$route['acp/category_group/add'] = 'backend/category_group/add';
$route['acp/category_group/show/(:num)'] = 'backend/category_group/show/$1';
$route['acp/category_group/edit/(:num)'] = 'backend/category_group/edit/$1';
$route['acp/category_group/delete/(:num)'] = 'backend/category_group/delete/$1';
$route['acp/category_group/search'] = 'backend/category_group/search';
$route['acp/category_group/search/page'] = 'backend/category_group/search';
$route['acp/category_group/search/page/(:num)'] = 'backend/category_group/search';

//Category
$route['acp/category'] = 'backend/category';
$route['acp/category/page'] = 'backend/category';
$route['acp/category/page/(:num)'] = 'backend/category';
$route['acp/category/add'] = 'backend/category/add';
$route['acp/category/show/(:num)'] = 'backend/category/show/$1';
$route['acp/category/edit/(:num)'] = 'backend/category/edit/$1';
$route['acp/category/delete/(:num)'] = 'backend/category/delete/$1';
$route['acp/category/search'] = 'backend/category/search';
$route['acp/category/search/page'] = 'backend/category/search';
$route['acp/category/search/page/(:num)'] = 'backend/category/search';

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
