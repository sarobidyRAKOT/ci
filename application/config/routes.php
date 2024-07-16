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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'welcome/index';

$route['inserstion_client'] = 'CTRL_login/insert_client';
$route['connect_client'] = 'CTRL_login/connect_client';
$route['connect_admin'] = 'CTRL_login/connect_admin';
$route['acceuil_client'] = 'CTRL_login/load_acceuil';
$route['acceuil_admin'] = 'CTRL_login/load_acceuil_admin';


$route['se_connecter'] = 'welcome/se_connecter';
$route['se_connecter_admin'] = 'welcome/se_connecter_admin';

$route['devise'] = 'CTRL_devise/devise';
$route['format_pdf'] = 'CTRL_devise/generate_pdf';

$route['prendre_rdv'] = 'CTRL_rdv/prendre_rdv';

$route['ajouter_service'] = 'CTRL_service/ajouter_service';
$route['page_ajouter_service'] = 'CTRL_service/page_ajouter_service';
$route['modifier_service'] = 'CTRL_service/modifier_service';
$route['supprimer_service'] = 'CTRL_service/supprimer_service';
$route['validation_modification'] = 'CTRL_service/validation_modification';


$route['import_export'] = 'CTRL_import_export/import_export';
$route['supprimer'] = 'CTRL_supprimer/page_sup';
$route['config_date'] = 'CTRL_configDate/page_configRef';
$route['insert_ref'] = 'CTRL_configDate/insert_ref';
$route['dashboard'] = 'CTRL_dashboard/page_dashboard';

$route['utilisation_slot'] = 'CTRL_utilisation_slot/page_utilisation_slot';
$route['vers_filtre_slot'] = 'CTRL_utilisation_slot/vers_filtre_slot';


$route['deconnecter'] = 'CTRL_deconnection/deconnecter';


$route['pdf/genarate'] = 'PdfController/generatePdf';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
