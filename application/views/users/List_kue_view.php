<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<?php
  
  if(isset($error_upload)){
    echo "<script>swal('Upload Failed','$error_upload','error')</script>"; 
  }
  if(isset($error_msg)){
    echo "<script>swal('failed','$error_msg','error')</script>";
  }
  echo validation_errors();
?><!-- Main content -->
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
          <input type="text" name="id_kategori" id="id_kategori" class="form-control" style="width:250px;" value="<?php if(isset($search_id_kategori_kue)){echo $search_id_kategori_kue;}?>">
        </div>
        </div>
        <div class="col-xs-3">
        <label for="nama_kategori">Nama Kategori</label>
        <div class="input-group">
          <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" style="width:250px;" value="<?php if(isset($search_nama_kategori_kue)){echo $search_nama_kategori_kue;}?>">
        </div>
        </div>
      </div>
      <div style="margin-top: 40px"></div>
      <div class="row" style="float: right;">
      <div class="col-xs-5">
        <button type="submit" class="btn btn-block btn-primary" style="width:120px;" name="search" value="t"><i class="fa fa-search"></i> Cari</button>
      </div>
      <div class="col-xs-5">
        <button type="submit" class="btn btn-block btn-warning" style="width:120px;" name="bersihkan" value="f"><i class="fa fa-fw fa-refresh"></i>Bersihkan</button>
      </div>
      </div>
    </form>
    </fieldset>
  </div><!-- /.box-body -->
  </div>
</section>
<!--END SEARCH-->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-body">
          <div style="margin-top:20px;"></div>
            <button class="btn btn-block btn-success" data-toggle="modal" data-target="#myModal" style="width:120px;">Tambahkan Kue</button>
            <div style="margin-top:20px;"></div>
            <table class="table table-bordered table-responsive">
                <tr>
                  <th style="background-color: #d5d5d4;text-align:center;">No</th>
                  <th style="background-color: #d5d5d4;text-align:center;">Id Kue</th>
                  <th style="background-color: #d5d5d4;text-align:center;">Nama Kue</th>
                  <th style="background-color: #d5d5d4;text-align:center;">Stok Kue</th>
                  <th style="background-color: #d5d5d4;text-align:center;">Harga Kue</th>
                  <th style="background-color: #d5d5d4;text-align:center;">Gambar Kue</th>
                  <th colspan="2" style="background-color: #d5d5d4;text-align:center;">Action</th>
                </tr>
                <?php
                  $index = 0 ;
                  if($list_data == TRUE){
                    foreach ($list_data as $key => $value) {
                    $index ++ ;
                ?>
                  <tr>
                    <td><?php echo $index?></td>
                    <td><?php echo $value->id_kue?></td>
                    <td><?php echo $value->nama_kue?></td>
                    <td><?php echo $value->stok_kue?></td>
                    <td><?php echo $value->harga_kue?></td>
                    <td style="text-align: center"><img src="<?php echo $value->image?>" class="image-table" style="width:70px;"></td>
                    <td style="width:20px";><button type="button" class="btn btn-block btn-warning" onclick="editId(<?php echo $value->id_kue ?>)" data-target="#editModal" data-toggle="modal">Edit</button></td>
                    <td style="width: 20px;"><button type="button" class="btn btn-block btn-danger" onclick="deleteId()"><a href="http://localhost/kue_bolu/index.php/market/list_kue/delete/1">Hapus</a></button></td>
                  </tr>
                <?php
                    }
                  }
                ?>
            </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</section><!-- /.content -->
<!-- MODAL NEW -->
<div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"><i class="fa fa-bars" aria-hidden="true"></i> Add Kue</h4>
            </div>
          <div class="modal-body">
            <div class="form-modal">
              <form method="POST" action="<?php echo base_url('index.php/market/list_kue/addNew')?>" enctype="multipart/form-data">
                <label for="id_kue">Id Kue</label>
                <input class="form-control" type="number" name="id_kue" id="id_kue" placeholder="id id_kue">
                <label for="nama_kue">Nama Kue</label>
                <input class="form-control" type="text" name="nama_kue" id="nama_kue" placeholder="nama kue">
                <label for="kategori_kue">Kategori Kue</label><br/>
                <select id="kategori_kue" name="kategori_kue" class="form-control select2-container" style="width:530px;">
                </select>
                <label for="gambar_kue" style="margin-top: 15px;">Gambar Kue</label>
                <input type="file" name="gambar_kue" id="gambar_kue">
                <label for="stok_kue">Stok Kue</label>
                <input type="number" class="form-control" id="stok_kue" name="stok_kue" placeholder="Stok Kue (Alphabet Jangan Diinputkan)">
                <label for="stok_kue">Harga Kue</label>
                <input type="number" class="form-control" id="harga_kue" name="harga_kue" placeholder="Harga kue">
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
<!-- END -->
<?php 
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
<script type="text/javascript">
$(document).ready(function(){
var url_base = "<?php echo base_url('index.php/market/list_kue/get_list_kategori_kue')?>";
 $("#kategori_kue").select2({        
    ajax: {
        url: url_base,
        dataType: 'json',
        method : 'POST',
        delay: 250,
        data: function (params) {
            return {
                q: params.term // search term
            };
        },
        processResults: function (data,params) {
            // parse the results into the format expected by Select2.
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data)
            params.page = params.page || 1;

            var select2Data = $.map(data.kategori_kue, function (obj) {
                    obj.id = obj.id_kategori;
                    obj.nama = obj.nama_kategori;
                    return obj;
                });

            return {
                results: select2Data

            };
        },
        cache: true
    },
    escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
     minimumInputLength: 1,
     templateResult: formatRepo, // omitted for brevity, see the source of this page
     templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
  });

    function formatRepo (kategori) {
      var markup = '<div class="customer-detailed">';
      markup += "" + kategori.nama_kategori + "<br>";
      markup += "</div>";

      return markup;
    }

    function formatRepoSelection (kategori) {
      return kategori.nama_kategori ;
    }

});

</script>

<?php
$this->load->view('template/foot');
?>
