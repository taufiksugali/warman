<div>
    <table class="table table-hover table-bordered">
        <tbody>
            <tr>
                <td width="25%"><strong>Warehouse Name</strong></td>
                <td width="75%"><?php echo @$soh->wh_name; ?></td>
            </tr>
            <tr>
                <td width="25%"><strong>Owner Name</strong></td>
                <td width="75%"><?php echo @$soh->owners_name; ?></td>
            </tr>
            <tr>
                <td width="25%"><strong>Material Name</strong></td>
                <td width="75%"><?php echo @$soh->material_name; ?></td>
            </tr>
            
        </tbody>
    </table>
    <form action="<?php echo base_url('soh_owner/update'); ?>" method="post">
    <input type="hidden" value="<?php echo @$soh->sot_id; ?>" name="sot_id" id="sot_id" class="form-control" />
        <table class="table table-hover table-bordered">
            <tbody>
                <tr>
                    <td colspan="6" class="text-center"><strong>Update Stock</strong></td>
                </tr>
                <tr>
                    <td colspan="2" width="35%" class="text-center"><strong>Seller</strong></td>
                    <td colspan="2" width="35%" class="text-center"><strong>Warehouse</strong></td>
                    <td rowspan="2"  width="15%" class="text-center"><strong>Status</strong></td>
                    <td rowspan="2" width="15%" class="text-center"><strong>Remark</strong></td>
                </tr>
                <tr>
                    <td class="text-center">Good</td>
                    <td class="text-center">Not Good</td>
                    <td class="text-center">Good</td>
                    <td class="text-center">Not Good</td>
                </tr>
                <tr>
                    <td class="text-center">
                        <div class="form-group">
                            <input type="text" name="stock_good_seller" id="stock_good_seller" class="form-control" value="<?php echo @$soh->stock_good_seller; ?>" onkeyup="get_stock1();"/>
                            <input hidden type="text" name="current_stock_good_seller" id="current_stock_good_seller" class="form-control " value="<?php echo @$soh->stock_good_seller; ?>"/>
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="form-group">
                            <input type="text" name="stock_ngood_seller" id="stock_ngood_seller" class="form-control" value="<?php echo @$soh->stock_ngood_seller; ?>" onkeyup="get_stock1();"/>
                            <input hidden type="text" name="current_stock_ngood_seller" id="current_stock_ngood_seller" class="form-control " value="<?php echo @$soh->stock_ngood_seller; ?>"/>
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="form-group">
                            <input readonly type="text" name="stock_good_warehouse" id="stock_good_warehouse" class="form-control form-control-solid" value="<?php echo @$soh->stock_good_warehouse; ?>" onkeyup="get_stock1();"/>
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="form-group">
                            <input readonly type="text" name="stock_ngood_warehouse" id="stock_ngood_warehouse" class="form-control form-control-solid" value="<?php echo @$soh->stock_ngood_warehouse; ?>" onkeyup="get_stock1();"/>
                        </div>
                    </td>
                    <td class="text-center" id="status"><?php
                        $total_seller = intval(@$soh->stock_good_seller) + intval(@$soh->stock_ngood_seller);
                        $total_warehouse = intval(@$soh->stock_good_warehouse) + intval(@$soh->stock_ngood_warehouse);

                        if($total_seller != $total_warehouse){
                            echo '<span class="label label-light-danger label-pill label-inline mr-2">stock tidak sesusai</span>';
                        }else if($total_seller == $total_warehouse){
                            echo '<span class="label label-light-success label-pill label-inline mr-2">stock sudah sesuai</span>';
                        }
                    ?></td>
                    <td class="text-center" >
                        <span class="label label-light-success label-pill label-inline mr-2" id="remark">tidak ada perubahan</span>
                        <input hidden type="text" name="remark2" id="remark2" class="form-control "/>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="text-center">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
<script>
    function get_stock1(){
            var stock_good_seller = parseInt(document.getElementById('stock_good_seller').value);
            var stock_ngood_seller = parseInt(document.getElementById('stock_ngood_seller').value);
            var stock_good_warehouse = parseInt(document.getElementById('stock_good_warehouse').value);
            var stock_ngood_warehouse = parseInt(document.getElementById('stock_ngood_warehouse').value);

            var current_stock_good_seller = parseInt(document.getElementById('current_stock_good_seller').value);
            var current_stock_ngood_seller = parseInt(document.getElementById('current_stock_ngood_seller').value);
            
            var stock_total_seller = stock_good_seller + stock_ngood_seller;
            var stock_total_warehouse = stock_good_warehouse + stock_ngood_warehouse;
            var current_total_stock_seller = current_stock_good_seller + current_stock_ngood_seller;
            
            if(stock_good_seller != stock_good_warehouse || stock_ngood_seller != stock_ngood_warehouse || stock_total_seller != stock_total_warehouse){
                document.getElementById("status").innerHTML = '<span class="label label-light-danger label-pill label-inline mr-2">stock tidak sesusai</span>';
            }else{
                document.getElementById("status").innerHTML = '<span class="label label-light-success label-pill label-inline mr-2">stock sudah sesuai</span>';
            }

            if(current_total_stock_seller < stock_total_seller){
                var remark_stock = stock_total_seller - current_total_stock_seller;
                document.getElementById("remark").innerHTML = '<span class="label label-light-success label-pill label-inline mr-2">ditambahkan '+remark_stock+' item</span>';
                document.getElementById("remark2").value = "ditambahkan "+remark_stock.toString()+" item";
            }else if(current_total_stock_seller > stock_total_seller){
                var remark_stock = current_total_stock_seller - stock_total_seller;
                document.getElementById("remark").innerHTML = '<span class="label label-light-success label-pill label-inline mr-2">dikurangi '+remark_stock+' item</span>';
                document.getElementById("remark2").value = "dikurangi "+remark_stock.toString()+" item";
            }else if(current_total_stock_seller = stock_total_seller){
                document.getElementById("remark").innerHTML = '<span class="label label-light-success label-pill label-inline mr-2">tidak ada perubahan</span>';
            }

        }
</script>
