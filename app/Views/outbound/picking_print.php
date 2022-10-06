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
              <b><?=  $outboundpo->wh_name ?></b><br>
              <?=  $outboundpo->wh_address ?>
            </td>
            <td align='right' width='50%'><img src="<?= base_url(); ?>/logo/stori-2.jpg" width="130" height="75"></td>
          </tr>
        </table>
        <center><img style="width:250px" alt='Barcode' 
                    src="<?= base_url('/barcode.php?codetype=code128&size=40&text='.@$outboundpo->po_outbound_id.'&print=true') ?>"></center>
        <center><b>FORM PICKING LIST</b></center>
        <table width=100% id='t03' class='t02'>
          <tr>
            <td width='15%'>Delivery Date</td>
            <?php $date = strtotime($outboundpo->po_out_date); ?>
            <td>: <?= date('d M Y', $date) ?></td>
            <td width='15%'>Customer</td>
            <td>: <?=  $outboundpo->customer_name ?></td>
          </tr>
          <tr>
            <td width='15%'>Seller</td>
            <td>: <?=  $outboundpo->owners_name ?></td>
            <td width='15%'>Remaks</td>
            <td>: <?=  $outboundpo->po_description ?></td>
          </tr>

          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        <br>
        <table width=100% id='t04' class='t02'>
          <tr>
            <th width='15%'>Product ID</th>
            <th width='15%'>Product Code</th>
            <th width='20%'>Product Name</th>
            <th width='20%'>Location</th>
            <th width='10%'>Unit</th>
            <th width='8%'>Stock</th>
            <th width='8%'>Qty</th>
          </tr>
          <?php
            $i = 0;
            foreach ($material_ref as $key => $value) {
                $i++;
                echo "<tr>
                        <td><img style='width:150px' alt='Barcode' 
                        src='".base_url('/barcode.php?codetype=code128&size=40&text='.@$value->mat_detail_id.'&print=true')."'></td>
                        <td>".$value->material_code."</td>
                        <td>
                        ".$value->material_name."<br/>
                        Batch : ".$value->batch_no."<br/>
                        Exp. : ".$value->expired_date."<br/>
                        </td>
                        <td>
                        ".$value->wh_area_name."<br/>
                        ".$value->rak_name."<br/>
                        ".$value->shelf_name."<br/>
                        </td>
                        <td>".$value->uom_name."</td>
                        <td align='right'>".number_format($value->stock, 1)."</td>
                        <td align='right'>".number_format($value->qty_realisasi, 1)."</td>
                    </tr>";
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
            </tr>
          <?php
          }
          ?>
        </table>
        <br>
        <table width=100% id='t03' class='t02'>
          <tr>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td widtd='33%' align='center'>Picking By:</td>
            <td widtd='33%' align='center'></td>
            <td widtd='33%' align='center'>Receive BY:</td>
          </tr>
          <tr>
            <td><br><br><br><br></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td align='center'>__________________________</td>
            <td align='center'></td>
            <td align='center'>__________________________</td>
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