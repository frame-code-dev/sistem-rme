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
// routes 
// default login 
$route['default_controller'] = 'auth/login';
$route['login'] = 'auth/login';
$route['logout'] = 'auth/logout';
// dashboard 
$route['dashboard'] = 'dashboard';
// user 
$route['user'] = 'user/index';
$route['user/create'] = 'user/create';
$route['user/store'] = 'user/store';
$route['user/edit/(:any)'] = 'user/edit/$1';
$route['user/update/(:any)'] = 'user/update/$1';
$route['user/delete/(:any)'] = 'user/delete/$1';
// profile 
$route['profile/(:any)'] = 'profile/index/$1';
$route['profile/update/(:any)'] = 'profile/update/$1';
// obat 
$route['obat'] = 'obat/index';
$route['obat/create'] = 'obat/create';
$route['obat/store'] = 'obat/store';
$route['obat/edit/(:any)'] = 'obat/edit/$1';
$route['obat/update/(:any)'] = 'obat/update/$1';
$route['obat/delete/(:any)'] = 'obat/delete/$1';
$route['obat/edit-stok/(:any)'] = 'obat/editStok/$1';
$route['obat/update-stok/(:any)'] = 'obat/updateStok/$1';

//Pasien 
$route['pasien'] = 'pasien/index';
$route['pasien/create'] = 'pasien/create';
$route['pasien/store'] = 'pasien/store';
$route['pasien/edit/(:any)'] = 'pasien/edit/$1';
$route['pasien/update/(:any)'] = 'pasien/update/$1';
$route['pasienlist'] = 'pasien/list';
// Nomor Antrian 
$route['nomor_antrian'] = 'nomor_antrian/index';
$route['nomor_antrian/daftar-pasien-lama/(:any)'] = 'nomor_antrian/daftar_pasien_lama/$1';
$route['nomor_antrian/updateno/(:any)'] = 'nomor_antrian/updateNo/$1';

// Pemeriksaan
$route['pemeriksaan'] = 'pemeriksaan/index';
$route['pemeriksaan/list'] = 'pemeriksaan/list';
$route['pemeriksaan/create/(:any)'] = 'pemeriksaan/create/$1';
$route['pemeriksaan/store'] = 'pemeriksaan/store';

// Rekam Medis 
$route['rekam-medis'] = 'rekammedis/index';
$route['rekam-medis/create/(:any)'] = 'rekammedis/create/$1';
$route['rekam-medis/data-obat'] = 'rekammedis/dataobat';
$route['rekam-medis/store/(:any)'] = 'rekammedis/store/$1';
$route['rekam-medis/history/(:any)'] = 'rekammedis/history/$1';
$route['rekam-medis/riwayat-pemeriksaan/(:any)'] = 'rekammedis/riwayat_pemeriksaan/$1';
$route['rekam-medis/cetak-pemeriksaan/(:any)'] = 'rekammedis/cetak_pemeriksaan/$1';

// Apotek
$route['apotek'] = 'apotek/index';
$route['apotek/detail/(:any)'] = 'apotek/detail/$1';
$route['apotek/create/(:any)'] = 'apotek/create/$1';
$route['apotek/store'] = 'apotek/store';

// Laporan
// Laporan - Kunjungan 
$route['laporan/kunjungan'] = 'laporan/kunjungan';
$route['laporan/kunjungan/pdf'] = 'laporan/pdf';
$route['laporan/kunjungan/excel'] = 'laporan/excel';
// Laporan - Penyakit
$route['laporan/penyakit'] = 'laporan/laporanPenyakit';
$route['laporan/penyakit/pdf'] = 'laporan/penyakitPDF';
$route['laporan/penyakit/excel'] = 'laporan/penyakitExcel';
// Laporan - Obat
$route['laporan/obat'] = 'laporan/laporanObat';
$route['laporan/obat/pdf'] = 'laporan/laporanObatPDF';
$route['laporan/obat/excel'] = 'laporan/laporanObatExcel';
// Laporan - Kesakitan
$route['laporan/kesakitan'] = 'laporan/laporanKesakitan';
$route['laporan/kesakitan/pdf'] = 'laporan/laporanKesakitanPDF';
$route['laporan/kesakitan/excel'] = 'laporan/laporanKesakitanExcel';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
