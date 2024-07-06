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
$route['default_controller'] = 'Admin';
$route['translate_uri_dashes'] = TRUE;

//Page Status
$route['404_override'] = 'Status/pagenotfound';
$route['coming-soon'] = 'Status/coming-soon';
$route['under-maintenance'] = 'Status/under-maintenance';
$route['get-server-status'] = 'Status/get-server-status';

$route['Admin'] = 'Status/pagenotfound';
$route['Admin/(:any)'] = 'Status/pagenotfound';
$route['Admin/(:any)/(:any)'] = 'Status/pagenotfound';
$route['Admin/(:any)/(:any)/(:any)'] = 'Status/pagenotfound';
$route['Admin/(:any)/(:any)/(:any)/(:any)'] = 'Status/pagenotfound';
$route['Admin/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'Status/pagenotfound';
$route['admin'] = 'Status/pagenotfound';
$route['admin/(:any)'] = 'Status/pagenotfound';
$route['admin/(:any)/(:any)'] = 'Status/pagenotfound';
$route['admin/(:any)/(:any)/(:any)'] = 'Status/pagenotfound';
$route['admin/(:any)/(:any)/(:any)/(:any)'] = 'Status/pagenotfound';
$route['admin/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'Status/pagenotfound';
$route['Status'] = 'Status/pagenotfound';
$route['Status/(:any)'] = 'Status/pagenotfound';
$route['Status/(:any)/(:any)'] = 'Status/pagenotfound';
$route['Status/(:any)/(:any)/(:any)'] = 'Status/pagenotfound';
$route['Status/(:any)/(:any)/(:any)/(:any)'] = 'Status/pagenotfound';
$route['Status/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'Status/pagenotfound';
$route['status'] = 'Status/pagenotfound';
$route['status/(:any)'] = 'Status/pagenotfound';
$route['status/(:any)/(:any)'] = 'Status/pagenotfound';
$route['status/(:any)/(:any)/(:any)'] = 'Status/pagenotfound';
$route['status/(:any)/(:any)/(:any)/(:any)'] = 'Status/pagenotfound';
$route['status/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'Status/pagenotfound';

//Admin Authentication
$route['ad-gettime'] = 'Admin/gettime';
$route['ad-auth'] = 'Admin';
$route['ad-auth-login'] = 'Admin/login';
$route['ad-auth-recovery'] = 'Admin/recovery';
$route['ad-auth-recovery-form'] = 'Admin/recovery-form';
$route['ad-auth-send'] = 'Admin/send/$1';
$route['ad-auth-verify-form'] = 'Admin/verify-form';
$route['ad-auth-reset-password-form'] = 'Admin/reset-password-form';
$route['ad-auth-set-lock'] = 'Admin/set-lock';
$route['ad-auth-unlock'] = 'Admin/unlock';
$route['ad-auth-logout'] = 'Admin/logout';
$route['ad-auth-unlock-form'] = 'Admin/unlock-form';
$route['ad-profile'] = 'Admin/profile';
$route['ad-profile-form'] = 'Admin/profile-form';
$route['ad-password-form'] = 'Admin/password-form';

//Website Settings
$route['ad-website-settings'] = 'Admin/website-settings';
$route['ad-website-form-page'] = 'Admin/website-form-page';
$route['ad-editor-image'] = 'Admin/editor-image';
$route['ad-meta-info-form'] = 'Admin/meta-info-form';
$route['ad-invoice-info-form'] = 'Admin/invoice-info-form';
$route['ad-general-setting-form'] = 'Admin/general-setting-form';
$route['ad-plugin-script-form'] = 'Admin/plugin-script-form';

//Email Accounts
$route['ad-email-account-form'] = 'Admin/email-account-form';
$route['ad-delete-email-account'] = 'Admin/delete-email-account';
$route['ad-change-email-account-status'] = 'Admin/change-email-account-status';

//Dashboard
$route['ad-dashboard'] = 'Admin/dashboard';

//User Management
//Admin Users
$route['ad-admin-users'] = 'Admin/admin-users';
$route['ad-get-admin-user-lists'] = 'Admin/get-admin-user-lists';
$route['ad-admin-user-form'] = 'Admin/admin-user-form';
$route['ad-admin-user-form-data'] = 'Admin/admin-user-form-data';
$route['ad-delete-admin-user'] = 'Admin/delete-admin-user';
$route['ad-change-admin-user-status'] = 'Admin/change-admin-user-status';

//Students
$route['ad-students'] = 'Admin/students';
$route['ad-get-student-lists'] = 'Admin/get-student-lists';
$route['ad-student-form'] = 'Admin/student-form';
$route['ad-student-form-data'] = 'Admin/student-form-data';
$route['ad-delete-student'] = 'Admin/delete-student';
//Session List
$route['my-session'] = 'Site/my-session';
