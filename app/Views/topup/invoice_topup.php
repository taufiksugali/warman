<?php use App\Models\OwnersModel; ?>
<?php $this->owner = new OwnersModel(); 
    $owner = $this->owner->get_all_owner();?>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Dashboard</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted">Top UP</a>
                    </li>
                </ul>
				<!--end::Page Title-->
			</div>
			<!--end::Info-->
			<!--begin::Toolbar-->
			<div class="d-flex align-items-center">
				<!--begin::Dropdowns-->
			</div>
			<!--end::Toolbar-->
		</div>
	</div>
	<!--end::Subheader-->
	<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<!--begin::Container-->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-custom position-relative overflow-hidden">
                        <!-- TELLER -->
                        <div class="card-body">
                            <div class="input_fields_wrap">
                                <div class="form-group row">
                                    <div class="col-12" style="text-align: center; font-size: 20px; font-weight: bold;">
                                        Selesaikan pembayaran anda dalam
                                    </div>
                                    
                                    <div class="col-12" id="cntdwn" style="text-align: center; font-size: 30px; font-weight: bold;">
                                    </div>
                                    <div class="col-12" style="text-align: center; font-size: 20px;">
                                        Batas Akhir Pembayaran
                                    </div>
                                    <div class="col-12" style="text-align: center; font-size: 20px; font-weight: bold;">
                                        <?= date("H:i:s", strtotime(@$get_topup_byid2->created_date . '+ 1 hours')) ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php if (@$get_topup_byid2->bank_id == '1') { ?>
                        <div class="card-body">
                            <div class="accordion accordion-toggle-arrow" id="accordionExample1">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title" data-toggle="collapse" data-target="#collapseOne1">Loket Pos Indonesia</div>
                                    </div>
                                    <div id="collapseOne1" class="collapse show" data-parent="#accordionExample1">
                                        <div class="card-body">
                                            1. Data ke <b>Kantor Pos</b> terdekat<br>
                                            2. Ambil formulir penambahan saldo<br>
                                            3. Isikan <?= @$get_topup_byid2->topup_va ?> sebagai rekening tujuan<br>
                                            4. Siapkan jumlah top up yang ingin dibayarkan<br>
                                            5. Berikan formulir dan uang kepada petugas<br>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="input_fields_wrap">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label style="margin-bottom: 10px">Catatan :</label>
                                        <br/>
                                        <span class="label pulse pulse-primary mr-10">
                                            <span class="position-relative">-</span>
                                            <span class="pulse-ring"></span>
                                        </span> <label style="margin-bottom: 20px">Minimum transaksi top up adalah Rp. 10.000</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        
                        <!-- POSPAY -->
                        <?php if (@$get_topup_byid2->bank_id == '2') { ?>
                        <div class="card-body">
                            <div class="accordion accordion-toggle-arrow" id="accordionExample1">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title" data-toggle="collapse" data-target="#collapseOne1">Pospay Mobile</div>
                                    </div>
                                    <div id="collapseOne1" class="collapse show" data-parent="#accordionExample1">
                                        <div class="card-body">
                                            1. Masuk ke aplikasi <b>POSPAY</b><br>
                                            2. Masuk ke <b>Fitur Utama > Pilih Menu Lainnya > Banking > Virtual Account</b><br>
                                            3. Masukan nomor virtual account anda <b><?= @$get_topup_byid2->topup_va ?></b><br>
                                            4. Ikuti instruksi untuk menyelesaikan transaksi<br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        
                        <!-- BANK BCA -->
                        <?php if (@$get_topup_byid2->bank_id == '3') { ?>
                        <div class="card-body">
                            <div class="accordion accordion-toggle-arrow" id="accordionExample1">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title" data-toggle="collapse" data-target="#collapseOne1">ATM <?= @$get_topup_byid2->bank_name ?></div>
                                    </div>
                                    <div id="collapseOne1" class="collapse show" data-parent="#accordionExample1">
                                        <div class="card-body">
                                            1. Masukan kartu ATM dan PIN <?= @$get_topup_byid2->bank_name ?> Anda<br>
                                            2. Pilih menu <b>TRANSFER ANTAR <?= @$get_topup_byid2->bank_name ?></b><br>
                                            3. Masukan kode giro <?= @$get_topup_byid2->bank_prefix ?> dan nomor virtual account anda (Contoh : <b><?= @$get_topup_byid2->bank_prefix ?> <?= @$get_topup_byid2->topup_va ?></b>)<br>
                                            4. Masukan jumlah top up yang ingin dibayarkan<br>
                                            5. Ikuti intruksi untuk menyelesaikan transaksi<br>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo1">KLIK <?= @$get_topup_byid2->bank_name ?></div>
                                    </div>
                                    <div id="collapseTwo1" class="collapse" data-parent="#accordionExample1">
                                        <div class="card-body">
                                            1. Masuk ke website <b>KLIK <?= @$get_topup_byid2->bank_name ?></b><br>
                                            2. Pilih menu <b>TRANSAKSI DANA > TRANSFER KE BCA VIRTUAL ACCOUNT</b><br>
                                            3. Masukan kode giro <?= @$get_topup_byid2->bank_prefix ?> dan nomor virtual account anda (Contoh : <b><?= @$get_topup_byid2->bank_prefix ?> <?= @$get_topup_byid2->topup_va ?></b>)<br>
                                            4. Masukan jumlah top up yang ingin dibayarkan<br>
                                            5. Ikuti intruksi untuk menyelesaikan transaksi<br>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree1">m-BCA (BCA MOBILE)</div>
                                    </div>
                                    <div id="collapseThree1" class="collapse" data-parent="#accordionExample1">
                                        <div class="card-body">
                                            1. Masuk ke aplikasi mobile <b>m-<?= @$get_topup_byid2->bank_name ?></b><br>
                                            2. Pilih menu <b>M-TRANSFER > <?= @$get_topup_byid2->bank_name ?> VIRTUAL ACCOUNT</b><br>
                                            3. Masukan kode giro <?= @$get_topup_byid2->bank_prefix ?> dan nomor virtual account anda (Contoh : <b><?= @$get_topup_byid2->bank_prefix ?> <?= @$get_topup_byid2->topup_va ?></b>)<br>
                                            4. Masukan jumlah top up yang ingin dibayarkan<br>
                                            5. Masukan <b>PIN m-<?= @$get_topup_byid2->bank_name ?></b><br>
                                            6. Ikuti intruksi untuk menyelesaikan transaksi<br>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseFour1">m-BCA (STK - SIM Tool Kit)</div>
                                    </div>
                                    <div id="collapseFour1" class="collapse" data-parent="#accordionExample1">
                                        <div class="card-body">
                                            1. Pilih menu <b>m-<?= @$get_topup_byid2->bank_name ?></b> pada menu SIM Card Anda<br>
                                            2. Pilih menu <b>TRANSFER > ANTAR <?= @$get_topup_byid2->bank_name ?></b><br>
                                            3. Masukan kode giro <?= @$get_topup_byid2->bank_prefix ?> dan nomor virtual account anda (Contoh : <b><?= @$get_topup_byid2->bank_prefix ?> <?= @$get_topup_byid2->topup_va ?></b>)<br>
                                            4. Masukan <b>PIN <?= @$get_topup_byid2->bank_name ?></b> Lalu Tekan OK<br>
                                            5. Masukan jumlah top up yang ingin dibayarkan<br>
                                            6. Masukan <b>PIN <?= @$get_topup_byid2->bank_name ?></b> Lalu Tekan OK<br>
                                            7. Ikuti intruksi untuk menyelesaikan transaksi<br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="input_fields_wrap">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label style="margin-bottom: 10px">Catatan : </label>
                                        <br/>
                                        <span class="label pulse pulse-primary mr-10">
                                            <span class="position-relative">-</span>
                                            <span class="pulse-ring"></span>
                                        </span> <label style="margin-bottom: 20px">Minimum transaksi top up adalah Rp. 10.000</label>
                                        <br/>
                                        <span class="label pulse pulse-primary mr-10">
                                            <span class="position-relative">-</span>
                                            <span class="pulse-ring"></span>
                                        </span> <label style="margin-bottom: 20px">Penambahan saldo giro dikenakan bea admin sebesar Rp. 2.000</label>
                                        <br/>
                                        <span class="label pulse pulse-primary mr-10">
                                            <span class="position-relative">-</span>
                                            <span class="pulse-ring"></span>
                                        </span> <label style="margin-bottom: 20px">Top up tidak bisa dilakukan, jika nominal top up setelah dikurangi biaya admin kurang dari Rp. 10.000</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        
                        <!-- BANK BNI -->
                        <?php if (@$get_topup_byid2->bank_id == '4') { ?>
                        <div class="card-body">
                            <div class="accordion accordion-toggle-arrow" id="accordionExample1">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title" data-toggle="collapse" data-target="#collapseOne1">ATM <?= @$get_topup_byid2->bank_name ?></div>
                                    </div>
                                    <div id="collapseOne1" class="collapse show" data-parent="#accordionExample1">
                                        <div class="card-body">
                                            1. Masukan kartu ATM dan PIN <?= @$get_topup_byid2->bank_name ?> Anda<br>
                                            2. Pilih menu <b>TRANSFER ANTAR <?= @$get_topup_byid2->bank_name ?></b><br>
                                            3. Masukan kode giro <?= @$get_topup_byid2->bank_prefix ?> dan nomor virtual account anda (Contoh : <b><?= @$get_topup_byid2->bank_prefix ?><?= @$get_topup_byid2->topup_va ?></b>)<br>
                                            4. Masukan jumlah top up yang ingin dibayarkan<br>
                                            5. Ikuti intruksi untuk menyelesaikan transaksi<br>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo1">Internet Banking BNI</div>
                                    </div>
                                    <div id="collapseTwo1" class="collapse" data-parent="#accordionExample1">
                                        <div class="card-body">
                                            1. Masuk ke website <b>INTERNET BANKING BNI</b><br>
                                            2. Pilih menu <b>TRANSAKSI > TRANSFER ANTAR BNI</b><br>
                                            3. Masukan kode giro 816109 dan nomor virtual account anda (Contoh : <b><?= @$get_topup_byid2->bank_prefix ?> <?= @$get_topup_byid2->topup_va ?></b>)<br>
                                            4. Masukan jumlah top up yang ingin dibayarkan<br>
                                            5. Ikuti intruksi untuk menyelesaikan transaksi<br>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree1">SMS BANKING (BNI MOBILE)</div>
                                    </div>
                                    <div id="collapseThree1" class="collapse" data-parent="#accordionExample1">
                                        <div class="card-body">
                                            1. Masuk ke aplikasi mobile <b>BNI SMS BANKING</b><br>
                                            2. Pilih menu <b>TRANSFER > TRANSFER ANTAR BNI</b><br>
                                            3. Masukan kode giro 816109 dan nomor virtual account anda (Contoh : <b><?= @$get_topup_byid2->bank_prefix ?> <?= @$get_topup_byid2->topup_va ?></b>)<br>
                                            4. Masukan jumlah top up yang ingin dibayarkan<br>
                                            5. Ikuti intruksi untuk menyelesaikan transaksi<br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="input_fields_wrap">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label style="margin-bottom: 10px">Catatan : </label>
                                        <br/>
                                        <span class="label pulse pulse-primary mr-10">
                                            <span class="position-relative">-</span>
                                            <span class="pulse-ring"></span>
                                        </span> <label style="margin-bottom: 20px">Minimum transaksi top up adalah Rp. 10.000</label>
                                        <br/>
                                        <span class="label pulse pulse-primary mr-10">
                                            <span class="position-relative">-</span>
                                            <span class="pulse-ring"></span>
                                        </span> <label style="margin-bottom: 20px">Penambahan saldo giro dikenakan bea admin sebesar Rp. 2.000</label>
                                        <br/>
                                        <span class="label pulse pulse-primary mr-10">
                                            <span class="position-relative">-</span>
                                            <span class="pulse-ring"></span>
                                        </span> <label style="margin-bottom: 20px">Top up tidak bisa dilakukan, jika nominal top up setelah dikurangi biaya admin kurang dari Rp. 10.000</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        
                        <!-- BANK MANDIRI -->
                        <?php if (@$get_topup_byid2->bank_id == '5') { ?>
                        <div class="card-body">
                            <div class="accordion accordion-toggle-arrow" id="accordionExample1">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title" data-toggle="collapse" data-target="#collapseOne1">ATM <?= @$get_topup_byid2->bank_name ?></div>
                                    </div>
                                    <div id="collapseOne1" class="collapse show" data-parent="#accordionExample1">
                                        <div class="card-body">
                                            1. Masukan kartu ATM dan PIN <?= @$get_topup_byid2->bank_name ?> Anda<br>
                                            2. Pilih menu <b>BAYAR / BELI</b><br>
                                            3. Pilih menu <b>MULTIPAYMENT</b><br>
                                            4. Pilih kode institusi <b>PT Pos Indonesia</b><br>
                                            5. Ketik kode perusahaan <b>"<?= @$get_topup_byid2->bank_prefix ?>" (POS INDONESIA)</b> ATAU<br>
                                            6. Ketik <b>DAFTAR KODE</b> untuk mencari kode <b>POS INDONESIA</b> yaitu <b><?= @$get_topup_byid2->bank_prefix ?></b><br>
                                            7. Isi kode giro <?= @$get_topup_byid2->bank_prefix ?> dan nomor virtual account anda kemudian tekan BENAR (Contoh : <b><?= @$get_topup_byid2->bank_prefix ?><?= @$get_topup_byid2->topup_va ?></b>)<br>
                                            8. Muncul konfirmasi data customer, Pilih <b>Nomor 1</b> sesuai tagihan yang akan dibayarkan, Tekan <b>YA</b> untuk melakukan pembayaran<br>
                                            9. Muncul konfirmasi pembayaran, Tekan <b>YA</b> untuk melakukan pembayaran<br>
                                            10. Bukti pembayaran dalam bentuk STRUK agar disimpan sebagai bukti pembayaran yang sah dari bank Mandiri<br>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo1">MANDIRI MOBILE</div>
                                    </div>
                                    <div id="collapseTwo1" class="collapse" data-parent="#accordionExample1">
                                        <div class="card-body">
                                            1. Masuk <b>MANDIRI MOBILE</b><br>
                                            2. Pilih menu <b>PEMBAYARAN</b><br>
                                            3. Pilih menu <b>MULTIPAYMENT</b><br>
                                            4. Pilih kode institusi <b>PT Pos Indonesia</b><br>
                                            5. Masukan kode giro <?= @$get_topup_byid2->bank_prefix ?> dan nomor virtual account anda (Contoh : <b><?= @$get_topup_byid2->bank_prefix ?> <?= @$get_topup_byid2->topup_va ?></b>) dan <b>Nominal</b>, kemudian pilih lanjutkan<br>
                                            6. Komfirmasi pembayaran, lalu pilih lanjutkan<br>
                                            7. Gunakan Token untuk keamanan transaksi<br>
                                            8. Transaksi berhasil(bukti pembayaran disimpan apabila diperlukan)<br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="input_fields_wrap">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label style="margin-bottom: 10px">Catatan : </label>
                                        <br/>
                                        <span class="label pulse pulse-primary mr-10">
                                            <span class="position-relative">-</span>
                                            <span class="pulse-ring"></span>
                                        </span> <label style="margin-bottom: 20px">Minimum transaksi top up adalah Rp. 10.000</label>
                                        <br/>
                                        <span class="label pulse pulse-primary mr-10">
                                            <span class="position-relative">-</span>
                                            <span class="pulse-ring"></span>
                                        </span> <label style="margin-bottom: 20px">Penambahan saldo giro dikenakan bea admin sebesar Rp. 500</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        
                        
                        <div class="separator separator-dashed mb-5"></div>

                        <!--begin::Shape-->
                        <div class="position-absolute opacity-30">
                            <span class="svg-icon svg-icon-10x svg-logo-white">
                                <!--begin::Svg Icon | path:assets/media/svg/shapes/abstract-8.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" width="176" height="165" viewBox="0 0 176 165" fill="none">
                                    <g clip-path="url(#clip0)">
                                        <path d="M-10.001 135.168C-10.001 151.643 3.87924 165.001 20.9985 165.001C38.1196 165.001 51.998 151.643 51.998 135.168C51.998 118.691 38.1196 105.335 20.9985 105.335C3.87924 105.335 -10.001 118.691 -10.001 135.168Z" fill="#AD84FF" />
                                        <path d="M28.749 64.3117C28.749 78.7296 40.8927 90.4163 55.8745 90.4163C70.8563 90.4163 83 78.7296 83 64.3117C83 49.8954 70.8563 38.207 55.8745 38.207C40.8927 38.207 28.749 49.8954 28.749 64.3117Z" fill="#AD84FF" />
                                        <path d="M82.9996 120.249C82.9996 144.964 103.819 165 129.501 165C155.181 165 176 144.964 176 120.249C176 95.5342 155.181 75.5 129.501 75.5C103.819 75.5 82.9996 95.5342 82.9996 120.249Z" fill="#AD84FF" />
                                        <path d="M98.4976 23.2928C98.4976 43.8887 115.848 60.5856 137.249 60.5856C158.65 60.5856 176 43.8887 176 23.2928C176 2.69692 158.65 -14 137.249 -14C115.848 -14 98.4976 2.69692 98.4976 23.2928Z" fill="#AD84FF" />
                                        <path d="M-10.0011 8.37466C-10.0011 20.7322 0.409554 30.7493 13.2503 30.7493C26.0911 30.7493 36.5 20.7322 36.5 8.37466C36.5 -3.98287 26.0911 -14 13.2503 -14C0.409554 -14 -10.0011 -3.98287 -10.0011 8.37466Z" fill="#AD84FF" />
                                        <path d="M-2.24881 82.9565C-2.24881 87.0757 1.22081 90.4147 5.50108 90.4147C9.78135 90.4147 13.251 87.0757 13.251 82.9565C13.251 78.839 9.78135 75.5 5.50108 75.5C1.22081 75.5 -2.24881 78.839 -2.24881 82.9565Z" fill="#AD84FF" />
                                        <path d="M55.8744 12.1044C55.8744 18.2841 61.0788 23.2926 67.5001 23.2926C73.9196 23.2926 79.124 18.2841 79.124 12.1044C79.124 5.92653 73.9196 0.917969 67.5001 0.917969C61.0788 0.917969 55.8744 5.92653 55.8744 12.1044Z" fill="#AD84FF" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <!--end::Shape-->
                        <!--begin::Invoice header-->
                        <div class="row justify-content-center py-8 px-8 py-md-36 px-md-0 bg-primary">
                            <div class="col-md-9">
                                <div class="d-flex justify-content-between align-items-md-center flex-column flex-md-row">
                                    <div class="d-flex flex-column px-0 order-2 order-md-1">
                                        <!--begin::Logo-->
                                        <a href="javascript:;" class="mb-5 max-w-115px">
                                            <img alt="Logo" src="<?= base_url('/logo/stori-2.jpg');?>" class="logo-default max-h-60px" />
                                        </a>
                                        <!--end::Logo-->
                                        <span class="d-flex flex-column font-size-h5 font-weight-bold text-white">
                                            <span>Gedung Pos Ibukota Lt. 4,</span>
                                            <span>Jl. Lapangan Banteng Utara No. 1,</span>
                                            <span>Jakarta Pusat 10710</span>
                                        </span>
                                    </div>
                                    <h1 class="display-3 font-weight-boldest text-white order-1 order-md-2">TOP UP PAYMENT</h1>
                                </div>
                            </div>
                        </div>
                        <!--end::Invoice header-->
                        <div class="row justify-content-center py-8 px-8 py-md-30 px-md-0">
                            <div class="col-md-9">
                                <!--begin::Invoice body-->
                                <div class="row pb-26">
                                    <div class="col-md-3 border-right-md pr-md-10 py-md-10">
                                        <!--begin::Invoice To-->
                                        <div class="text-dark-50 font-size-lg font-weight-bold mb-3">PAYMENT TO.</div>
                                        <div class="font-size-lg font-weight-bold mb-10"><?= @$get_topup_byid2->owners_name ?>.
                                        <br /><?= @$get_topup_byid2->owners_address ?></div>
                                        <input type="hidden" id="topup_id" value="<?= @$get_topup_byid2->topup_id ?>">
                                        <!--end::Invoice To-->
                                        <!--begin::Invoice No-->
                                        <div class="text-dark-50 font-size-lg font-weight-bold mb-3">VA NUMBER.</div>
                                        <div class="font-size-lg font-weight-bold mb-10"><?= @$get_topup_byid2->bank_prefix ?><?= @$get_topup_byid2->topup_va ?></div>
                                        <!--end::Invoice No-->
                                        <!--begin::Invoice Date-->
                                        <div class="text-dark-50 font-size-lg font-weight-bold mb-3">DATE</div>
                                        <div class="font-size-lg font-weight-bold"><?= date("d M Y", strtotime(@$get_topup_byid2->created_date)) ?></div>
                                        <!--end::Invoice Date-->
                                    </div>
                                    <div class="col-md-9 py-10 pl-md-10">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th class="pt-1 pb-9 pl-0 pl-md-5 font-weight-bolder text-muted font-size-lg text-uppercase">Description</th>
                                                        <th class="pt-1 pb-9 text-right pr-0 font-weight-bolder text-muted font-size-lg text-uppercase">Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="font-weight-bolder border-bottom-0 font-size-lg">
                                                        <td class="border-top-0 pl-0 pl-md-5 py-4 d-flex align-items-center">
                                                        <span class="navi-icon mr-2">
                                                            <i class="fa fa-genderless text-primary font-size-h2"></i>
                                                        </span>Balance Top Up</td>
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">Rp. <?= number_format(@$get_topup_byid2->topup_amount) ?></td>
                                                    </tr>
                                                    <tr class="font-weight-bolder border-bottom-0 font-size-lg">
                                                        <td class="border-top-0 pl-0 pl-md-5 py-4 d-flex align-items-center">
                                                        <span class="navi-icon mr-2">
                                                            <i class="fa fa-genderless text-primary font-size-h2"></i>
                                                        </span>Admin Fee</td>
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">Rp. <?= number_format($get_topup_byid2->bank_admin) ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Invoice body-->
                                <!--begin::Invoice footer-->
                                <div class="row">
                                    <div class="col-md-5 border-top pt-14 pb-10 pb-md-18">
                                        <div class="d-flex flex-column flex-md-row">
                                            <div class="d-flex flex-column">
                                                <div class="font-weight-bold font-size-h6 mb-3">INFORMATION</div>
                                                <div class="d-flex justify-content-between font-size-lg mb-3">
                                                    <span class="font-weight-bold mr-15">Channel :</span>
                                                    <span class="text-right"><?= @$get_topup_byid2->bank_name ?></span>
                                                </div>
                                                <div class="d-flex justify-content-between font-size-lg mb-3">
                                                    <span class="font-weight-bold mr-15">Payment Method :</span>
                                                    <span class="text-right">Virtual Account</span>
                                                </div>
                                                <div class="d-flex justify-content-between font-size-lg">
                                                    <span class="font-weight-bold mr-15">VA Number:</span>
                                                    <span class="text-right"><?= @$get_topup_byid2->bank_prefix ?><?= @$get_topup_byid2->topup_va ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7 pt-md-25">
                                        <div class="bg-primary rounded d-flex align-items-center justify-content-between text-white max-w-350px position-relative ml-auto p-7">
                                            <!--begin::Shape-->
                                            <div class="position-absolute opacity-30 top-0 right-0">
                                                <span class="svg-icon svg-icon-2x svg-logo-white svg-icon-flip">
                                                    <!--begin::Svg Icon | path:assets/media/svg/shapes/abstract-8.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="176" height="165" viewBox="0 0 176 165" fill="none">
                                                        <g clip-path="url(#clip0)">
                                                            <path d="M-10.001 135.168C-10.001 151.643 3.87924 165.001 20.9985 165.001C38.1196 165.001 51.998 151.643 51.998 135.168C51.998 118.691 38.1196 105.335 20.9985 105.335C3.87924 105.335 -10.001 118.691 -10.001 135.168Z" fill="#AD84FF" />
                                                            <path d="M28.749 64.3117C28.749 78.7296 40.8927 90.4163 55.8745 90.4163C70.8563 90.4163 83 78.7296 83 64.3117C83 49.8954 70.8563 38.207 55.8745 38.207C40.8927 38.207 28.749 49.8954 28.749 64.3117Z" fill="#AD84FF" />
                                                            <path d="M82.9996 120.249C82.9996 144.964 103.819 165 129.501 165C155.181 165 176 144.964 176 120.249C176 95.5342 155.181 75.5 129.501 75.5C103.819 75.5 82.9996 95.5342 82.9996 120.249Z" fill="#AD84FF" />
                                                            <path d="M98.4976 23.2928C98.4976 43.8887 115.848 60.5856 137.249 60.5856C158.65 60.5856 176 43.8887 176 23.2928C176 2.69692 158.65 -14 137.249 -14C115.848 -14 98.4976 2.69692 98.4976 23.2928Z" fill="#AD84FF" />
                                                            <path d="M-10.0011 8.37466C-10.0011 20.7322 0.409554 30.7493 13.2503 30.7493C26.0911 30.7493 36.5 20.7322 36.5 8.37466C36.5 -3.98287 26.0911 -14 13.2503 -14C0.409554 -14 -10.0011 -3.98287 -10.0011 8.37466Z" fill="#AD84FF" />
                                                            <path d="M-2.24881 82.9565C-2.24881 87.0757 1.22081 90.4147 5.50108 90.4147C9.78135 90.4147 13.251 87.0757 13.251 82.9565C13.251 78.839 9.78135 75.5 5.50108 75.5C1.22081 75.5 -2.24881 78.839 -2.24881 82.9565Z" fill="#AD84FF" />
                                                            <path d="M55.8744 12.1044C55.8744 18.2841 61.0788 23.2926 67.5001 23.2926C73.9196 23.2926 79.124 18.2841 79.124 12.1044C79.124 5.92653 73.9196 0.917969 67.5001 0.917969C61.0788 0.917969 55.8744 5.92653 55.8744 12.1044Z" fill="#AD84FF" />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Shape-->
                                            <div class="font-weight-boldest font-size-h5">TOTAL AMOUNT</div>
                                            <div class="text-right d-flex flex-column">
                                                <span class="font-weight-boldest font-size-h3 line-height-sm">Rp. <?= number_format(@$get_topup_byid2->topup_amount + $get_topup_byid2->bank_admin) ?></span>
                                                <span class="font-size-sm">Taxes included</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Invoice footer-->
                            </div>
                        </div>
                        <!-- begin: Invoice action-->
                        <!-- <div class="row justify-content-center border-top py-8 px-8 py-md-28 px-md-0">
                            <div class="col-md-9">
                                <div class="d-flex font-size-sm flex-wrap">
                                    <button type="button" class="btn btn-primary font-weight-bolder py-4 mr-3 mr-sm-14 my-1" onclick="window.print();">Print Paymnet</button>
                                    <button type="button" class="btn btn-light-primary font-weight-bolder mr-3 my-1">Download</button>
                                </div>
                            </div>
                        </div> -->
                        <!-- end: Invoice action-->
                    </div>
                </div>
            </div>
            <!--end::Container-->
        </div>
    </div>
	<!--end::Entry-->
</div>
<!--end::Content-->
<script>
    var topup_id = document.getElementById("topup_id").value;
    // window.onload = function () {
    //     var fiveMinutes = 60 * 10,
    //     // var fiveMinutes = 60,
    //     display = document.querySelector('#time');
    //     startTimer(fiveMinutes, display);
    // };

    
    //     var fiveMinutes = 60 * 60,
    //     // var fiveMinutes = 60,
    //     display = document.querySelector('#time');
    //     startTimer(fiveMinutes, display);

    // function startTimer(duration, display) {
    //     var timer = duration, minutes, seconds;
    //     setInterval(function () {
    //         minutes = parseInt(timer / 60, 10);
    //         seconds = parseInt(timer % 60, 10);

    //         minutes = minutes < 10 ? "0" + minutes : minutes;
    //         seconds = seconds < 10 ? "0" + seconds : seconds;

    //         display.textContent = minutes + ":" + seconds;

    //         if (--timer < 0) {
    //             timer = duration;
    //         }

    //         if (minutes == 00 && seconds == 00) {
    //             var id = $('#customer_id').val();
    //             location.replace();
    //         }
    //     }, 1000);
    // }

    TargetDate = "<?= date("Y-m-d H:i:s", strtotime(@$get_topup_byid2->created_date . '+ 1 hours')) ?>";
    // TargetDate = "2031-12-31T05:00:00";
    BackColor = "palegreen";
    ForeColor = "navy";
    CountActive = true;
    CountStepper = -1;
    LeadingZero = true;
    // DisplayFormat = "%%D%% Days, %%H%% Hours, %%M%% Minutes, %%S%% Seconds.";
    DisplayFormat = "%%H%%:%%M%%:%%S%%";
    FinishMessage = "VA number expired";

    function calcage(secs, num1, num2) {
    s = ((Math.floor(secs/num1))%num2).toString();
    if (LeadingZero && s.length < 2)
        s = "0" + s;
    return "<b>" + s + "</b>";
    }

    function CountBack(secs) {
    if (secs < 0) {
        document.getElementById("cntdwn").innerHTML = FinishMessage;
        location.replace("<?php echo base_url("/topup/add"); ?>");
        return;
    }
    DisplayStr = DisplayFormat.replace(/%%D%%/g, calcage(secs,86400,100000));
    DisplayStr = DisplayStr.replace(/%%H%%/g, calcage(secs,3600,24));
    DisplayStr = DisplayStr.replace(/%%M%%/g, calcage(secs,60,60));
    DisplayStr = DisplayStr.replace(/%%S%%/g, calcage(secs,1,60));

    document.getElementById("cntdwn").innerHTML = DisplayStr;
    if (CountActive)
        setTimeout("CountBack(" + (secs+CountStepper) + ")", SetTimeOutPeriod);
    }

    function putspan(backcolor, forecolor) {
    document.write("<span id='cntdwn' style='background-color:" + backcolor + 
                    "; color:" + forecolor + "'></span>");
    }

    if (typeof(BackColor)=="undefined")
    BackColor = "white";
    if (typeof(ForeColor)=="undefined")
    ForeColor= "black";
    if (typeof(TargetDate)=="undefined")
    TargetDate = "<?= date("Y-m-d H:i:s", strtotime(@$get_topup_byid2->created_date . '+ 1 hours')) ?>";
    if (typeof(DisplayFormat)=="undefined")
    // DisplayFormat = "%%D%% Days, %%H%% Hours, %%M%% Minutes, %%S%% Seconds.";
    DisplayFormat = "%%H%%:%%M%%:%%S%%";
    if (typeof(CountActive)=="undefined")
    CountActive = true;
    if (typeof(FinishMessage)=="undefined")
    FinishMessage = "VA number expired";
    if (typeof(CountStepper)!="number")
    CountStepper = -1;
    if (typeof(LeadingZero)=="undefined")
    LeadingZero = true;


    CountStepper = Math.ceil(CountStepper);
    if (CountStepper == 0)
    CountActive = false;
    var SetTimeOutPeriod = (Math.abs(CountStepper)-1)*1000 + 990;
    putspan(BackColor, ForeColor);
    var dthen = new Date(TargetDate);
    var dnow = new Date();
    if(CountStepper>0)
    ddiff = new Date(dnow-dthen);
    else
    ddiff = new Date(dthen-dnow);
    gsecs = Math.floor(ddiff.valueOf()/1000);
    CountBack(gsecs);
</script>