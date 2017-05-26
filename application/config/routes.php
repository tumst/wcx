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
  | example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  | https://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There are three reserved routes:
  |
  | $route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  | $route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router which controller/method to use if those
  | provided in the URL cannot be matched to a valid route.
  |
  | $route['translate_uri_dashes'] = FALSE;
  |
  | This is not exactly a route, but allows you to automatically route
  | controller and method names that contain dashes. '-' isn't a valid
  | class or method name character, so it requires translation.
  | When you set this option to TRUE, it will replace ALL dashes in the
  | controller and method URI segments.
  |
  | Examples: my-controller/index -> my_controller/index
  |   my-controller/my-method -> my_controller/my_method
 */
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

/*
  | -------------------------------------------------------------------------
  | Sample REST API Routes
  | -------------------------------------------------------------------------
 */
$route['api/example/users/(:num)'] = 'api/example/users/id/$1'; // Example 4
$route['api/example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/example/users/id/$1/format/$3$4'; // Example 8


//for api_inventory_packaging
$route['invent_pkg'] = 'api/api_inventory_packaging/inv_stocks'; //insert pkg inventory stock //all
$route['invent_pkg/(:num)']['POST'] = 'api/api_inventory_packaging/inv_stock/$1';
$route['invent_pkg/(:num)']['put'] = 'api/api_inventory_packaging/inv_stock/$1';

$route['stp/test'] = 'test/c_stp/test_stp';
//$route['stp/graph.json'] = 'test/graph.json';

//for api_lotqueue
$route['lots'] = 'api/api_lotqueue/lots';   //all
//$route['lots/id/([a-zA-Z0-9_-]+)(.*)']= 'api/api_lotqueue/lots/id/$1';
//$route['lots/wgid/([a-zA-Z0-9_-]+)(.*)']= 'api/api_lotqueue/lots/wgid/$1';
$route['lot']['POST'] = 'api/api_lotqueue/lot';
$route['wgs/(:num)'] = 'api/api_lotqueue/wgs/id/$1';


//for api_lotqueue_fin
$route['lots-fin'] = 'api/api_lotqueuefin/';    //all




