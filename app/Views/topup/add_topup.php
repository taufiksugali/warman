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
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">Top Up</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-6">
                                    <label>Current Balance <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                Rp.
                                            </span>
                                        </div>
                                        <input type="text" readonly name="owners_name" autocomplete="off" class="form-control form-control-solid <?= ($validation->getError('owners_id')) ? 'is-invalid' : ''; ?>" value="<?= number_format($this->owner->get_owner_byid(session()->get('owners_id'))->owners_balance) ?>" placeholder="Enter code" />
                                    </div>
                                    <?php if($validation->getError('owners_id')){ echo '<div class="invalid-feedback">'.$validation->getError('owners_id').'</div>'; } ?>
                                </div>
                                <div class="col-6">
                                    <label>Top Up Method <span class="text-danger">*</span></label>
                                    <select class="form-control select select2 <?= ($validation->getError('type_topup')) ? 'is-invalid' : ''; ?>" value="<?= old('type_topup'); ?>" name="type_topup" id="type_topup" onchange="TforVa()" required>
                                        <option value="" selected></option>
                                        <option value="Transfer">Bank Transfer</option>
                                        <option value="Virtual Account">Virtual Account</option>
                                    </select>
                                    <?php if($validation->getError('bank_id')){ echo '<div class="invalid-feedback">'.$validation->getError('bank_id').'</div>'; } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Virtual Account -->
            <div class="row" id="virtual_account">
                <div class="col-md-12">
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">Top Up Instruction</h3>
                        </div>
                        <div class="card-body">
                            <div class="input_fields_wrap">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <span class="label pulse pulse-primary mr-10">
                                            <span class="position-relative">-</span>
                                            <span class="pulse-ring"></span>
                                        </span> <label style="margin-bottom: 10px; font-size: 15px"><b>Your Va Number : <?= session()->get('owners_va_number') ?></b></label>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion accordion-toggle-arrow" id="accordionExample1">
                                <?php foreach (@$bank as $key => $value) { ?>

                                <!-- Kantor Pos -->
                                <?php if ($value->bank_id == 1) { ?>
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#Topupm<?= $value->bank_id ?>"><?= $value->bank_name ?></div>
                                    </div>
                                    <div id="Topupm<?= $value->bank_id ?>" class="collapse" data-parent="#accordionExample1">
                                        <div class="card-body">
                                            1. Data ke <b><?= $value->bank_name ?></b> terdekat<br>
                                            2. Ambil formulir penambahan saldo<br>
                                            3. Isikan <b><?= session()->get('owners_va_number') ?></b> sebagai rekening tujuan<br>
                                            4. Siapkan jumlah top up yang ingin dibayarkan<br>
                                            5. Berikan formulir dan uang kepada petugas<br><br>
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
                                    </div>
                                </div>
                                <?php } ?>

                                <!-- Pospay -->
                                <?php if ($value->bank_id == 2) { ?>
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#Topupm<?= $value->bank_id ?>"><?= $value->bank_name ?></div>
                                    </div>
                                    <div id="Topupm<?= $value->bank_id ?>" class="collapse" data-parent="#accordionExample1">
                                        <div class="card-body">
                                            1. Masuk ke aplikasi <b><?= $value->bank_name ?></b><br>
                                            2. Masuk ke <b>Fitur Utama > Pilih Menu Lainnya > Banking > Virtual Account</b><br>
                                            3. Masukan nomor virtual account anda <b><?= session()->get('owners_va_number') ?></b><br>
                                            4. Ikuti instruksi untuk menyelesaikan transaksi<br>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>

                                <!-- BANK BCA -->
                                <?php if ($value->bank_id == 3) { ?>
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#TopupmATM<?= $value->bank_id ?>">ATM <?= @$value->bank_name ?></div>
                                    </div>
                                    <div id="TopupmATM<?= $value->bank_id ?>" class="collapse" data-parent="#accordionExample1">
                                        <div class="card-body">
                                            1. Masukan kartu ATM dan PIN <?= $value->bank_name ?> Anda<br>
                                            2. Pilih menu <b>TRANSFER ANTAR <?= $value->bank_name ?></b><br>
                                            3. Masukan kode giro <?= @$value->bank_prefix ?> dan nomor virtual account anda (Contoh : <b><?= @$value->bank_prefix ?> <?= session()->get('owners_va_number') ?></b>)<br>
                                            4. Masukan jumlah top up yang ingin dibayarkan<br>
                                            5. Ikuti intruksi untuk menyelesaikan transaksi<br><br>
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
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#TopupmKLIK<?= $value->bank_id ?>">KLIK <?= @$value->bank_name ?></div>
                                    </div>
                                    <div id="TopupmKLIK<?= $value->bank_id ?>" class="collapse" data-parent="#accordionExample1">
                                        <div class="card-body">
                                            1. Masuk ke website <b>KLIK <?= @$value->bank_name ?></b><br>
                                            2. Pilih menu <b>TRANSAKSI DANA > TRANSFER KE BCA VIRTUAL ACCOUNT</b><br>
                                            3. Masukan kode giro <?= @$value->bank_prefix ?> dan nomor virtual account anda (Contoh : <b><?= @$value->bank_prefix ?> <?= session()->get('owners_va_number') ?></b>)<br>
                                            4. Masukan jumlah top up yang ingin dibayarkan<br>
                                            5. Ikuti intruksi untuk menyelesaikan transaksi<br><br>
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
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#TopupmMBCA<?= $value->bank_id ?>">m-BCA (BCA MOBILE)</div>
                                    </div>
                                    <div id="TopupmMBCA<?= $value->bank_id ?>" class="collapse" data-parent="#accordionExample1">
                                        <div class="card-body">
                                            1. Masuk ke aplikasi mobile <b>m-<?= @$value->bank_name ?></b><br>
                                            2. Pilih menu <b>M-TRANSFER > <?= @$value->bank_name ?> VIRTUAL ACCOUNT</b><br>
                                            3. Masukan kode giro <?= @$value->bank_prefix ?> dan nomor virtual account anda (Contoh : <b><?= @$value->bank_prefix ?> <?= session()->get('owners_va_number') ?></b>)<br>
                                            4. Masukan jumlah top up yang ingin dibayarkan<br>
                                            5. Masukan <b>PIN m-<?= @$value->bank_name ?></b><br>
                                            6. Ikuti intruksi untuk menyelesaikan transaksi<br><br>
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
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#TopupmSTKSIM<?= $value->bank_id ?>">m-BCA (STK - SIM Tool Kit)</div>
                                    </div>
                                    <div id="TopupmSTKSIM<?= $value->bank_id ?>" class="collapse" data-parent="#accordionExample1">
                                        <div class="card-body">
                                            1. Pilih menu <b>m-<?= @$value->bank_name ?></b> pada menu SIM Card Anda<br>
                                            2. Pilih menu <b>TRANSFER > ANTAR <?= @$value->bank_name ?></b><br>
                                            3. Masukan kode giro <?= @$value->bank_prefix ?> dan nomor virtual account anda (Contoh : <b><?= @$value->bank_prefix ?> <?= session()->get('owners_va_number') ?></b>)<br>
                                            4. Masukan <b>PIN <?= @$value->bank_name ?></b> Lalu Tekan OK<br>
                                            5. Masukan jumlah top up yang ingin dibayarkan<br>
                                            6. Masukan <b>PIN <?= @$value->bank_name ?></b> Lalu Tekan OK<br>
                                            7. Ikuti intruksi untuk menyelesaikan transaksi<br><br>
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
                                    </div>
                                </div>
                                <?php } ?>

                                <!-- BANK BNI -->
                                <?php if ($value->bank_id == 4) { ?>
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#TopupmBNIATM<?= $value->bank_id ?>">ATM <?= @$value->bank_name ?></div>
                                    </div>
                                    <div id="TopupmBNIATM<?= $value->bank_id ?>" class="collapse" data-parent="#accordionExample1">
                                        <div class="card-body">
                                            1. Masukan kartu ATM dan PIN <?= @$value->bank_name ?> Anda<br>
                                            2. Pilih menu <b>TRANSFER ANTAR <?= @$value->bank_name ?></b><br>
                                            3. Masukan kode giro <?= @$value->bank_prefix ?> dan nomor virtual account anda (Contoh : <b><?= @$value->bank_prefix ?><?= session()->get('owners_va_number') ?></b>)<br>
                                            4. Masukan jumlah top up yang ingin dibayarkan<br>
                                            5. Ikuti intruksi untuk menyelesaikan transaksi<br><br>
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
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#TopupmBNIIBB<?= $value->bank_id ?>">Internet Banking BNI</div>
                                    </div>
                                    <div id="TopupmBNIIBB<?= $value->bank_id ?>" class="collapse" data-parent="#accordionExample1">
                                        <div class="card-body">
                                            1. Masuk ke website <b>INTERNET BANKING BNI</b><br>
                                            2. Pilih menu <b>TRANSAKSI > TRANSFER ANTAR BNI</b><br>
                                            3. Masukan kode giro <?= @$value->bank_prefix ?> dan nomor virtual account anda (Contoh : <b><?= @$value->bank_prefix ?> <?= session()->get('owners_va_number') ?></b>)<br>
                                            4. Masukan jumlah top up yang ingin dibayarkan<br>
                                            5. Ikuti intruksi untuk menyelesaikan transaksi<br><br>
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
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#TopupmBNISMS<?= $value->bank_id ?>">SMS BANKING (BNI MOBILE)</div>
                                    </div>
                                    <div id="TopupmBNISMS<?= $value->bank_id ?>" class="collapse" data-parent="#accordionExample1">
                                        <div class="card-body">
                                            1. Masuk ke aplikasi mobile <b>BNI SMS BANKING</b><br>
                                            2. Pilih menu <b>TRANSFER > TRANSFER ANTAR BNI</b><br>
                                            3. Masukan kode giro <?= @$value->bank_prefix ?> dan nomor virtual account anda (Contoh : <b><?= @$value->bank_prefix ?> <?= session()->get('owners_va_number') ?></b>)<br>
                                            4. Masukan jumlah top up yang ingin dibayarkan<br>
                                            5. Ikuti intruksi untuk menyelesaikan transaksi<br><br>
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
                                    </div>
                                </div>
                                <?php } ?>

                                <!-- BANK MANDIRI -->
                                <?php if ($value->bank_id == 5) { ?>
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne1">ATM <?= @$value->bank_name ?></div>
                                    </div>
                                    <div id="collapseOne1" class="collapse" data-parent="#accordionExample1">
                                        <div class="card-body">
                                            1. Masukan kartu ATM dan PIN <?= @$value->bank_name ?> Anda<br>
                                            2. Pilih menu <b>BAYAR / BELI</b><br>
                                            3. Pilih menu <b>MULTIPAYMENT</b><br>
                                            4. Pilih kode institusi <b>PT Pos Indonesia</b><br>
                                            5. Ketik kode perusahaan <b>"<?= @$value->bank_prefix ?>" (POS INDONESIA)</b> ATAU<br>
                                            6. Ketik <b>DAFTAR KODE</b> untuk mencari kode <b>POS INDONESIA</b> yaitu <b><?= @$value->bank_prefix ?></b><br>
                                            7. Isi kode giro <?= @$value->bank_prefix ?> dan nomor virtual account anda kemudian tekan BENAR (Contoh : <b><?= @$value->bank_prefix ?><?= session()->get('owners_va_number') ?></b>)<br>
                                            8. Muncul konfirmasi data customer, Pilih <b>Nomor 1</b> sesuai tagihan yang akan dibayarkan, Tekan <b>YA</b> untuk melakukan pembayaran<br>
                                            9. Muncul konfirmasi pembayaran, Tekan <b>YA</b> untuk melakukan pembayaran<br>
                                            10. Bukti pembayaran dalam bentuk STRUK agar disimpan sebagai bukti pembayaran yang sah dari bank Mandiri<br><br>
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
                                            5. Masukan kode giro <?= @$value->bank_prefix ?> dan nomor virtual account anda (Contoh : <b><?= @$value->bank_prefix ?> <?= session()->get('owners_va_number') ?></b>) dan <b>Nominal</b>, kemudian pilih lanjutkan<br>
                                            6. Komfirmasi pembayaran, lalu pilih lanjutkan<br>
                                            7. Gunakan Token untuk keamanan transaksi<br>
                                            8. Transaksi berhasil(bukti pembayaran disimpan apabila diperlukan)<br><br>
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
                                    </div>
                                </div>
                                <?php } ?>

                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Transfer -->
            <div class="row" id="transfer">
                <div class="col-md-12">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">Top Up Form</h3>
                        </div>
                        <?= session()->getFlashdata('message'); ?>
                        <?php if (@$owners_bank == NULL) { ?>
                            <div class="alert alert-custom alert-light-warning fade show mb-5" role="alert">
                                <div class="alert-icon"><i class="flaticon-warning"></i>
                            </div>
                            <div class="alert-text">Your bank account is not yet available, please complete it in <a href="<?= base_url('owners/editSeller/'.session()->get('owners_id')) ?>">your profile</a> first.</div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div>
                            </div>
                        <?php } ?>
                        <form method="post" class="form" enctype='multipart/form-data' action="<?php echo base_url('topup/create'); ?>">
                        <!--begin::Form-->
                            <div class="card-body">
                                <div class="input_fields_wrap">
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label>From Account <span class="text-danger">*</span></label>
                                            <select class="form-control select select2 <?= ($validation->getError('bank_id')) ? 'is-invalid' : ''; ?>" value="<?= old('bank_id'); ?>" name="bank_id" id="bank_id" onchange="getBankAccountUser()">
                                                <option value="" selected></option>
                                                <?php foreach(@$owners_bank as $row) { ?>
                                                <option value="<?= @$row->owners_bank_id; ?>"><?= @$row->bank_name; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php if($validation->getError('bank_id')){ echo '<div class="invalid-feedback">'.$validation->getError('bank_id').'</div>'; } ?>
                                        </div>
                                        <div class="col-6">
                                            <label>To Account <span class="text-danger">*</span></label>
                                            <select class="form-control select select2 <?= ($validation->getError('dest_account')) ? 'is-invalid' : ''; ?>" value="<?= old('dest_account'); ?>" id="dest_account" name="dest_account" onchange="getBankTransaction()">
                                                <option value="" selected></option>
                                                <?php foreach(@$bank_dest as $row) { ?>
                                                <option value="<?= @$row->dest_id; ?>" data-id="<?= "".@$row->dest_account."" ?>"><?= @$row->dest_name; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php if($validation->getError('dest_account')){ echo '<div class="invalid-feedback">'.$validation->getError('dest_account').'</div>'; } ?>
                                        </div>
                                    </div>
                                    <div id="information-bank">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label>Date <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="kt_datepicker_huhu" readonly="readonly" name="topup_date" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="la la-calendar-check-o"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <?php if($validation->getError('topup_date')){ echo '<div class="invalid-feedback">'.$validation->getError('topup_date').'</div>'; } ?>
                                        </div>
                                        <div class="col-4">
                                            <label>Amount <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        Rp.
                                                    </span>
                                                </div>
                                            <input type="text" name="topup_amount" autocomplete="off" class="form-control <?= ($validation->getError('topup_amount')) ? 'is-invalid' : ''; ?>"  onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this);"  />
                                            </div>
                                            <?php if($validation->getError('topup_amount')){ echo '<div class="invalid-feedback">'.$validation->getError('topup_amount').'</div>'; } ?>
                                        </div>
                                        <div class="col-4">
                                            <label>Proof of Payment <span class="text-danger">*</span></label>
                                            <div class="custom-file">
                                                <input type="file" name="topup_proof"class="custom-file-input" id="customFile">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                            <?php if($validation->getError('topup_proof')){ echo '<div class="invalid-feedback">'.$validation->getError('topup_proof').'</div>'; } ?>
                                        </div>
                                    </div>
                                    <div id="information_transaction"></div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info mr-2">Top Up</button>
                                <a href="<?= base_url('dashboard_seller'); ?>" class="btn btn-secondary"  type="reset" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">History</h3>
                        </div>
                        <!--begin::Form-->
                        <div class="card-body">
                            <label><strong>Top Up History </strong></label>
                            <table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
                                <thead>
                                    <th data-orderable="false">No</th>
                                    <th data-orderable="false">Status</th>
                                    <th>Payment Method</th>
                                    <th>From Account</th>
                                    <th>To Account</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Top Up Proof</th>
                                </thead>
                                <tbody>
                                    <?php if (@$topup) :
                                        $no = 0;
                                        foreach ($topup as $row) :
                                        $no++; 
                                        if(@$row->topup_status == 1) {
                                            $topup_status = '<span class="label label-light-success label-pill label-inline mr-2">Approved</span>';
                                        } elseif(@$row->topup_status == 2) {
                                            $topup_status = '<span class="label label-light-danger label-pill label-inline mr-2">Rejected</span>';
                                        } elseif (@$row->topup_status == 3) {
                                            $topup_status = '<span class="label label-light-danger label-pill label-inline mr-2">Expired</span>';
                                        } else { 
                                            $topup_status = '<span class="label label-light-warning label-pill label-inline mr-2">Waiting</span>';
                                        }
                                    ?>
                                    <tr>
                                        <td class="text-center"><?= $no ?></td>
                                        <td><?= $topup_status ?></td>
                                        <td><?= (@$row->topup_va != NULL ? 'Virtual Account' : 'Bank Transfer') ?></td>
                                        <td><?= @$row->bank_name ?></td>
                                        <td><?= @$row->dest_name ?></td>
                                        <td>Rp. <?= number_format(@$row->topup_amount) ?></td>
                                        <td><?= date_format(date_create(@$row->created_date), 'd-m-Y') ?></td>
                                        <td class="text-center">
                                            <?php if(@$row->topup_proof != NULL){?>
                                                <a href="<?= base_url('../../../images/topup-proof/'.@$row->owners_id.'/'.$row->topup_proof)?>" target="_blank" class="btn btn-sm btn-clean btn-icon mr-1" title="View Proof"><span class="svg-icon svg-icon-primary svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24"/>
                                                        <rect fill="#000000" opacity="0.3" x="2" y="4" width="20" height="16" rx="2"/>
                                                        <polygon fill="#000000" opacity="0.3" points="4 20 10.5 11 17 20"/>
                                                        <polygon fill="#000000" points="11 20 15.5 14 20 20"/>
                                                        <circle fill="#000000" opacity="0.3" cx="18.5" cy="8.5" r="1.5"/>
                                                    </g>
                                                </svg></span></a>
                                            <?php }?>

                                            <?php if (@$row->topup_va != NULL && @$row->topup_status == 0) { ?>
                                            <a href="<?= base_url('topup/invoice?idva='.@$row->topup_id) ?>" class="btn btn-sm btn-clean btn-icon mr-1" title="Invoice" target="_blank"><span class="svg-icon svg-icon-warning svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/><path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/><rect fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2" rx="1"/><rect fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2" rx="1"/></g></svg></span></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>
                                <tbody>
                            </table>
                        </div>
                        <div class="card-footer text-center">
                            
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Container-->
        </div>
    </div>
	<!--end::Entry-->
</div>
<!--end::Content-->
