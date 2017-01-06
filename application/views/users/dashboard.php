<?php
$this->load->view('template/head');
?>

<!--tambahkan custom css disini-->
<!-- iCheck -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/iCheck/flat/blue.css') ?>" rel="stylesheet" type="text/css" />
<!-- Morris chart -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/morris/morris.css') ?>" rel="stylesheet" type="text/css" />
<!-- jvectormap -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jvectormap/jquery-jvectormap-1.2.2.css') ?>" rel="stylesheet" type="text/css" />
<!-- Date Picker -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datepicker/datepicker3.css') ?>" rel="stylesheet" type="text/css" />
<!-- Daterange picker -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/daterangepicker/daterangepicker-bs3.css') ?>" rel="stylesheet" type="text/css" />
<!-- bootstrap wysihtml5 - text editor -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') ?>" rel="stylesheet" type="text/css" />
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<style type="text/css">
    .delivery-show{
        display: none;
    }
    legend{
        font-size: 28px;
        font-weight: bold;
    }
    fieldset table{
        margin-left: 20px;
    }
    fieldset input{
        width: 200px;
    }
    .button-submit table{
        margin-left: 10px;
        margin-top: 10px;
    }
    .button-submit td{

        margin-right: 10px;
        padding: 10px;
    }
    .tbl_transaksi{
        border-color: blue;
        background-color: grey;
        width: 1000px;
        margin-left: 30px;
    }
</style>
<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Note Transaksi</h3>
        </div><!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="<?php echo base_url('index.php/market/market_apps/add_new')?>">
                <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nomor Transaksi</label>
                      <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                      <input type="text" class="form-control" id="nomor">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Tanggal Transaksi</label>
                      <div class="input-group">
                          <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                          </div>
                            <input type="text" class="form-control pull-right" id="reservationtime" value="<?php echo date('d-M-Y H:i:s')?>">
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Status Delivery</label><br/>
                      <select name="status_delivery" onChange="showDelivery();" id="status">
                        <option value="0">Tidak</option>
                         <option value="1">Ya</option>
                      </select>
                    </div>
                    <div class="delivery-show">
                    <fieldset>
                    <legend>Delivery</legend>
                        <table>
                        <tr>
                        <td><div class="form-group">
                            <label>Nama Penerima</label><br/>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-fw fa-meh-o"></i>
                                </div>
                            <input type="text" name="nama_penerima" placeholder="Nama Penerima">
                            </div>
                        </div></td>
                        <td><div class="form-group">
                            <label>Nomor Telepon Penerima</label><br/>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>
                            <input type="number" name="number" placeholder="Nomor Telepon">
                            </div>
                        </div></td>
                        <td><div class="form-group">
                            <label>Tanggal Delivery</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                            <input type="text" name="tanggal_terima" id="datepicker" placeholder="Tanggal Penerima">
                            </div>
                        </td>
                        </tr>
                        <tr>
                        <td colspan="3">
                            <div class="form-group">
                            <label>Alamat Lengkap</label>
                            <div class="input-group">
                                <textarea cols="150" rows="8" name="alamat" placeholder="Alamat Penerima"></textarea>
                            </div>
                        </td>
                        </tr>
                        </table>
                    </fieldset>
                    </div>
              </div><!-- /.box-body -->
            </div>
        </div>
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Menu Transaksi</h3>
            </div>
            <div class="box-body">
              <!-- Minimal style -->
              <table id="example2" class="table table-bordered table-hover dataTable" aria-describedby="example2_info">
                <thead>
                    <tr role="row">
                        <th>Nama Barang</th>
                        <th>Harga Barang</th>
                        <th>Quantity</th>
                        <th>Total Harga</th>
                        <th>Action</th>
                    </tr>
                    <tbody id="form-transaksi">
                    </tbody> 
                </thead>
              </table>
              <div class="button-submit">
                <table>
                <tr> 
                  <td><button type="submit" class="btn btn-block btn-success">Submit</button></td>
                  <td><button type="button" class="btn btn-block btn-danger">Cancel</button></td>
                  <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                  <td><button type="button" class="btn btn-block btn-primary" id="add" onClick="addTransaksi();">Add Transaksi</button></td>
                </tr>
                </table>
            </div><!-- /.box-body -->
          </div>
      </form>
</section><!-- /.content -->
<?php
$this->load->view('template/js');
?>

<!--tambahkan custom js disini-->
<!-- jQuery UI 1.11.2 -->
<script src="<?php echo base_url('assets/js/jquery-ui.min.js') ?>" type="text/javascript"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Morris.js charts -->
<script src="<?php echo base_url('assets/js/raphael-min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/daterangepicker.js')?>" type="text/javascript"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<?php
$this->load->view('template/foot');
?>
<script language="JavaScript">
   
$(document).ready(function(){ 
    if($('#tanggal').val() != ''){
        $(this).attr('readonly',true);
    }
    $.ajax({
        url:'http://localhost/kue_bolu/index.php/market/ajax_return/getNomorTransaksi',
        method:'GET',
        success:function(result){
           $('#nomor').val(result);
           $('#nomor').attr('readonly',true);
        }
    });
    $('#datepicker').datepicker();

}) 

function showDelivery(){
    if( $('#status').val() == 1){
        $('.delivery-show').show();
        datepicker
    }
    else{
        $('.delivery-show').hide();
    }
}
var index = 0;
function addTransaksi(){
    index += 1;
    var tmp = index;
    $('#form-transaksi').append('<tr id="row_'+index+'"><td><input type="text" name="nama_barang[]" id="nama_barang_'+index+'" class="nama_barang"></td><td><input type="number" name="harga[]" id="harga_'+index+'" class="harga"></td><td><input type="number" name="quantity[]" class="quantity" id="quantity_'+index+'"></td><td><input type="number" name="total_harga[]" id="total_harga_'+index+'" class="total_harga"</td><td><button type="button" class="btn btn-block btn-danger btn-flat" onClick="remove('+index+')">Remove</button></td></tr>');
}

function remove(id){
    $('#row_'+id).remove();

}



</script>

