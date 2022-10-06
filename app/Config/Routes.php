<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// filter auth
$routes->get('/', 'Auth::admin');
$routes->get('/about-us', 'Welcome::about_us');
$routes->get('/visi-misi', 'Welcome::visi_misi');
$routes->get('/login', 'Auth::index');
$routes->get('/login-admin', 'Auth::admin');
$routes->get('/register', 'Auth::register');
$routes->get('/forgot', 'Auth::forgot_password');

// filter dashboard
$routes->get('/dashboard', 'Dashboard::index',['filter' => 'auth']);
// $routes->get('/dashboard/seller', 'Dashboard::seller',['filter' => 'auth']);
// $routes->get('/dashboard/monthly', 'Dashboard::monthly',['filter' => 'auth']);

$routes->get('/dashboard_seller', 'Dashboard_seller::index',['filter' => 'auth']);
$routes->get('/dashboard_monthly', 'Dashboard_monthly::index',['filter' => 'auth']);

//-------------- start of masters filter

// fileter master level
$routes->get('/level', 'Level::index',['filter' => 'auth']);
$routes->get('/level/add', 'Level::add',['filter' => 'auth']);
$routes->get('/level/create', 'Level::create',['filter' => 'auth']);
$routes->get('/level/edit', 'Level::edit',['filter' => 'auth']);
$routes->get('/level/update', 'Level::update',['filter' => 'auth']);

// filter master owner (seller)
$routes->get('/owners', 'Owners::index',['filter' => 'auth']);
$routes->get('/owners/add', 'Owners::add',['filter' => 'auth']);
$routes->get('/owners/create', 'Owners::create',['filter' => 'auth']);
$routes->get('/owners/edit', 'Owners::edit',['filter' => 'auth']);
$routes->get('/owners/update', 'Owners::update',['filter' => 'auth']);

$routes->get('/owners/editSeller', 'Owners::editSeller',['filter' => 'auth']);
$routes->get('/owners/updateSeller', 'Owners::updateSeller',['filter' => 'auth']);

$routes->get('/owners/add_marketplace', 'Owners::add_marketplace',['filter' => 'auth']);
$routes->get('/owners/create_marketplace', 'Owners::create_marketplace',['filter' => 'auth']);
$routes->get('/owners/edit_marketplace', 'Owners::edit_marketplace',['filter' => 'auth']);
$routes->get('/owners/update_marketplace', 'Owners::update_marketplace',['filter' => 'auth']);

// filter master customer (penerima)
$routes->get('/customer', 'Customer::index',['filter' => 'auth']);
$routes->get('/customer/add', 'Customer::add',['filter' => 'auth']);
$routes->get('/customer/edit', 'Customer::edit',['filter' => 'auth']);

// fileter master material
$routes->get('/material', 'Material::index',['filter' => 'auth']);
$routes->get('/material/add', 'Material::add',['filter' => 'auth']);
$routes->get('/material/bulk_add', 'Material::bulk_add',['filter' => 'auth']);
$routes->get('/material/create', 'Material::create',['filter' => 'auth']);
$routes->get('/material/edit', 'Material::edit',['filter' => 'auth']);
$routes->get('/material/update', 'Material::update',['filter' => 'auth']);

// filter material size
$routes->get('/materialsize', 'Materialsize::index',['filter' => 'auth']);
$routes->get('/materialsize/edit', 'Materialsize::edit',['filter' => 'auth']);
$routes->get('/materialsize/update', 'Materialsize::update',['filter' => 'auth']);

// fileter master material group
$routes->get('/materialgroup', 'Materialgroup::index',['filter' => 'auth']);
$routes->get('/materialgroup/add', 'Materialgroup::add',['filter' => 'auth']);
$routes->get('/materialgroup/create', 'Materialgroup::create',['filter' => 'auth']);
$routes->get('/materialgroup/edit', 'Materialgroup::edit',['filter' => 'auth']);
$routes->get('/materialgroup/update', 'Materialgroup::update',['filter' => 'auth']);

// filter master Uom
$routes->get('/uom', 'Uom::index',['filter' => 'auth']);
$routes->get('/uom/add', 'Uom::add',['filter' => 'auth']);
$routes->get('/uom/create', 'Uom::create',['filter' => 'auth']);
$routes->get('/uom/edit', 'Uom::edit',['filter' => 'auth']);
$routes->get('/uom/update', 'Uom::update',['filter' => 'auth']);

// fileter master material uom
$routes->get('/materialuom', 'MaterialUom::index',['filter' => 'auth']);
$routes->get('/materialuom/add', 'MaterialUom::add',['filter' => 'auth']);
$routes->get('/materialuom/create', 'MaterialUom::create',['filter' => 'auth']);
$routes->get('/materialuom/edit', 'MaterialUom::edit',['filter' => 'auth']);
$routes->get('/materialuom/update', 'MaterialUom::update',['filter' => 'auth']);

