<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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

$route['default_controller'] = 'home';
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */

///Admin

$route['admin/contact/:any']='admin_post';
$route['admin/contact']='admin_post';

$route['admin/press/:any']='admin_press';
$route['admin/press']='admin_press';

$route['admin/customer/:any']='admin_customer';
$route['admin/customer']='admin_customer';


$route['admin/introduction/:any']='admin_post';
$route['admin/introduction']='admin_post';

$route['admin/footer/:any']='admin_post';
$route['admin/footer']='admin_post';

$route['admin/footer-ha-noi/:any']='admin_post';
$route['admin/footer-ha-noi']='admin_post';

$route['admin/footer-tp-hcm/:any']='admin_post';
$route['admin/footer-tp-hcm']='admin_post';


$route['admin/huong-dan-thanh-toan/:any']='admin_post';
$route['admin/huong-dan-thanh-toan']='admin_post';

$route['admin/thong-tin-chuyen-khoan/:any']='admin_post';
$route['admin/thong-tin-chuyen-khoan']='admin_post';

$route['admin/huong-dan-dat-ve/:any']='admin_post';
$route['admin/huong-dan-dat-ve']='admin_post';

$route['admin/country/:any']='admin_country';
$route['admin/country']='admin_country';

$route['admin/airport/:any']='admin_airport';
$route['admin/airport']='admin_airport';

$route['admin/airlines']='admin_airlines';
$route['admin/airlines/:any']='admin_airlines';

$route['admin/schedule']='admin_schedule';
$route['admin/schedule/:any']='admin_schedule';

$route['admin/search']='admin_search';
$route['admin/search/:any']='admin_search';

$route['admin/book']='admin_book';
$route['admin/book/:any']='admin_book';

$route['admin/recruitment']='admin_recruitment';
$route['admin/recruitment/:any']='admin_recruitment';

$route['admin/news']='admin_news';
$route['admin/news/:any']='admin_news';

$route['admin/ask']='admin_ask';
$route['admin/ask/:any']='admin_ask';


$route['admin/advice']='admin_advice';
$route['admin/advice/:any']='admin_advice';

$route['tim-kiem']='home_search';
$route['tim-kiem/:any']='home_search';


$route['thong-tin-don-hang']='home_orders';
$route['thong-tin-don-hang/:any']='home_orders';

$route['ve-noi-dia']='home_domestic';
$route['ve-noi-dia/:any']='home_domestic';

$route['ve-quoc-te']='home_international';
$route['ve-quoc-te/:any']='home_international';

$route['ve-may-bay-theo-hang']='home_firm';
$route['ve-may-bay-theo-hang/:any']='home_firm';

$route['trang-tu-van']='home_advice';
$route['trang-tu-van/:any']='home_advice';

$route['khach-hang-noi-ve-chung-toi']='home_customer';
$route['khach-hang-noi-ve-chung-toi/:any']='home_customer';

$route['khach-hang-noi-ve-chung-toi']='home_customer';
$route['khach-hang-noi-ve-chung-toi/:any']='home_customer';

$route['bao-chi-noi-ve-chung-toi']='home_press';
$route['bao-chi-noi-ve-chung-toi/:any']='home_press';

$route['lien-he']='home_contact';
$route['lien-he/:any']='home_contact';

$route['tuyen-dung']='home_recruitment';
$route['tuyen-dung/:any']='home_recruitment';

$route['thanh-toan']='home_payment';
$route['thanh-toan/:any']='home_payment';

$route['xem-don-hang']='home_orders_view';
$route['xem-don-hang/:any']='home_orders_view';

$route['gioi-thieu']='home_introduction';
$route['gioi-thieu/:any']='home_introduction';

$route['thong-tin-chuyen-khoan']='home_transfer';
$route['thong-tin-chuyen-khoan/:any']='home_transfer';

$route['huong-dan-dat-ve']='home_guide';
$route['huong-dan-dat-ve/:any']='home_guide';

$route['cau-hoi-thuong-gap']='home_ask';
$route['cau-hoi-thuong-gap/:any']='home_ask';

$route['tin-tuc']='home_news';
$route['tin-tuc/:any']='home_news';