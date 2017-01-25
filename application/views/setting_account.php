<?php
$this->load->view('template/head');
$search_kategori_kue = $this->session->userdata('search_kategori_kue');
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
  .form-modal{
    padding: 20px;
  }
  .form-modal input{
    margin-bottom: 20px;
  }
  a{
    text-decoration: none;
    color:white;
  }
  a:hover{
    color:white;
  }
</style>
<!-- Main content -->
<section class="content">
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Setting Account</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
      <fieldset>
          <div id="validation"></div>
          <label for="username">Username</label>
          <input type="text" name="username" id="username" class="form-control" style="width: 200px;margin-top: 10px;" value="<?php echo $this->session->userdata('username')?>">
          <br/>
          <label for="old_password">Password Lama</label>
          <input type="Password" name="old_password" id="old_password" class="form-control" style="width: 200px;margin-top: 10px;">
          <br/>
          <label for="new_password">Password Baru</label>
          <input type="Password" name="new_password" id="new_password" class="form-control" style="width: 200px;margin-top: 10px;">
          <br/>
          <label for="confirmation_password">Konfirmasi Password</label>
          <input type="Password" name="confirmation_password" id="confirmation_password" class="form-control" style="width: 200px;margin-top: 10px;">
          <button type="button" class="btn btn-block btn-primary" name="submit" style="margin-top: 25px; width:120px;" onClick="cekPassword();">Simpan</button>
      </fieldset>
    </div>
  </div>
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
  
  function cekPassword(){
    var new_password = $('#new_password').val();
    var confirmation_password = $('#confirmation_password').val();
    if(new_password != confirmation_password){
      $('#validation').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h5><i class="icon fa fa-ban"></i>Pastikan New Password Dan Konfirmasi Password Sama<h5></div>');
    }
    else{
      var url = '<?php echo base_url('index.php/setting_account/change_password'); ?>' ;
      var username = $('#username').val();
      var old_password = $('#old_password').val();
      $.ajax({
        url : url,
        dataType : 'JSON',
        method : 'POST',
        data :{username:username,old_password:old_password,new_password:new_password,confirmation_password:confirmation_password},
        success:function(result){
          console.log(result);
            $('#validation').html(result.success);
        }
      });
    }

  }

</script>

