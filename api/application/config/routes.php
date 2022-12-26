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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['list-departamente'      ]   =   "departamente";
$route['get-departament'        ]   =   "departamente/get";
$route['save-departament'       ]   =   "departamente/save";
$route['delete-departamente'    ]   =   "departamente/delete";

$route['list-centre-cost'      ]   = 'centre_cost';
$route['get-centre-cost'       ]   = 'centre_cost/get';
$route['save-centre-cost'      ]   = 'centre_cost/save';
$route['delete-centre-cost'    ]   = 'centre_cost/delete';


$route['list-programe-lucru'   ]= 'programe_lucru';
$route['get-programe-lucru'    ]= 'programe_lucru/get';
$route['save-programe-lucru'   ]= 'programe_lucru/save';
$route['delete-programe-lucru' ]= 'programe_lucru/delete';

$route['list-angajati'   ]= 'Evenimente';
$route['info-angajati'   ]= 'angajati/info'  ;
$route['get-angajati'    ]= 'angajati/get'   ;
$route['save-angajati'   ]= 'angajati/save'  ;
$route['delete-angajati' ]= 'angajati/delete';


$route['list-tipuri-zile-libere'   ]= 'tipuri_zile_libere';
$route['get-tipuri-zile-libere'    ]= 'tipuri_zile_libere/get';
$route['save-tipuri-zile-libere'   ]= 'tipuri_zile_libere/save';
$route['delete-tipuri-zile-libere' ]= 'tipuri_zile_libere/delete';


$route['refresh-info-zile-libere'  ]= 'zile_libere';
$route['info-zile-libere'          ]= 'zile_libere/info';
$route['get-zile-libere'           ]= 'zile_libere/get';
$route['sterge-zile-libere'        ]= 'zile_libere/sterge';
$route['save-zile-libere'          ]= 'zile_libere/save';
$route['adauga-zi-libera-national' ]= 'zile_libere/adauga_zi_libera_nationala';
$route['sterge-zi-libera-national' ]= 'zile_libere/sterge_zi_libera_nationala';

$route['ponteaza'                  ]= 'pontaj/ponteaza';
$route['ping'                      ]= 'pontaj/ping';
$route['sync'                      ]= 'pontaj/sync';
$route['offline'                   ]= 'pontaj/offline';


$route['info-raport-totalizator'                   ] = 'raport_totalizator/info';
$route['get-raport-totalizator'                    ] = 'raport_totalizator/raport';
$route['get-ore-lucrate-angajat'                   ] = 'raport_totalizator/ore_lucrate_angajat';
$route['adauga-manual-pontaj'                      ] = 'raport_totalizator/adauga_manual_pontaj';
$route['sterge-manual-pontaj'                      ] = 'raport_totalizator/sterge_manual_pontaj';
$route['salveaza-observatii-raport-totalizator'    ] = 'raport_totalizator/salveaza_observatii';
$route['excel-raport-totalizator'                  ] = 'raport_totalizator/excel';
$route['modificare-timp-in-dialog'                 ] = 'raport_totalizator/modificare_timp_in_dialog';


$route['cron-raport-totalizator'  ] = 'cron/raport_totalizator';
$route['cron_zi_lucratoare'       ] = 'cron/cron_zi_lucratoare';
$route['cron_pontaj_automat'      ] = 'cron/cron_pontaj_automat';


$route['factura/(:num)'      ] = 'facturi/get_factura/$1';
