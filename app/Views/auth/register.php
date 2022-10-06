
<!DOCTYPE html>
<!--
Template Name: Metronic - Bootstrap 4 HTML, React, Angular 11 & VueJS Admin Dashboard Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: https://1.envato.market/EA4JP
Renew Support: https://1.envato.market/EA4JP
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">
	<!--begin::Head-->
	<head><base href="../../../../">
		<meta charset="utf-8" />
		<title><?= $title ?></title>
		<meta name="description" content="Singin page example" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="canonical" href="https://keenthemes.com/metronic" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Custom Styles(used by this page)-->
		<link href="<?= base_url(); ?>/theme/dist/assets/css/pages/login/login-3.css" rel="stylesheet" type="text/css" />
		<!--end::Page Custom Styles-->
		<!--begin::Global Theme Styles(used by all pages)-->
		<link href="<?= base_url(); ?>/theme/dist/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url(); ?>/theme/dist/assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url(); ?>/theme/dist/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->
		<!--begin::Layout Themes(used by all pages)-->
		<link href="<?= base_url(); ?>/theme/dist/assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url(); ?>/theme/dist/assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url(); ?>/theme/dist/assets/css/themes/layout/brand/dark.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url(); ?>/theme/dist/assets/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css" />
		<!--end::Layout Themes-->
		<link rel="shortcut icon" href="<?= base_url(); ?>/logo/stori.ico" />
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Login-->
			<div class="login login-3 wizard d-flex flex-column flex-lg-row flex-column-fluid wizard" id="kt_login">
				<!--begin::Aside-->
				<div class="login-aside d-flex flex-column flex-row-auto">
					<!--begin::Aside Top-->
					<div class="d-flex flex-column-auto flex-column pt-15 px-30">
						<!--begin::Aside header-->
						<!-- <a href="#" class="login-logo py-6">
							<img src="<?= base_url(); ?>/theme/dist/assets/media/logos/logo-1.png" class="max-h-70px" alt="" />
						</a> -->
						<!--end::Aside header-->
						<!--begin: Wizard Nav-->
						<div class="wizard-nav pt-5 pt-lg-15">
							<!--begin::Wizard Steps-->
							<div class="wizard-steps">
								<!--begin::Wizard Step 1 Nav-->
								<div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
									<div class="wizard-wrapper">
										<div class="wizard-icon">
											<i class="wizard-check ki ki-check"></i>
											<span class="wizard-number">1</span>
										</div>
										<div class="wizard-label">
											<h3 class="wizard-title">Store Details</h3>
											<div class="wizard-desc">Setup Your Store Details</div>
										</div>
									</div>
								</div>
								<!--end::Wizard Step 1 Nav-->
								<!--begin::Wizard Step 2 Nav-->
								<div class="wizard-step" data-wizard-type="step">
									<div class="wizard-wrapper">
										<div class="wizard-icon">
											<i class="wizard-check ki ki-check"></i>
											<span class="wizard-number">2</span>
										</div>
										<div class="wizard-label">
											<h3 class="wizard-title">Owner Details</h3>
											<div class="wizard-desc">Setup Your Owner Details</div>
										</div>
									</div>
								</div>
								<!--end::Wizard Step 2 Nav-->
								<!--begin::Wizard Step 4 Nav-->
								<div class="wizard-step" data-wizard-type="step">
									<div class="wizard-wrapper">
										<div class="wizard-icon">
											<i class="wizard-check ki ki-check"></i>
											<span class="wizard-number">3</span>
										</div>
										<div class="wizard-label">
											<h3 class="wizard-title">Completed!</h3>
											<div class="wizard-desc">Review and Submit</div>
										</div>
									</div>
								</div>
								<!--end::Wizard Step 4 Nav-->
							</div>
							<!--end::Wizard Steps-->
						</div>
						<!--end: Wizard Nav-->
					</div>
					<!--end::Aside Top-->
					<!--begin::Aside Bottom-->
					<div class="aside-img-wizard d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center pt-1 pt-lg-3" style="background-position-y: calc(60%); background-image: url(<?= base_url(); ?>/theme/dist/assets/media/svg/illustrations/register.svg)"></div>
					<!--end::Aside Bottom-->
				</div>
				<!--begin::Aside-->
				<!--begin::Content-->
				<div class="login-content flex-column-fluid d-flex flex-column p-10">
					<!--begin::Top-->
					<!-- <div class="text-right d-flex justify-content-center">
						<div class="top-signup text-right d-flex justify-content-end pt-5 pb-lg-0 pb-10">
							<span class="font-weight-bold text-muted font-size-h4">Having issues?</span>
							<a href="javascript:;" class="font-weight-bolder text-primary font-size-h4 ml-2" id="kt_login_signup">Get Help</a>
						</div>
					</div> -->
					<!--end::Top-->
					<!--begin::Wrapper-->
					<div class="d-flex flex-row-fluid flex-center">
						<!--begin::Signin-->
						<div class="login-form login-form-signup">
							<!--begin::Form-->
							<?= session()->getFlashdata('message'); ?>
							<form class="form" novalidate="novalidate" id="kt_login_signup_form" action="<?= base_url('auth/signup'); ?>" method="post">
								<!--begin: Wizard Step 1-->
								<div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
									<!--begin::Title-->
									<div class="pb-10 pb-lg-15">
										<h3 class="font-weight-bolder text-dark display5">Create Account</h3>
										<div class="text-muted font-weight-bold font-size-h4">Already have an Account?
										<a href="<?= base_url('auth/'); ?>" class="text-primary font-weight-bolder">Sign In</a></div>
									</div>
                                    <!--begin::Row-->
									<div class="row">
										<div class="col-xl-12">
                                            <div class="form-group">
                                                <label class="font-size-h6 font-weight-bolder text-dark">Store Name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control h-auto py-5 px-6 border-0 rounded-lg font-size-h6 <?= ($validation->getError('owners_name')) ? 'is-invalid' : ''; ?>" id="owners_name" name="owners_name" value="<?= $request->getPost('owners_name'); ?>" placeholder="Store Name" />
												<?php if($validation->getError('owners_name')){ echo '<div class="invalid-feedback">'.$validation->getError('owners_name').'</div>'; } ?>
                                            </div>
                                        </div>
                                    </div>
									<div class="row">
										<div class="col-xl-12">
                                            <div class="form-group">
                                                <label class="font-size-h6 font-weight-bolder text-dark">Store Address<span class="text-danger">*</span></label>
                                                <textarea class="form-control h-auto py-5 px-6 border-0 rounded-lg font-size-h6 <?= ($validation->getError('owners_address')) ? 'is-invalid' : ''; ?>" id="owners_address" name="owners_address" placeholder="Store Address"><?= $request->getPost('owners_address'); ?></textarea>
												<?php if($validation->getError('owners_address')){ echo '<div class="invalid-feedback">'.$validation->getError('owners_address').'</div>'; } ?>
                                            </div>
                                        </div>
									</div>
									<div class="row">
										<div class="col-xl-6">
                                            <div class="form-group">
                                                <label class="font-size-h6 font-weight-bolder text-dark">Province (Provinsi) <span class="text-danger">*</span></label>
												<select class="form-control showproduct h-auto py-5 px-6 border-0 rounded-lg font-size-h6<?= ($validation->getError('state_id')) ? 'is-invalid' : ''; ?>" value="<?= old('state_id'); ?>" id="state_id" name="state_id" onchange="get_city(); getProvince(this)">
													<option selected disabled> Select a province</option>
													<?php if (@$state) :
														foreach ($state as $row) :
													?>
													<option value="<?= $row->state_id ?>" <?php if($request->getPost('state_id') == $row->state_id){echo 'selected';} ?>><?= $row->state_name ?></option>
													<?php endforeach; endif; ?>
												</select>
												<?php if($validation->getError('state_id')){ echo '<div class="invalid-feedback">'.$validation->getError('state_id').'</div>'; } ?>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label class="font-size-h6 font-weight-bolder text-dark">City (Kota/Kabupaten) <span class="text-danger">*</span></label>
                                                <select class="form-control showproduct h-auto py-5 px-6 border-0 rounded-lg font-size-h6 <?= ($validation->getError('city_id')) ? 'is-invalid' : ''; ?>" value="<?= old('city_id'); ?>" id="city_id" name="city_id" onchange="get_district(); getCity(this)">
												<?php if(@$city) : ?>
													<option></option>
												<?php foreach ($city as $ct) : ?>
													<option value="<?= $ct->city_id; ?>" <?php if($request->getPost('city_id') == $ct->city_id){echo 'selected';} ?>><?= $ct->city_name ?></option>
												<?php
													endforeach;
												endif;
												?>
												</select>
												<?php if($validation->getError('city_id')){ echo '<div class="invalid-feedback">'.$validation->getError('city_id').'</div>'; } ?>
                                            </div>
                                        </div>
                                    </div>
									<!--begin::Form Group-->
									<div class="row">
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                            <label class="font-size-h6 font-weight-bolder text-dark">District (Kecamatan) <span class="text-danger">*</span></label>
                                            <select class="form-control showproduct h-auto py-5 px-6 border-0 rounded-lg font-size-h6 <?= ($validation->getError('district_id')) ? 'is-invalid' : ''; ?>" value="<?= old('district_id'); ?>" id="district_id" name="district_id" onchange="get_sub_district(); getDistrict(this)">
											<?php if(@$district) : ?>
												<option></option>
											<?php foreach ($district as $dist) : ?>
												<option value="<?= $dist->district_id; ?>" <?php if($request->getPost('district_id') == $dist->district_id){echo 'selected';} ?>><?= $dist->district_name ?></option>
											<?php
												endforeach;
											endif;
											?>
											</select>
											<?php if($validation->getError('district_id')){ echo '<div class="invalid-feedback">'.$validation->getError('district_id').'</div>'; } ?>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                            <label class="font-size-h6 font-weight-bolder text-dark">Sub District (Kelurahan) <span class="text-danger">*</span></label>
                                            <select class="form-control showproduct h-auto py-5 px-6 border-0 rounded-lg font-size-h6 <?= ($validation->getError('sdistrict_id')) ? 'is-invalid' : ''; ?>" value="<?= old('sdistrict_id'); ?>" id="sdistrict_id" name="sdistrict_id" onchange="getSubDistrict(this)">
											<?php if(@$sub_district) : ?>
												<option></option>
											<?php foreach ($sub_district as $sdist) : ?>
												<option value="<?= $sdist->sdistrict_id; ?>" <?php if($request->getPost('sdistrict_id') == $sdist->sdistrict_id){echo 'selected';} ?> data-id="<?= $sdist->zip_code ?>"><?= $sdist->sdistrict_name ?></option>
											<?php
												endforeach;
											endif;
											?>
											</select>
											<?php if($validation->getError('sdistrict_id')){ echo '<div class="invalid-feedback">'.$validation->getError('sdistrict_id').'</div>'; } ?>
                                            </div>
                                        </div>
									</div>
									<!--end::Form Group-->
									<div class="row">
										<div class="col-xl-6">
                                            <div class="form-group">
                                                <label class="font-size-h6 font-weight-bolder text-dark">Store Location</label>
                                                <input type="text" onkeypress="return CheckNumeric()" class="form-control h-auto py-5 px-6 border-0 rounded-lg font-size-h6 <?= ($validation->getError('owners_latitude')) ? 'is-invalid' : ''; ?>" id="owners_latitude" value="<?= $request->getPost('owners_latitude'); ?>" name="owners_latitude" placeholder="Latidude" />
												<?php if($validation->getError('owners_latitude')){ echo '<div class="invalid-feedback">'.$validation->getError('owners_latitude').'</div>'; } ?>
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <label class="font-size-h6 font-weight-bolder text-dark">&nbsp;</label>
                                                <input type="text" onkeypress="return CheckNumeric()" class="form-control h-auto py-5 px-6 border-0 rounded-lg font-size-h6 <?= ($validation->getError('owners_longitude')) ? 'is-invalid' : ''; ?>" id="owners_longitude" value="<?= $request->getPost('owners_longitude'); ?>" name="owners_longitude" placeholder="Longitude" />
												<?php if($validation->getError('owners_longitude')){ echo '<div class="invalid-feedback">'.$validation->getError('owners_longitude').'</div>'; } ?>
                                            </div>
                                        </div>
										<div class="col-xl-2">
											<div class="form-group">
												<label class="font-size-h6 font-weight-bolder text-dark">&nbsp;</label>
												<a href="#" class="btn btn-primary form-control font-weight-bolder h-auto py-5 px-6 border-0 rounded-lg font-size-h6" data-toggle="modal" data-target="#modal-latlong" title="Pilih Titik Koordinat"><i class="fa fa-map-marker-alt"></i></a>
											</div>
										</div>
                                    </div>
								</div>
								<!--end: Wizard Step 1-->

								<!--begin: Wizard Step 1-->
								<div class="pb-5" data-wizard-type="step-content">
									<!--begin::Title-->
									<div class="pb-10 pb-lg-15">
										<h3 class="font-weight-bolder text-dark display5">Create Account</h3>
										<div class="text-muted font-weight-bold font-size-h4">Already have an Account?
										<a href="<?= base_url('auth/'); ?>" class="text-primary font-weight-bolder">Sign In</a></div>
									</div>
                                    <!--begin::Row-->
									<div class="row">
										<div class="col-xl-6">
                                            <div class="form-group">
                                                <label class="font-size-h6 font-weight-bolder text-dark">Full Name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control h-auto py-5 px-6 border-0 rounded-lg font-size-h6 <?= ($validation->getError('fullname')) ? 'is-invalid' : ''; ?>" id="fullname" name="fullname" value="<?= $request->getPost('fullname'); ?>" placeholder="Full Name" />
												<?php if($validation->getError('fullname')){ echo '<div class="invalid-feedback">'.$validation->getError('fullname').'</div>'; } ?>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label class="font-size-h6 font-weight-bolder text-dark">Email Address<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control h-auto py-5 px-6 border-0 rounded-lg font-size-h6 <?= ($validation->getError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?= $request->getPost('email'); ?>" placeholder="Email Address" />
												<?php if($validation->getError('email')){ echo '<div class="invalid-feedback">'.$validation->getError('email').'</div>'; } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
										<div class="col-xl-6">
                                            <div class="form-group">
                                                <label class="font-size-h6 font-weight-bolder text-dark">Password<span class="text-danger">*</span></label>
                                                <input type="password" class="form-control h-auto py-5 px-6 border-0 rounded-lg font-size-h6 <?= ($validation->getError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" value="<?= $request->getPost('password'); ?>" placeholder="Password" />
												<?php if($validation->getError('password')){ echo '<div class="invalid-feedback">'.$validation->getError('password').'</div>'; } ?>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label class="font-size-h6 font-weight-bolder text-dark">Confirm Password<span class="text-danger">*</span></label>
                                                <input type="password" class="form-control h-auto py-5 px-6 border-0 rounded-lg font-size-h6 <?= ($validation->getError('repassword')) ? 'is-invalid' : ''; ?>" id="repassword" name="repassword" value="<?= $request->getPost('repassword'); ?>" placeholder="Confirm Password" />
												<span id='message_confirm'></span>
												<?php if($validation->getError('repassword')){ echo '<div class="invalid-feedback">'.$validation->getError('repassword').'</div>'; } ?>
                                            </div>
                                        </div>
                                    </div>
									<!--begin::Form Group-->
									<div class="row">
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                            <label class="font-size-h6 font-weight-bolder text-dark">Phone<span class="text-danger">*</span></label>
                                            <input type="tel" onkeypress="return CheckNumeric()" class="form-control h-auto py-5 px-6 border-0 rounded-lg font-size-h6 <?= ($validation->getError('phone')) ? 'is-invalid' : ''; ?>" id="signup_phone" name="phone" value="<?= $request->getPost('phone'); ?>"placeholder="Phone" />
											<?php if($validation->getError('phone')){ echo '<div class="invalid-feedback">'.$validation->getError('phone').'</div>'; } ?>
                                            </div>
                                        </div>
									</div>
									<!--end::Form Group-->
								</div>
								<!--end: Wizard Step 1-->

								<!--begin: Wizard Step 4-->
								<div class="pb-5" data-wizard-type="step-content">
									<!--begin::Title-->
									<div class="pt-lg-0 pt-5 pb-15">
										<h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Complete Signing Up</h3>
										<div class="text-muted font-weight-bold font-size-h4">Complete Your Signup And Become a Member!</div>
									</div>
									<!--end::Title-->
									<!--begin::Section-->
									<h4 class="font-weight-bolder mb-3">Store Data Details:</h4>
									<div class="text-dark-50 font-weight-bold line-height-lg mb-8">
										Store ID: <span><?= $owners_id; ?></span></br>
										Store Name: <span id="get_owners_name"></span></br>
										Address: <span id="get_owners_address"></span>
										, <span id="get_owners_sub_district"></span>
										, <span id="get_owners_district"></span>
										, <span id="get_owners_city"></span>
										, <span id="get_owners_state"></span> <span id="get_zip_code"></span></br>
									</div>
									<h4 class="font-weight-bolder mb-3">Account Details:</h4>
									<div class="text-dark-50 font-weight-bold line-height-lg mb-8">
										Owner ID: <span><?= $autogen; ?></span></br>
										Fullname: <span id="get_fullname"></span></br>
										Email: <span id="get_email"></span></br>
										Phone: <span id="get_phone"></span></br>
									</div>
									<div class="card">
										<div class="card-header">
											<strong>Term & Condition</strong>
										</div>
										<div class="card-body" style="max-height: 250px; overflow-y: auto;">
										<p><Strong>Syarat & Ketentuan</Strong></p>
										<!-- <p>Tanggal Berlaku: <strong>29 november 2021</strong></p> -->
										
										<p><strong>Perjanjian ini adalah kontrak antara Anda (“Anda” atau “User”) dan STORI</strong></p>

										<p>Anda harus membaca dan menerima semua syarat dan ketentuan dalam perjanjian ini untuk menggunakan service yang terletak di aplikasi www.STORI.com dan semua produk turunannya seperti aplikasi, email, form, dan website lainnya yang dimiliki oleh STORI.</p>

										<p><strong>Istilah</strong></p>

										<p>“Gudang" adalah penyedia jasa perorangan maupun sebagai penyedia jasa berbadan hukum yang memberikan layanan penyimpanan, pengelolahan, dan pengiriman barang dagangan.</p> 
										<p>"Seller" sebagai pemilik barang dagangan yang dititipkan ke “Gudang".</p> 
										<p>“User" adalah semua pengguna STORI termasuk “Seller" dan “Gudang”</p>


										<p><strong>Tentang Platform STORI</strong></p>

										<p>STORI adalah sebuah situs atau aplikasi dimana Seller dapat bertemu Gudang untuk menitipkan barangnya agar disimpan dengan baik dan dikirimkan ke kurir terdekat ketika ada Pesanan Baru. Tujuan Seller menitipkan barangnya di Gudang adalah untuk kemudahan Seller dalam pengiriman, dan mendapatkan diskon pengiriman kurir. 
										Sementara Gudang dapat menggunakan rumah pribadi ataupun kantor untuk menyimpan barang. Keamanan barang dan akurasi dari pengiriman adalah tanggung jawab Gudang.</p>


										<p><strong>Ketentuan umum pengguna STORI</strong></p>

										<p>Komunikasi antara Seller, dan Gudang dapat menggunakan platform yang disediakan oleh STORI untuk berkomunikasi. User disarankan menggunakan platform dan fitur-fitur yang sudah ditentukan agar jika terjadi dispute, dispute dapat diselesaikan dengan sebaik-baiknya.</p>


										<p><strong>Data</strong></p>

										<p>Data yang diberikan oleh user kepada STORI harus akurat. Jika data yang diberikan tidak akurat maka STORI berhak untuk menghapus atau meng-non-aktifkan akun yang bersangkutan</p>


										<p><strong>Hak & Kewajiban Gudang</strong></p>

										<p>Gudang berkewajiban untuk menyimpan barang Seller dengan aman</p> 
										<p>Gudang berkewajiban untuk segera mengirimkan barang Seller ketika ada transaksi baru</p> 
										<p>Gudang berkewajiban untuk memastikan barang yang dikirimkan sesuai dengan yang diminta oleh Seller</p> 
										<p>Gudang berkewajiban memberikan akses untuk STORI saat pemeriksaan lokasi</p> 
										<p>Gudang berkewajiban memberikan discount dari kurir kepada Seller</p> 
										<p>Gudang berhak menerima pembayaran sesuai kesepakatan awal</p>


										<p><strong>Hak & Kewajiban Seller</strong></p>

										<p>Seller berkewajiban untuk memberikan informasi akurat kepada Gudang untuk barang yang akan dikirimkan</p> 
										<p>Seller berkewajiban menginformasikkan kepada gudang harga barang yang terjual</p> 
										<p>Seller berkewajiban untuk membayarkan biaya diawal untuk kebutuhan pengiriman</p> 
										<p>Seller berkewajiban untuk mengirimkan inventory barang sampai ke gudang, kecuali ditawarkan dengan jelas untuk pengambilan inventory oleh Gudang di tempat Seller</p> 
										<p>Seller berkewajiban membayar biaya service Gudang yang disepakati diawal</p>


										<p><strong>Dispute</strong></p>

										<p>Jika terjadi perselisihan perhitungan inventory maupun kehilangan barang saat penyimpanan di gudang, Gudang wajib membayar 80% dari nilai barang</p>


										<p><strong>Biaya, Pajak, & Faktur</strong></p>

										<p>Biaya</p>
										<p>STORI membebankan biaya 20% kepada Gudang dari nilai biaya servis Gudang yang dibayarkan oleh Seller 
										Biaya Admin untuk melakukan transfer antar bank akan ditanggung oleh User</p>


										<p>Faktur</p>
										<p>STORI tidak memiliki tanggung jawab untuk menerbitkan faktur pajak. Sebaliknya, Gudang yang harus bertanggungjawab untuk menentukan sendiri, apakah secara hukum perlu faktur pajak standar</p>


										<p>Pajak</p>
										<p>Semua biaya yang harus dibayar oleh Pengguna tidak termasuk segala macam jenis pajak, termasuk namun tidak terbatas pada pajak penghasilan atas jasa. Jika suatu pemotongan diwajibkan oleh hukum, Pengguna / user harus memberitahu STORI dan akan membayar STORI suatu jumlah tambahan untuk memastikan bahwa nilai bersih yang STORI terima setelah setiap pengurangan akan sama dengan jumlah yang akan STORI terima jika tidak ada potongan.</p>

										</div>
										<div class="card-footer">
											<div class="form-check" id="form">
												<input class="agreement" type="checkbox" name="agreement" id="agreement" onchange="valueChanged()"/>
												<label class="form-check-label" for="agreement">
													I agree to the term & condition
												</label>
											</div>
										</div>
									</div>
									<!--end::Section-->
								</div>
								<!--end: Wizard Step 4-->
								<!--begin: Wizard Actions-->
								<div class="d-flex justify-content-between pt-3">
									<div class="mr-2">
										<button type="button" class="btn btn-light-primary font-weight-bolder font-size-h6 pl-6 pr-8 py-4 my-3 mr-3" data-wizard-type="action-prev">
										<span class="svg-icon svg-icon-md mr-1">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Left-2.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<polygon points="0 0 24 0 24 24 0 24" />
													<rect fill="#000000" opacity="0.3" transform="translate(15.000000, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-15.000000, -12.000000)" x="14" y="7" width="2" height="10" rx="1" />
													<path d="M3.7071045,15.7071045 C3.3165802,16.0976288 2.68341522,16.0976288 2.29289093,15.7071045 C1.90236664,15.3165802 1.90236664,14.6834152 2.29289093,14.2928909 L8.29289093,8.29289093 C8.67146987,7.914312 9.28105631,7.90106637 9.67572234,8.26284357 L15.6757223,13.7628436 C16.0828413,14.136036 16.1103443,14.7686034 15.7371519,15.1757223 C15.3639594,15.5828413 14.7313921,15.6103443 14.3242731,15.2371519 L9.03007346,10.3841355 L3.7071045,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(9.000001, 11.999997) scale(-1, -1) rotate(90.000000) translate(-9.000001, -11.999997)" />
												</g>
											</svg>
											<!--end::Svg Icon-->
										</span>Previous</button>
									</div>
									<div>
										<!-- button submit -->
										<a href="<?= base_url(''); ?>" class="btn btn-text-dark-50 btn-icon-primary btn-hover-icon-danger font-weight-bold btn-hover-bg-light mr-3">
											<i class="flaticon2-left-arrow-1"></i>Back to Home
										</a>
										<button class="btn btn-primary font-weight-bolder font-size-h6 pl-5 pr-8 py-4 my-3" data-wizard-type="action-submit" type="submit" id="kt_login_signup_form_submit_button">Submit
										<span class="svg-icon svg-icon-md ml-2">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Right-2.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<polygon points="0 0 24 0 24 24 0 24" />
													<rect fill="#000000" opacity="0.3" transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000)" x="7.5" y="7.5" width="2" height="9" rx="1" />
													<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
												</g>
											</svg>
											<!--end::Svg Icon-->
										</span></button>
										<button type="button" class="btn btn-primary font-weight-bolder font-size-h6 pl-8 pr-4 py-4 my-3" data-wizard-type="action-next">Next
										<span class="svg-icon svg-icon-md ml-1">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Right-2.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<polygon points="0 0 24 0 24 24 0 24" />
													<rect fill="#000000" opacity="0.3" transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000)" x="7.5" y="7.5" width="2" height="9" rx="1" />
													<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
												</g>
											</svg>
											<!--end::Svg Icon-->
										</span></button>
									</div>
								</div>
								<!--end: Wizard Actions-->
							</form>
							<!--end::Form-->
						</div>
						<!--end::Signin-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Content-->
			</div>
			<!--end::Login-->
		</div>
		<div class="modal fade" id="modal-latlong">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Titik Koordinat</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<div id="map" style="height: 400px; width: 100%;"></div>
					</div>
					<div class="modal-footer">
						<a class="btn btn-primary" data-dismiss="modal">Pilih</a>
					</div>
				</div>
			</div>
		</div>
														</div>
		<!--end::Main-->
		<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
		<!--begin::Global Config(global config for global JS scripts)-->
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
		<!--end::Global Config-->
		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="<?= base_url(); ?>/theme/dist/assets/plugins/global/plugins.bundle.js"></script>
		<script src="<?= base_url(); ?>/theme/dist/assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
		<script src="<?= base_url(); ?>/theme/dist/assets/js/scripts.bundle.js"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="<?= base_url(''); ?>/theme/dist/assets/js/pages/crud/forms/widgets/select2.js"></script>
		<script src="<?= base_url(); ?>/theme/dist/assets/js/pages/custom/login/login-3.js"></script>
		<script src="<?= base_url(); ?>/theme/dist/assets/js/pages/custom/login/sign-up.js"></script>
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnqACpjEB47TZ4SQf6Fwt6sa6hhAyO5dM&callback=initMap" type="text/javascript"></script>
		<!--end::Page Scripts-->
		<script>
			function initMap() {
				var x = navigator.geolocation;
				x.getCurrentPosition(success, failure);

				function success(position){
					var myLat = position.coords.latitude;
					var myLong = position.coords.longitude;

					var coords = {lat: myLat, lng: myLong};

					var map = new google.maps.Map(document.getElementById('map'), {
						zoom: 17,
						center: coords,
						mapTypeId:google.maps.MapTypeId.ROADMAP
					});

					var marker = new google.maps.Marker({
						position: coords,
						map: map,
						title: 'Pilih Lokasi Kantor',
						draggable: true
					});

					google.maps.event.addListener(marker, 'dragend', function(marker){
						var latLng = marker.latLng;
						document.getElementById("owners_latitude").value = latLng.lat();
						document.getElementById("owners_longitude").value = latLng.lng();
					}); 
				}
				
				function failure(){
					alert('Geolocation failure!');
					var coords = {lat: -6.168117, lng: 106.835152};

					var map = new google.maps.Map(document.getElementById('map'), {
						zoom: 17,
						center: coords,
						mapTypeId:google.maps.MapTypeId.ROADMAP
					});

					var marker = new google.maps.Marker({
						position: coords,
						map: map,
						title: 'Pilih Lokasi Kantor',
						draggable: true
					});

					google.maps.event.addListener(marker, 'dragend', function(marker){
						var latLng = marker.latLng;
						document.getElementById("owners_latitude").value = latLng.lat();
						document.getElementById("owners_longitude").value = latLng.lng();
					});
				}
			}
		</script>
		<script type="text/javascript">
			function get_city() {
				var state_id = document.getElementById('state_id').value;
				// console.log(area_id);
				$.ajax({
					method: 'POST',
					url: "<?php echo site_url("/warehouse/get_city"); ?>",
					beforeSend: function () {
					},
					dataType: "json",
					data: {
						state_id : state_id,
					},
					success: function (result) {
						document.getElementById('city_id').innerHTML = result.city;
					}
				})
			}

			function get_district() {
				var city_id = document.getElementById('city_id').value;
				// console.log(area_id);
				$.ajax({
					method: 'POST',
					url: "<?php echo site_url("/warehouse/get_district"); ?>",
					beforeSend: function () {
					},
					dataType: "json",
					data: {
						city_id : city_id,
					},
					success: function (result) {
						document.getElementById('district_id').innerHTML = result.district;
					}
				})
			}

			function get_sub_district() {
				var district_id = document.getElementById('district_id').value;
				// console.log(area_id);
				$.ajax({
					method: 'POST',
					url: "<?php echo site_url("/warehouse/get_sub_district"); ?>",
					beforeSend: function () {
					},
					dataType: "json",
					data: {
						district_id : district_id,
					},
					success: function (result) {
						document.getElementById('sdistrict_id').innerHTML = result.sub_district;
					}
				})
			}
		</script>
		<script>
			function CheckNumeric() {
				return event.keyCode >= 48 && event.keyCode <= 57 || event.keyCode == 46;
			}
		</script>
		<script type="text/javascript">
			function valueChanged()
			{
				if($('.agreement').is(":checked")){
					document.getElementById("agreement").value = 1; 
					document.getElementById("kt_login_signup_form_submit_button").disabled = false;
				}else {
					document.getElementById("agreement").value = 0; 
					document.getElementById("kt_login_signup_form_submit_button").disabled = true;
				}
			}
		</script>
	</body>
	<!--end::Body-->
</html>