// filter master supplier
$routes->get('/supplier', 'Supplier::index',['filter' => 'auth']);
$routes->get('/supplier/add', 'Supplier::add',['filter' => 'auth']);
$routes->get('/supplier/create', 'Supplier::create',['filter' => 'auth']);
$routes->get('/supplier/edit', 'Supplier::edit',['filter' => 'auth']);
$routes->get('/supplier/update', 'Supplier::update',['filter' => 'auth']);

// filter master warehouse
$routes->get('/warehouse', 'Warehouse::index',['filter' => 'auth']);
$routes->get('/warehouse/add', 'Warehouse::add',['filter' => 'auth']);
$routes->get('/warehouse/create', 'Warehouse::create',['filter' => 'auth']);
$routes->get('/warehouse/edit', 'Warehouse::edit',['filter' => 'auth']);
$routes->get('/warehouse/update', 'Warehouse::update',['filter' => 'auth']);

// filter master wh area
$routes->get('/wharea', 'Wharea::index',['filter' => 'auth']);
$routes->get('/wharea/add', 'Wharea::add',['filter' => 'auth']);
$routes->get('/wharea/create', 'Wharea::create',['filter' => 'auth']);
$routes->get('/wharea/edit', 'Wharea::edit',['filter' => 'auth']);
$routes->get('/wharea/update', 'Wharea::update',['filter' => 'auth']);

// filter master blok
$routes->get('/blok', 'Blok::index',['filter' => 'auth']);
$routes->get('/blok/add', 'Blok::add',['filter' => 'auth']);
$routes->get('/blok/edit', 'Blok::edit',['filter' => 'auth']);

// filter master rak
$routes->get('/rak', 'Rak::index',['filter' => 'auth']);
$routes->get('/rak/add', 'Rak::add',['filter' => 'auth']);
$routes->get('/rak/create', 'Rak::create',['filter' => 'auth']);
$routes->get('/rak/edit', 'Rak::edit',['filter' => 'auth']);
$routes->get('/rak/update', 'Rak::update',['filter' => 'auth']);

// filter master shelf 
$routes->get('/shelf', 'Shelf::index',['filter' => 'auth']);
$routes->get('/shelf/add', 'Shelf::add',['filter' => 'auth']);
$routes->get('/shelf/create', 'Shelf::create',['filter' => 'auth']);
$routes->get('/shelf/edit', 'Shelf::edit',['filter' => 'auth']);
$routes->get('/shelf/update', 'Shelf::update',['filter' => 'auth']);

//------------ end of masters filter

// filter PO
$routes->get('/purchaseorder', 'Purchaseorder::index',['filter' => 'auth']);
$routes->get('/purchaseorder/add', 'Purchaseorder::add',['filter' => 'auth']);
$routes->get('/purchaseorder/create', 'Purchaseorder::create',['filter' => 'auth']);
$routes->get('/purchaseorder/bulk_upload', 'Purchaseorder::bulk_upload',['filter' => 'auth']);
$routes->get('/purchaseorder/bulk_create', 'Purchaseorder::bulk_create',['filter' => 'auth']);

// filter inbound
$routes->get('/inbound', 'Inbound::index',['filter' => 'auth']);
$routes->get('/inbound/add', 'Inbound::add',['filter' => 'auth']);
$routes->get('/inbound/add_ver2', 'Inbound::add_ver2',['filter' => 'auth']);
$routes->get('/inbound/create', 'Inbound::create',['filter' => 'auth']);
$routes->get('/inboundhistory', 'Inboundhistory::index',['filter' => 'auth']);
$routes->get('/inboundrealization', 'Inboundrealization::index',['filter' => 'auth']);

// filter realisasi inbound
$routes->get('/realization', 'Realization::index',['filter' => 'auth']);
$routes->get('/realization/add', 'Realization::add',['filter' => 'auth']);
$routes->get('/realization/create', 'Realization::create',['filter' => 'auth']);

// filter lokasi
$routes->get('/location', 'Location::index',['filter' => 'auth']);
$routes->get('/location/add', 'Location::add',['filter' => 'auth']);
$routes->get('/location/create', 'Location::create',['filter' => 'auth']);
// $routes->get('/location/view_location', 'Location::view_location',['filter' => 'auth']);
$routes->get('/location_view', 'Location_view::index',['filter' => 'auth']);

// filter outbound
$routes->get('/outbound', 'Outbound::index',['filter' => 'auth']);
$routes->get('/outbound/add', 'Outbound::add',['filter' => 'auth']);
$routes->get('/outbound/add_ver2', 'Outbound::add',['filter' => 'auth']);
$routes->get('/outbound/create', 'Outbound::create',['filter' => 'auth']);

// filter realisasi outbound
$routes->get('/out_realization', 'Out_realization::index',['filter' => 'auth']);
$routes->get('/out_realization/add', 'Out_realization::add',['filter' => 'auth']);
$routes->get('/out_realization/create', 'Out_realization::create',['filter' => 'auth']);

