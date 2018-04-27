<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'main';

$route['users/activate/(:any)'] = 'users/activate/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
