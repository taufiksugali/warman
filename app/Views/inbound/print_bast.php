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

  <body class="A4">


    <section class="sheet padding-10mm">
      <article>
        <table width='100%' class='t02'>
          <tr>
            <td width='20%'>
              <b><?=  $data_inbound->penerima ?></b><br>
              <?=  $data_inbound->address ?>
            </td>
            <td align='right' width='50%'><img src="<?= base_url(); ?>/logo/stori-2.jpg" width="130" height="75"></td>
          </tr>
        </table>
        <center><b>FORM CHECKLIST INBOUND</b></center>
        <table width=100% id='t03' class='t02'>
          <tr>
            <td width='10%'>Tanggal</td>
            <?php $date = strtotime($data_inbound->tanggal); ?>
            <td>: <?= date('d M Y', $date) ?></td>
            <td width='10%'>Pengirim</td>
            <td>: <?=  $data_inbound->pengirim ?></td>
            <td width='10%'>Penerima</td>
            <td>: <?=  $data_inbound->penerima ?></td>
          </tr>
          <tr>
            <td>Nomor</td>
            <td>: <?=  $data_inbound->nomor ?></td>
            <td>No. Ext</td>
            <td>: <?= '-' ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
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

          foreach ($inbound_detail as $d) {
            // $cek = '';
            // if ($d['cek'] == '0') {
            //   $cek = 'No';
            // } else if ($d['cek'] == '1') {
            //   $cek = 'Yes';
            // }

            // $po_qty = $d['qty_good_in'] + $d['qty_notgood_in'];
            // $dus = $d['dus'];
            // $kotak = $d['kotak'];
            // $bungkus = $d['bungkus'];
            // $biskuit = $d['biskuit'];
            // $arr = konversi_biskuit($po_qty, $dus, $kotak, $bungkus, $biskuit);

            // $bks = "";
            // if ($arr['biskuit'] > 0) {
            //   $bks .= $arr['bungkus'] . " Bks + <BR>" .
            //     $arr['biskuit'] . " Keping";
            // } else {
            //   $bks = $arr['bungkus'];
            // }

            // $qty_good_in = $d['qty_good_in'];
            // $arr2 = konversi_biskuit($qty_good_in, $dus, $kotak, $bungkus, $biskuit);
            // $qty_good_in_str =
            //   "- " . $arr2['dus'] . " Dus<BR>" .
            //   "- " . $arr2['kotak'] . " Kotak<BR>" .
            //   "- " . $arr2['bungkus'] . " Bks<BR>" .
            //   "- " . $arr2['biskuit'] . " Keping";

            // $tot_dus_good += $arr2['dus'];
            // $tot_kotak_good += $arr2['kotak'];
            // $tot_bks_good += $arr2['bungkus'];
            // $tot_pcs_good += $arr2['biskuit'];

            // $qty_notgood_in = $d['qty_notgood_in'];
            // $arr3 = konversi_biskuit($qty_notgood_in, $dus, $kotak, $bungkus, $biskuit);
            // $qty_notgood_in_str =
            //   "- " . $arr3['dus'] . " Dus<BR>" .
            //   "- " . $arr3['kotak'] . " Kotak<BR>" .
            //   "- " . $arr3['bungkus'] . " Bks<BR>" .
            //   "- " . $arr3['biskuit'] . " Keping";

            // $tot_dus_notgood += $arr3['dus'];
            // $tot_kotak_notgood += $arr3['kotak'];
            // $tot_bks_notgood += $arr3['bungkus'];
            // $tot_pcs_notgood += $arr3['biskuit'];

            // $total_berat += $po_qty;
            // $total_dus += $arr['dus'];
            // $total_kotak += $arr['kotak'];
            // $total_bungkus += $arr['bungkus'];
            // $total_baik += $d['qty_good_in'];
            // $total_rusak += $d['qty_notgood_in'];
            // print_r($d);
            // die;
              $berat = floatval($d->total_masuk) * floatval($d->material_weight);
              $berat_good =  floatval($d->good) * floatval($d->material_weight);
              $berat_ng =  floatval($d->ng) * floatval($d->material_weight);

              $total_berat_all += $berat;
              $total_all += $d->total_masuk;
              $total_berat_good += $berat_good;
              $total_good += $d->good;
              $total_berat_ng += $berat_ng;
              $total_ng += $d->ng;
          ?>
            <tr>
              <td align="center"><?php echo $i; ?></td>
              <td><?= $d->nama_produk  ?></td>
              <td align="right"><?= number_format($berat, 1) ?></td>
              <td align="right"><?= number_format($d->total_masuk, 1) ?></td>
              <td align="right"><?= number_format($berat_good, 1) ?></td>
              <td align="right"><?= number_format($d->good, 1) ?></td>
              <td align="right"><?= number_format($berat_ng, 1) ?></td>
              <td align="right"><?= number_format($d->ng, 1) ?></td>
              <td><?= '-' ?></td>
            </tr>

          <?php
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