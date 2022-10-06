<!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <!-- <link href="../bower_components/paper/paper.css" rel="stylesheet"> -->
    <link href="<?= base_url(); ?>/theme/dist/assets/paper/paper.css" rel="stylesheet"
        type="text/css" />
        <base href="../../">
    <meta charset="utf-8" />
    <title><?= "Print Shelf" ?></title>
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
    <script>
    var base_url = '<?php echo base_url(); ?>';
    </script>
    <style>
      table {
        font-family: tahoma;
      }
    </style>
  </head>

  <body id="kt_body" class="print-content-only header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading" 
  data-new-gr-c-s-check-loaded="14.1040.0" data-gr-ext-installed data-scrolltop="on">
      <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
          <!--begin::Container-->
          <div class="container">
            <!-- begin::Card-->
            <div class="card card-custom overflow-hidden">
              <div class="card-body p-0">
                <div class="row justify-content-center py-8 px-8 py-md-27 px-md-0">
                  <div class="col-12">
                    <table>
                    <?php $i = 1;
                      foreach ($data_shelf as $row) { ?>
                      <?php if($i == 1) { echo "<tr>" ;} ?>
                      <td align="center">
                        <small style="font-size: 20px"><b><?= @$row->shelf_name ?></b></small><br>
                        <img style="width: 300px" alt='Barcode' src="<?= base_url('/barcode.php?codetype=code128&size=40&text='.@$row->shelf_id.'&print=true') ?>">
                      </td>
                      <?php if($i == 4) { echo "</tr>" ;} 
                          $i++;
                          if($i == 4){ $i = 1; } ?>
                    <?php } ?>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- end::Card-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::Entry-->
      </div>
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