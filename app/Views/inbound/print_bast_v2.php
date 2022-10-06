<!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <!-- <link href="../bower_components/paper/paper.css" rel="stylesheet"> -->
    <link href="<?= base_url(); ?>/theme/dist/assets/paper/paper.css" rel="stylesheet"
        type="text/css" />
    <style>
      table {
        font-family: tahoma;
      }
    </style>
  </head>

  <?php use App\Models\InboundModel; ?>
	<?php $this->inbound = new InboundModel(); ?>

  <body class="A4">
    <section class="sheet padding-10mm">
      <article>
        <table width='100%' class='t02'>
          <tr>
            <td width='20%'>
              <b><?=  $data_inbound->penerima ?></b><br>
              <?=  $data_inbound->address ?>
            </td>
            <td align='right' width='50%'><img src="<?= base_url(); ?>/logo/logo_poslog.png" width="130" height="75"></td>
          </tr>
        </table>
        <center><b>FORM INBOUND</b></center>
        <table width=100% id='t03' class='t02'>
          <tr>
            <td width='10%'>Tanggal</td>
            <?php $date = strtotime($data_inbound->tanggal); ?>
            <td>: <?= date('d M Y', $date) ?></td>
            <td width='10%'>Transpoter</td>
            <td>: <?=  $data_inbound->transpoter ?></td>
            <td width='10%'>Penerima</td>
            <td>: <?=  $data_inbound->penerima ?></td>
          </tr>
          <tr>
            <td>Nomor</td>
            <td>: <?=  $data_inbound->nomor ?></td>
            <td>No. Ext</td>
            <td>: <?= '-' ?></td>
            <td>Plat No.</td>
            <td>: <?=  $data_inbound->nopol ?></td>
          </tr>
          <tr>
            <td>Driver</td>
            <td>: <?=  $data_inbound->driver ?></td>
            <td>No. DO</td>
            <td>: <?=  $data_inbound->shipment ?></td>
          </tr>
        </table>
        <br>
        <table width=100% id='t04' class='t02'>
          <tr>
            <th rowspan="2" width='4%'>No</th>
            <th rowspan="2" width='30%'>Nama Produk</th>
            <th rowspan="2" width='6%'>Berat<BR>(KG)</th>
            <th rowspan="2" width='6%'>Qty</th>
            <th colspan="2">Kondisi Baik</th>
            <th colspan="2">Kondisi Rusak</th>
            <th rowspan="2">Location</th>
            <th rowspan="2">Ket</th>
          </tr>
          <tr>
            <th width='6%'>Berat<BR>(KG)</th>
            <th width='10%'>Qty</th>
            <th width='6%'>Berat<BR>(KG)</th>
            <th width='10%'>Qty</th>
          </tr>

          <!-- bagian 1 yang ditaro di notepad -->
          <?php
          $i = 1;
          $total_berat_all = $total_all = $total_berat_good = $total_good = $total_berat_ng = $total_ng = 0;
          $tot_pcs_good = 0;
          $tot_pcs_notgood = 0;
            foreach ($inbound_detail as $key => $value) {
                $inbound_detail2 = $value['detail'];
            ?>
                <tr>
                    <td align="center"><?php echo $i; ?></td>
                    <td colspan="9"><?= $value['name']  ?></td>
                    </tr>
            <?php
                foreach ($inbound_detail2 as $d) {

                    $berat = floatval($d->total_masuk) * floatval($d->material_weight);
                    $berat_good =  floatval($d->good) * floatval($d->material_weight);
                    $berat_ng =  floatval($d->ng) * floatval($d->material_weight);

                    $total_berat_all += $berat;
                    $total_all += $d->total_masuk;
                    $total_berat_good += $berat_good;
                    $total_good += $d->good;
                    $total_berat_ng += $berat_ng;
                    $total_ng += $d->ng;

                    $data_location = $this->inbound->get_shelf_byid($d->shelf_id);
          ?>
            <tr>
              <td align="center"></td>
              <td>Barcode : <?= $d->mat_detail_id?> <br/>(Batch: <?= $d->batch_no?> - exp. <?= date("m-d-Y", strtotime($d->expired_date))?>)</td>
              <td align="right"><?= number_format($berat, 1) ?></td>
              <td align="right"><?= number_format($d->total_masuk, 1) ?></td>
              <td align="right"><?= number_format($berat_good, 1) ?></td>
              <td align="right"><?= number_format($d->good, 1) ?></td>
              <td align="right"><?= number_format($berat_ng, 1) ?></td>
              <td align="right"><?= number_format($d->ng, 1) ?></td>
              <td><?= $data_location->shelf_name.'-'.$data_location->rak_name.'-'.$data_location->blok_name.'-'.$data_location->wh_area_name.'-'.$data_location->wh_name ?></td>
              <td><?= '-' ?></td>
            </tr>

          <?php
                
                }
                $i++;
            }
          ?>
          <?php
          for ($ii = 0; $ii < 24 - $i; $ii++) {
          ?>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          <?php
          }
          ?>
          <!-- bagian dua -->
          <tr>
            <th colspan="2" align="right">Total:</th>
            <th align="right"><?= number_format($total_berat_all, 2) ?></th>
            <th align="right"><?= number_format($total_all, 0) ?></th>
            <th align="right"><?= number_format($total_berat_good, 2) ?></th>
            <th align="right"><?= number_format($total_good, 0) ?></th>
            <th align="right"><?= number_format($total_berat_ng, 2) ?></th>
            <th align="right"><?= number_format($total_ng, 0) ?></th>
            <th></th>
            <th></th>
          </tr>
        </table>
        <br>
        <table width=100% id='t03' class='t02'>
          <tr>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td widtd='33%' align='center'>Diserahkan oleh:</td>
            <td widtd='33%' align='center'>Mengetahui:</td>
            <td widtd='33%' align='center'>Diterima oleh:</td>
          </tr>
          <tr>
            <td><br><br><br><br></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td align='center'>__________________________</td>
            <td align='center'>__________________________</td>
            <td align='center'>__________________________</td>
          </tr>
          <tr>
            <td>Telp.</td>
            <td>Telp.</td>
            <td>Telp.</td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </table>
      </article>
    </section>

  </body>

  </html>

<style>
  table.t02 td,
  th {
    padding: 2px;
    font-size: 12px;
  }

  table#t03 {

    border-collapse: collapse;
    border: 2px solid black;
  }

  table#t04 {
    border-collapse: collapse;
  }

  table#t04 td,
  th {
    border: 2px solid black;
  }
</style>