// filter outbound do
$routes->get('/outbounddo', 'Outbounddo::index',['filter' => 'auth']);
$routes->get('/outbounddo/add', 'Outbounddo::add',['filter' => 'auth']);
$routes->get('/outbounddo/create', 'Outbounddo::create',['filter' => 'auth']);

// filter outbound po
$routes->get('/outboundhistory', 'Outboundhistory::index',['filter' => 'auth']);

// filter outbound po
$routes->get('/outboundpo', 'Outboundpo::index',['filter' => 'auth']);
$routes->get('/outboundpo/add', 'Outboundpo::add',['filter' => 'auth']);
$routes->get('/outboundpo/create', 'Outboundpo::create',['filter' => 'auth']);
$routes->get('/outboundpo/invoice', 'Outboundpo::invoice',['filter' => 'auth']);
$routes->get('/outboundpo/accept_invoice', 'Outboundpo::accept_invoice',['filter' => 'auth']);
$routes->get('/outboundpo/reject_invoice', 'Outboundpo::reject_invoice',['filter' => 'auth']);
$routes->get('/outboundpo/finish_po', 'Outboundpo::finish_po',['filter' => 'auth']);
$routes->get('/outboundpo/detail', 'Outboundpo::detail',['filter' => 'auth']);
$routes->get('/outboundpo/delete', 'Outboundpo::delete',['filter' => 'auth']);
$routes->get('/outboundpo/bulk_upload', 'Outboundpo::bulk_upload',['filter' => 'auth']);
$routes->get('/outboundpo/bulk_create', 'Outboundpo::bulk_create',['filter' => 'auth']);

//filter users
$routes->get('/users', 'Users::index',['filter' => 'auth']);
$routes->get('/users/add', 'Users::add',['filter' => 'auth']);
$routes->get('/users/edit', 'Users::edit',['filter' => 'auth']);

//filter menu
$routes->get('/menu', 'Menu::index',['filter' => 'auth']);
$routes->get('/menu/edit', 'Menu::edit',['filter' => 'auth']);
$routes->get('/menu/add', 'Menu::add',['filter' => 'auth']);

//filter users
$routes->get('/submenu', 'SubMenu::index',['filter' => 'auth']);
$routes->get('/submenu/edit', 'SubMenu::edit',['filter' => 'auth']);
$routes->get('/submenu/add', 'SubMenu::add',['filter' => 'auth']);

//filter privilege
$routes->get('/privilege', 'Privilege::index',['filter' => 'auth']);
$routes->get('/privilege/edit', 'Privilege::edit',['filter' => 'auth']);

//filter reportin
$routes->get('/reportin', 'Reportin::index',['filter' => 'auth']);

//filter reportout
$routes->get('/reportout', 'Reportout::index',['filter' => 'auth']);

// filter bill
$routes->get('/bill', 'Bill::index',['filter' => 'auth']);
$routes->get('/bill/edit', 'Bill::edit',['filter' => 'auth']);

// filter bill
$routes->get('/topup', 'Topup::index',['filter' => 'auth']);
$routes->get('/topup/add', 'Topup::add',['filter' => 'auth']);
$routes->get('/topup/approve', 'Topup::approve',['filter' => 'auth']);
$routes->get('/topup/reject', 'Topup::reject',['filter' => 'auth']);

// filter audit product
$routes->get('/materialapproval', 'Materialapproval::index',['filter' => 'auth']);
$routes->get('/materialapproval/detail', 'Materialapproval::detail',['filter' => 'auth']);
$routes->get('/materialapproval/approve', 'Materialapproval::approve',['filter' => 'auth']);
$routes->get('/materialapproval/reject', 'Materialapproval::reject',['filter' => 'auth']);

// filter soh total
$routes->get('/Soh_total', 'Soh_total::index',['filter' => 'auth']);

//special-agreement
$routes->get('/owners/add_agreement', 'Owners::add_agreement',['filter' => 'auth']);
$routes->get('/owners/insert_agreement', 'Owners::insert_agreement',['filter' => 'auth']);
$routes->get('/owners/edit_agreement', 'Owners::edit_agreement',['filter' => 'auth']);
$routes->get('/owners/update_agreement', 'Owners::update_agreement',['filter' => 'auth']);

// filter soh owner
$routes->get('/soh_owner', 'Soh_owner::index',['filter' => 'auth']);

// filter Master jenis
$routes->get('/jenis', 'Jenis::index',['filter' => 'auth']);

// filter user access
$routes->get('/userhris', 'Userhris::index',['filter' => 'auth']);
/*
* --------------------------------------------------------------------
* Additional Routing
* --------------------------------------------------------------------
*
* There will often be times that you need additional routing and you
* need it to be able to override any defaults in this file. Environment
* based routes is one such time. require() additional route files here
* to make that happen.
*
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}