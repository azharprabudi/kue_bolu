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
        <h3 class="box-title">Kategori Kue</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
    <?php echo validation_errors()?>
    <?php 
    $deleted = $this->session->flashdata('deleted');
    if(isset($deleted))echo $this->session->flashdata('deleted')?>
    <?php
    $edit = $this->session->flashdata('edit');
    if(isset($edit))echo $this->session->flashdata('edit')?>
  
    <button class="btn btn-block btn-primary" style="height:40px;width: 100px;float:left;margin-top: 10px;margin-bottom:20px;" data-toggle="modal" data-target="#myModal">Add New</button>
        <form method="POST" action="">
            <div class="input-group">
              <input type="text" name="search_kategori_kue" class="form-control" placeholder="Search..." style="width:150px;float:right;margin-top: 10px;margin-bottom: 10px;">
              <span class="input-group-btn">
                <button type="submit" name="seach" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <table class="table table-bordered">
        <tbody>
        <tr>
          <th style="text-align:center;width: 30px;">Id Kategori</th>
          <th style="text-align:center">Nama Kategori</th>
          <th style="width:20px;text-align:center" colspan="2">Action</th>
        </tr>
        <?php 
        if(count($allKategori) > 0){    
            $index = 0;
            foreach($allKategori as $row){
             $index += 1;
             $tmp = $index;
        ?>
            <tr>
                <td><?php echo $row->id_kategori?></td>
                <td><?php echo $row->nama_kategori?></td>
                <td style="width:20px"><button type="button" class="btn btn-block btn-warning" onClick="editId('<?php echo $row->id_kategori?>')" data-target="#editModal" data-toggle="modal">Edit</button></td>
                <td style="width:20px"><button type="button" class="btn btn-block btn-danger" onClick="deleteId()"><a href='<?php echo base_url('index.php/market/kategori_kue/delete/')."/$row->id_kategori"?>'>Hapus</button></td>
            </tr>
        <?php        
                }
            }
        ?>
      </tbody>
      </table>
      <!--Modal Add New Kategori-->
      <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"><i class="fa fa-bars" aria-hidden="true"></i> Add Kategori Kue</h4>
            </div>
          <div class="modal-body">
            <div class="form-modal">
              <form method="POST" action="<?php echo base_url('index.php/market/kategori_kue/addNew')?>">
                <label>Id Kategori</label>
                <input class="form-control" type="number" name="id_kategori" id="id_kategori" placeholder="id kategori">
                <label>Nama Kategori</label>
                <input class="form-control" type="text" name="nama_kategori" id="nama_kategori" placeholder="nama kategori">
                <button type="submit" class="btn btn-block btn-success" name="submit" style="width: 80px;">Submit</button>
              </form>
            </div>
          </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
      </div>
      </div>
      <!--EDIT MODAL-->
      <div id="editModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"><i class="fa fa-bars" aria-hidden="true"></i> Edit Kategori Kue</h4>
            </div>
          <div class="modal-body">
            <div class="form-modal">
              <form method="POST" action="<?php echo base_url('index.php/market/kategori_kue/update')?>">
                <label>Id Kategori</label>
                <input class="form-control" type="number" name="id_kategori" id="id_edit" placeholder="id kategori">
                <label>Nama Kategori</label>
                <input class="form-control" type="text" name="nama_kategori" id="nama_edit" placeholder="nama kategori">
                <button type="update" class="btn btn-block btn-success" name="submit" style="width: 80px;">Submit</button>
              </form>
            </div>
          </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
      </div>
      </div>
      <!---END EDIT MODAL -->
    </div><!-- /.box-body -->
    <div class="box-footer clearfix">
         <?php echo $pagination?>
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
  console.log('test');
  function deleteId(){
    var txt = confirm('Yakin untuk menghapus ?');
    if (txt != true){
      event.preventDefault();
    }
  }

  function editId(id_kategori){
    var base_url = '<?php echo base_url()?>index.php/market/kategori_kue/editId';
    // alert(base_url);
    $.ajax({
      url : base_url,
      method : 'POST',
      dataType : 'json',
      data : {id_kategori:id_kategori},
      success:function(result){
        $('#id_edit').val(result[0].id_kategori);
        $('#id_edit').attr('readonly',true);
        $('#nama_edit').val(result[0].nama_kategori);
      }
    });
  }
</script>

