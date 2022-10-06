<!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <!-- <link href="../bower_components/paper/paper.css" rel="stylesheet"> -->
    <link href="<?= base_url(); ?>/theme/dist/assets/paper/paper.css" rel="stylesheet"
        type="text/css" />
        <meta name="description" content="Aside light theme example" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="canonical" href="https://keenthemes.com/metronic" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="<?= base_url(); ?>/theme/dist/assets/plugins/global/plugins.bundle.css" rel="stylesheet"
        type="text/css" />
    <link href="<?= base_url(); ?>/theme/dist/assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet"
        type="text/css" />
    <link href="<?= base_url(); ?>/theme/dist/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="<?= base_url(); ?>/theme/dist/assets/css/themes/layout/header/base/light.css" rel="stylesheet"
        type="text/css" />
    <link href="<?= base_url(); ?>/theme/dist/assets/css/themes/layout/header/menu/dark.css" rel="stylesheet"
        type="text/css" />
    <link href="<?= base_url(); ?>/theme/dist/assets/css/themes/layout/brand/dark.css" rel="stylesheet"
        type="text/css" />
    <link href="<?= base_url(); ?>/theme/dist/assets/css/themes/layout/aside/dark.css" rel="stylesheet"
        type="text/css" />
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="<?= base_url(); ?>/theme/dist/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet"
        type="text/css" />
    <!--end::Layout Themes-->
    <!-- chart js -->
    <script src="<?= base_url(''); ?>/theme/dist/assets/js/pages/chartjs/chart.min.js"></script>
    <!--  -->
    <link rel="shortcut icon" href="<?= base_url(); ?>/logo/stori.ico" />
    <!-- <style>
      table {
        font-family: tahoma;
      }
    </style> -->
  </head>
 <!-- bisa a4 atau a5 landscape -->
  <body class="A4">
    <section class="sheet padding-10mm">
      <article>
        <div class="row">
          <div class="col-5 border border-dark">
            <br/>
            <table width=100%>
              <tr>
                <td align='center'>
                  <img style="width:250px" alt='Barcode' 
                    src="<?= base_url('/barcode.php?codetype=code128&size=40&text='.@$data_outbound->nomor.'&print=true') ?>">
                    <div class="separator separator-solid separator-border-2 separator-dark"></div> 
                </td>
              </tr>
              <tr>
                <td width="14%"></td>
              </tr>
              <tr>
                <td width="14%"><U>Pengirim:&nbsp;&nbsp;&nbsp;</U></td>
              </tr>
              <tr>
                <td ><b><?php echo $data_outbound->owners_name . ' - ' . $data_outbound->telepon_pengirim ?></b></td>
              </tr>
              <tr>
                <td width="14%"></td>
              </tr>
              <tr>
                <td width="14%"><U>Kepada:&nbsp;&nbsp;&nbsp;</U></td>
              </tr>
              <tr>
                <td ><b><?php echo $data_outbound->customer_name ?></b></td>
              </tr>
              <tr>
                <td ><?php echo $data_outbound->customer_address ?></td>
              </tr>
              <tr>
                <td ><?php echo $data_outbound->customer_phone ?></td>
              </tr>
              <tr>
                <td width="14%"><U>Deskripsi PO:&nbsp;&nbsp;&nbsp;</U></td>
              </tr>
              <tr>
                <td ><?php echo $data_outbound->po_description ?></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td align='center'>
                <?php echo date_format(date_create($data_outbound->create_date), "D, d F Y H:i") ?><br/>Kode PO
                </td>
              </tr>
              <tr>
                <td align='center'>
                  
                </td>
              </tr>
              <tr>
                <td align='center'>
                  <img style="width:250px" alt='Barcode' 
                    src="<?= base_url('/barcode.php?codetype=code128&size=40&text='.@$data_outbound->po_outbound_id.'&print=true') ?>">
                </td>
              </tr>
            </table>
          </div>
          <div class="col-7 border border-dark">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th colspan="2"><U>PICKING LIST:</U></th>
                    <th align='right'>Item</th>
                    <th align='center' width="5%"></th>
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
                    <tr class="table-light">
                      <td align='right'><?php echo $i.'.' ?></td>
                      <td><?php echo $d->material_name . ' (' . $d->material_id . ')' ?></td>
                      <td align='right'><?php echo number_format($d->total_keluar, 0) ?></td>
                      <td align='center'><input type="checkbox" /></td>
                    </tr>
                    <tr>
                      <td colspan="4"><div class="separator separator-dashed separator-border-2 separator-dark"></div></td>
                    </tr>
                  <?php
                    $i++;
                  } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </article>
    </section>

  </body>

  </html>
