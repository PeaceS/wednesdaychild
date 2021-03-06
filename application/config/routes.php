<?php  if ( ! defined('BASEPATH')) { exit('No direct script access allowed'); }
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['buy'] = 'bag/putInBag';
$route['buy/1'] = 'buy/checkInsideBag/1';
$route['buy/2'] = 'buy/fillInAddress';
$route['buy/3'] = 'buy/checkInsideBag/3';
$route['buy/4'] = 'buy/paymentMethod';
$route['buy/bankwire'] = 'buy/bankwireMethod';
$route['buy/bankwire/confirm'] = 'pay/payment/bankwire';
$route['confirm/send'] = 'confirm/send';
$route['confirm/(:any)'] = 'confirm/update/$1/1';
$route['undo/(:any)'] = 'confirm/update/$1/0';
$route['popup/payment/(:any)'] = 'popup/confirm/$1';
$route['buy/paypal'] = 'pay/payment/paypal';
$route['update/bag'] = 'bag/updateBag';
$route['update/address'] = 'shipping/updateAddress';
$route['collection/(:any)'] = 'collection/view/$1';
$route['shop/(:any)'] = 'shop/view/$1';
$route['product/(:any)'] = 'product/view/$1';
$route['default_controller'] = 'home';
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */