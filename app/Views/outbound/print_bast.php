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
        <table>
          <tr>
            <td width="130" height="90"></td>
            <td align='center'>
              <div style='width: 550px;'>
                <h4>BERITA ACARA SERAH TERIMA BARANG<BR><?= $data_outbound->customer_name ?></h4>
              </div>
            </td>
            <td align='right'><img src="<?= base_url(); ?>/logo/stori-2.jpg" width="130" height="75"></td>
          </tr>
          <tr>
            <td colspan='3'>
              <hr>
            </td>
          </tr>
        </table>
        <table width=100%>
          <tr>
            <td align='center' colspan='5'>
              <U>PENYERAHAN BARANG DARI GUDANG</U>
            </td>
            <td align='center' rowspan='3'>
              <!-- <?php
              //echo '<img src="qr.php?id=' . $id . '"/>';
              ?> -->
            </td>
          </tr>
          <tr>
            <td class='info2' width="14%">Nomor</td>
            <td class='info2' width="26%">: <?php echo $data_outbound->nomor ?></td>
            <td class='info2'>&nbsp;&nbsp;&nbsp;</td>
            <td class='info2' width="11%">Gd. Pengirim</td>
            <td class='info2'>: <?php echo $data_outbound->gd_pengirim ?></td>
          </tr>
          <tr>
            <td class='info2'>Tgl. Penyerahan</td>
            <td class='info2'>: <?php echo date('d-m-Y', strtotime($data_outbound->tgl_penyerahan)) ?></td>
            <td class='info2'>&nbsp;&nbsp;&nbsp;</td>
            <td class='info2'>Penerima</td>
            <td class='info2'>: <?php echo $data_outbound->transporter ?></td>
          </tr>
        </table>


        <br>
        <table border='2' id='t01' width='100%'>

          <thead>
            <tr>
              <th width='6%'>No</th>
              <th>Item</th>
              <th width='10%'>Jml item diserahkan ()</th>
              <th width='5%'>Kondisi</th>
              <th width='5%'>Cek<br>Isi<br>(Y/N)</th>
              <th width='30%'>Keterangan</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            foreach ($outbound_detail as $d) {
              $cek = '';
              if ($d->koli == 0) {
                $koli = '-';
              } else {
                $koli = number_format($d->lo_koli, 0);
              }
            ?>
              <tr>
                <td align='right'><?php echo $i ?></td>
                <td><?php echo $d->material_name . ' (' . $d->material_id . ')' ?></td>
                <td align='right'><?php echo number_format($d->total_keluar, 0) ?></td>
                <td align='center'>Baik</td>
                <td align='center'><?php echo $cek ?></td>
                <td></td>
              </tr>
            <?php
              $i++;
            } ?>
          </tbody>
        </table>
        <p style="font-size: 12px;"><i>
            Pihak yang menyerahkan dan Pihak yang menerima telah sepakat bahwa jumlah dan kondisi barang sesuai dengan detail rincian diatas
          </i></p>
        <br>
        <table width='100%'>
          <tr>
            <td class='info3' width='50%' align='center'>Diserahkan oleh:</td>
            <!-- <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td> -->
            <td class='info3' width='50%' align='center'>Diterima oleh:</td>
          </tr>
          <tr>
            <td class='info3' width='50%' align='center'>(Stori Enterprise)</td>
            <!-- <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td> -->
            <td class='info3' width='50%' align='center'>(<?= $data_outbound->transporter?>)</td>
          </tr>
          <tr>
            <td><br><br><br><br></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td class='info3' align='center'>Nama: _________________</td>
            <td class='info3' align='center'>Nama: _________________</td>
          </tr>
          <tr>
            <td class='info3'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Telp.</td>
            <td class='info3'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Telp.</td>
          </tr>
        </table>
        <br><br>

        <!-- <table width='100%'>
          <tr>
            <td class='info3' width='50%' align='center'></td>
            <td class='info3' width='33%' align='center'>Mengetahui/diverifikasi oleh:</td>
            
            <td class='info3' width='33%' align='center'></td>
          </tr>
          <tr>
            <td class='info3' width='33%' align='center'></td>
            <td class='info3' width='33%' align='center'>(Dinas Perindustrian & Perdagangan Pemerintah Prov. Jawa Barat)</td>
            
            <td class='info3' width='33%' align='center'></td>
          </tr>
          <tr>
            <td><br><br><br><br></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td class='info3' align='center'></td>
            <td class='info3' align='center'>Nama: _________________</td>
            <td class='info3' align='center'></td>
          </tr>
          <tr>
            <td class='info3'></td>
            <td class='info3'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (Divisi Logistik GTPP Covid-19)</td>
            <td class='info3'></td>
          </tr>
        </table> -->
        <br><br>

        
      </article>
    </section>

  </body>

  </html>

<style>
  table#t01 {
    border-collapse: collapse;
    width: 100%;
    border: 2px solid black;
  }

  /* table#t01 th {
    background-color: black;
    color: white;
  } */

  table#t01 td,
  th {
    padding: 2px;
    font-size: 11px;
    border: 2px solid black;
  }

  table#t02 td,
  th {
    padding: 3px;
    font-size: 11px;
  }

  td.info {
    padding: 4px;
    font-size: 14px;
    vertical-align: top;
    text-align: left;
  }

  td.info2 {
    padding: 2px;
    font-size: 12px;
    vertical-align: top;
    text-align: left;
  }

  td.info3 {
    padding: 2px;
    font-size: 12px;
  }
</style>