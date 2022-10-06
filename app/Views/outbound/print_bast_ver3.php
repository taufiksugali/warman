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
              <b><?=  $data_outbound->customer_name ?></b><br>
              <?=  $data_outbound->customer_address ?>, 
            </td>
            <td align='right' width='50%'><img src="<?= base_url(); ?>/logo/logo_poslog.png" width="130" height="75"></td>
          </tr>
        </table>
        <center><b>FORM BAST</b></center>
        <table width=100% id='t03' class='t02'>
          <tr>
            <td width='10%'>Tanggal</td>
            <?php $date = strtotime($data_outbound->tgl_penyerahan); ?>
            <td>: <?= date('d M Y', $date) ?></td>
            <td width='10%'>Transpoter</td>
            <td>: <?=  $data_outbound->outbound_transpoter ?></td>
            <td width='10%'>Penerima</td>
            <td>: <?=  $data_outbound->customer_name ?></td>
          </tr>
          <tr>
            <td>Nomor</td>
            <td>: <?=  $data_outbound->nomor ?></td>
            <td>No. Ext</td>
            <td>: <?= '-' ?></td>
            <td>Plat No.</td>
            <td>: <?=  $data_outbound->license_plate ?></td>
          </tr>
          <tr>
            <td>Driver</td>
            <td>: <?=  $data_outbound->outbound_driver ?></td>
            <td>No. DO</td>
            <td>: </td>
          </tr>
        </table>
        <br>
        <table width=100% id='t04' class='t02'>
          <tr>
            <th rowspan="2" width='4%'>No</th>
            <th rowspan="2" width='40%'>Nama Produk</th>
            <th rowspan="2" width='15%'>Qty<BR>(BAG)</th>
            <th rowspan="2" width='10%'>Cek Isi(Y/N)</th>
            <th rowspan="2">Ket</th>
          </tr>
          <tr>
          </tr>
          <?php 
          $i = 1;
          foreach ($outbound_detail as $key => $value) {?>
          <tr>
            <td align="center"><?php echo $i; ?></td>
            <td align="right"><?php echo $value->material_name ?></td>
            <td align="right"><?php echo $value->total_keluar ?></td>
            <td align="right"></td>
            <td align="right"></td>
          </tr>
          <?php $i++;}?>
          <?php
          for ($ii = 0; $ii < 24 - $i; $ii++) {
          ?>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          <?php
          }
          ?>
          <tr>
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