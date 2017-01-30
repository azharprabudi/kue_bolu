<?php
$this->load->view('template/head');
$search_id_kategori_kue = $this->session->userdata('search_id_kategori_kue');
$search_nama_kategori_kue = $this->session->userdata('search_nama_kategori_kue');
$not_found = $this->session->flashdata('not_found');
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
<?php

if(isset($not_found)){
  echo $not_found;
}

?>
<!-- Main content -->
<section class="sub-content">
  <!-- BOX SEARCH START -->
<div class="box">
  <div class="box-header with-border">
      <h3 class="box-title">Pencarian</h3>
          <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          </div>
  </di>
  <div style="margin-top: 20px"></div>
  <div class="box-body">
  <fieldset class="fieldset" style="border:1px solid;border-color:#D5D5D4;border-radius: 5px;padding: 2%;">
    <form method="POST" action="<?php echo base_url('index.php/market/kategori_kue/search')?>">
      <div class="row">
        <div class="col-xs-3">
        <label for="id_kategori">Id Kategori</label>
        <div class="input-group">
          <input type="text" name="search_id_kategori" class="form-control" style="width:250px;" value="<?php if(isset($search_id_kategori_kue)){echo $search_id_kategori_kue;}?>">
        </div>
        </div>
        <div class="col-xs-3">
        <label for="nama_kategori">Nama Kategori</label>
        <div class="input-group">
          <input type="text" name="search_nama_kategori"  class="form-control" style="width:250px;" value="<?php if(isset($search_nama_kategori_kue)){echo $search_nama_kategori_kue;}?>">
        </div>
        </div>
      </div>
      <div style="margin-top: 40px"></div>
      <div class="row" style="float: right;">
      <div class="col-xs-5">
        <button type="submit" class="btn btn-block btn-primary" style="width:120px;" name="search"><i class="fa fa-search"></i> Cari</button>
      </div>
      <div class="col-xs-5">
        <button type="submit" class="btn btn-block btn-warning" style="width:120px;" name="bersihkan"><i class="fa fa-fw fa-refresh"></i>Bersihkan</button>
      </div>
      </div>
    </form>
    </fieldset>
</div><!-- /.box-body -->
</div>
<!-- BOX SEARCH END -->
</section>
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
  
    <button class="btn btn-block btn-primary" style="width: 100px;float:left;margin-top: 10px;margin-bottom:20px;" data-toggle="modal" data-target="#myModal" onClick="get_id_max()">Add New</button>
        <table class="table table-bordered">
        <tbody>
        <tr>
          <th style="text-align:center;width: 30px;background-color:#D5D5D4">Id Kategori</th>
          <th style="text-align:center;background-color:#D5D5D4">Nama Kategori</th>
          <th style="width:20px;text-align:center;background-color:#D5D5D4" colspan="2">Action</th>
        </tr>
        <?php 
          if($this->uri->segment(3) != 'search'){
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
                <td style="width:20px"><button type="button" class="btn btn-block btn-danger" onClick="deleteId(<?php echo $row->id_kategori ?>)">Hapus</button></td>
            </tr>
        <?php    
                    }
                  }    
               }
            else{
              if($list_data != FALSE){
                foreach ($list_data as $row) {
                  ?>
            <tr>
                <td><?php echo $row->id_kategori?></td>
                <td><?php echo $row->nama_kategori?></td>
                <td style="width:20px"><button type="button" class="btn btn-block btn-warning" onClick="editId('<?php echo $row->id_kategori?>')" data-target="#editModal" data-toggle="modal">Edit</button></td>
                <td style="width:20px"><button type="button" class="btn btn-block btn-danger" onClick="deleteId()">Hapus</button></td>
            </tr>

      <?php
                }
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
         <?php 
         if($this->uri->segment(3) != 'search'){
            echo $pagination;
         }
         ?>
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
  //digunakan untuk delete data
  function deleteId(id_kategori){
    var base_url = '<?php echo base_url()?>index.php/market/kategori_kue/delete';
    var txt = swal({
                  title: 'Apakah anda yakin untuk menghapus ? ',
                  text: "Kamu tidak dapat mengembalikan ini",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Lanjutkan',
                  cancelButtonText: 'Batalkan',
                  confirmButtonClass: 'btn btn-success custom',
                  cancelButtonClass: 'btn btn-danger custom',
                  buttonsStyling: false
                }).then(function () {
                  $.ajax({
                        url : base_url,
                        method :'POST',
                        dataType : 'JSON',
                        data : {id_kategori:id_kategori},
                        success:function(result){
                        swal(
                          'Deleted!',
                          'Data Sudah Ke Hapus',
                          'success'
                        )

                      }
                  })
                }, function (dismiss) {
                  if (dismiss === 'cancel') {
                    swal(
                      'Cancelled',
                      'Data Gagal Dihapus',
                      'error'
                    )
                  }
              })
  }
  //get data untuk edit di modal
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
  //digunakan untuk mendapatkan id kategori ketika add new
  function get_id_max(){
    var base_url = '<?php echo base_url()?>index.php/market/kategori_kue/get_id_max';

    $.ajax({
      url:base_url,
      dataType:'json',
      method:'POST',
      success:function(result){
        $('#id_kategori').val(result.id_kategori);
        $('#id_kategori').attr('readonly',true);
      }
    });
  }
</script>

