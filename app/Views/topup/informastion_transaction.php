<?php if (@$bank_dest_account->dest_id == 2) { ?>
<label style="margin-bottom: 10px"><strong>INSTRUCTION</strong></label>
<div class="form-group row">
    <div class="col-6">
        <label style="margin-bottom: 10px"><?= (@$bank_dest_account->dest_name != NULL ? @$bank_dest_account->dest_name : 'Choose to Account') ?></label>
        <br/>
        <span class="label pulse pulse-primary mr-10">
            <span class="position-relative">1</span>
            <span class="pulse-ring"></span>
        </span> <label style="margin-bottom: 20px">Masuk ke aplikasi pospay menggunakan akun anda</label>
        <br/>
        <span class="label pulse pulse-primary mr-10">
            <span class="position-relative">2</span>
            <span class="pulse-ring"></span>
        </span> <label style="margin-bottom: 20px">Pilih menu <b>Transfer</b></label>
        <br/>
        <span class="label pulse pulse-primary mr-10">
            <span class="position-relative">3</span>
            <span class="pulse-ring"></span>
        </span> <label style="margin-bottom: 20px">Pilih Bank <b>Tujuan</b></label>
    </div>
    <div class="col-6">
        <label style="margin-bottom: 10px">&nbsp;</label>
        <br/>
        <span class="label pulse pulse-primary mr-10">
            <span class="position-relative">4</span>
            <span class="pulse-ring"></span>
        </span> <label style="margin-bottom: 20px">Masukkan no. rek <b>(<?= (@$bank_dest_account->dest_account != NULL ? @$bank_dest_account->dest_account : 'nomor rekening poslog') ?>)</b></label>
        <br/>
        <span class="label pulse pulse-primary mr-10">
            <span class="position-relative">5</span>
            <span class="pulse-ring"></span>
        </span> <label id="no_rek" style="margin-bottom: 20px">Isikan nominal yang ingin di transfer</label>
        <br/>
        <span class="label pulse pulse-primary mr-10">
            <span class="position-relative">6</span>
            <span class="pulse-ring"></span>
        </span> <label id="" style="margin-bottom: 20px">Ikuti instruksi untuk menyelesaikan transaksi</label>
    </div>
</div>
<?php } ?>

<?php if (@$bank_dest_account->dest_id == 5) { ?>
<label style="margin-bottom: 10px"><strong>INSTRUCTION</strong></label>
<div class="form-group row">
    <div class="col-6">
        <label style="margin-bottom: 10px"><?= (@$bank_dest_account->dest_name != NULL ? @$bank_dest_account->dest_name : 'Choose to Account') ?></label>
        <br/>
        <span class="label pulse pulse-primary mr-10">
            <span class="position-relative">1</span>
            <span class="pulse-ring"></span>
        </span> <label style="margin-bottom: 20px">Masukan kartu ATM dan PIN Anda</label>
        <br/>
        <span class="label pulse pulse-primary mr-10">
            <span class="position-relative">2</span>
            <span class="pulse-ring"></span>
        </span> <label style="margin-bottom: 20px">Pilih menu <b>Transaksi Lainnya</b></label>
        <br/>
        <span class="label pulse pulse-primary mr-10">
            <span class="position-relative">3</span>
            <span class="pulse-ring"></span>
        </span> <label style="margin-bottom: 20px">Pilih menu <b>Transfer</b></label>
    </div>
    <div class="col-6">
        <label style="margin-bottom: 10px">&nbsp;</label>
        <br/>
        <span class="label pulse pulse-primary mr-10">
            <span class="position-relative">4</span>
            <span class="pulse-ring"></span>
        </span> <label style="margin-bottom: 20px">Pilih menu <b>Ke Rekening / Ke Rekening Lainnya</b></label>
        <br/>
        <span class="label pulse pulse-primary mr-10">
            <span class="position-relative">5</span>
            <span class="pulse-ring"></span>
        </span> <label id="no_rek" style="margin-bottom: 20px">Masukkan no. rek <b>(<?= (@$bank_dest_account->dest_account != NULL ? @$bank_dest_account->dest_account : 'nomor rekening poslog') ?>)</b></label>
        <br/>
        <span class="label pulse pulse-primary mr-10">
            <span class="position-relative">6</span>
            <span class="pulse-ring"></span>
        </span> <label id="" style="margin-bottom: 20px">Ikuti instruksi untuk menyelesaikan transaksi</label>
    </div>
</div>
<?php } ?>