<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<style type="text/css">
  table.table th {
    text-align: left;
  }
</style>
<<<<<<< HEAD
<form class='contact_form' id="validasi" action="<?= site_url()?>lapor_web/insert" method="POST" enctype="multipart/form-data">

<div class="box-header with-border">
	<span style="font-size: x-large"><strong>LAYANAN PERMOHONAN SURAT</strong></span>
  <button type="button" class="btn btn-primary pull-right" value="Kirim" id="kirim"><i class="fa fa-sign-in"></i>Kirim</button>
</div>
<div class="artikel layanan">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="form" >
      <input class="form-group" type="hidden" name="owner" value="<?= $_SESSION['nama']?>"/>
      <input class="form-group" type="hidden" readonly="readonly" name="email" value="<?= $_SESSION['nik']?>"/>
  		<tr>
  			<td>Jenis Surat Yang Dimohon</td>
  			<td>
  				<select class="form-group" name="nama_surat" id="nama_surat">
  						<option> -- Pilih Jenis Surat -- </option>
  						<?php foreach ($menu_surat2 AS $data): ?>
  							<option value="<?= $data['nama']?>"><?= $data['nama']?></option>
  						<?php endforeach;?>
  				</select>
  			</td>
  		</tr>
    </tr>
  		<tr>
  			<td>Keterangan Tambahan</td>
  			<td>
  				<textarea name="komentar" rows="1" cols="46" placeholder="Ketik di sini untuk memberikan keterangan tambahan."></textarea>
        </td>
  		</tr>
      <tr>
        <td>Nomor HP Aktif</td>
  			<td>
  				<input class="form-group" type="text" name="hp" placeholder="ketik no. HP" size="14"/>
  			</td>
  		</tr>
  	</table>

    <div class="box box-info" style="margin-top: 10px;">
  		<div class="box-header with-border">
  			<h4 class="box-title">DOKUMEN / KELENGKAPAN PENDUDUK YANG DIBUTUHKAN</h4>
  			<div class="box-tools">
  				<button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#surat"><i class="fa fa-minus"></i></button>
  			</div>
  		</div>
  		<div class="box-body" id="surat">
  			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
  				<thead>
  					<tr>
  						<th width="800">Nama Dokumen</th>
  						<th>&nbsp;</th>
  					</tr>
  				</thead>
          <tbody id="tbody-dokumen">
    			</tbody>
  			</table>
  		</div>
  	</div>

  	<div class="box box-info" style="margin-top: 10px;">
  		<div class="box-header with-border">
  			<h4 class="box-title">DOKUMEN / KELENGKAPAN PENDUDUK YANG TERSEDIA</h4>
  			<div class="box-tools">
  				<button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#dokumen"><i class="fa fa-minus"></i></button>
  			</div>
  		</div>
  		<div class="box-body" id="dokumen">
        <table class="table table-striped table-bordered" id="surat-table">
  				<thead>
  					<tr>
  						<th width="2">No</th>
  						<th width="220">Nama Dokumen</th>
  						<th width="360">Berkas</th>
  						<th width="200">Tanggal Upload</th>
  					</tr>
  				</thead>
  				<tbody>
  					<?php foreach($list_dokumen as $data){?>
  						<tr>
  							<td align="center" width="2"><?php echo $data['no']?></td>
  							<td><?php echo $data['nama']?></td>
  							<td><a href="<?php echo base_url().LOKASI_DOKUMEN?><?php echo urlencode($data['satuan'])?>" ><?php echo $data['satuan']?></a></td>
  							<td><?php echo tgl_indo2($data['tgl_upload'])?></td>
  						</tr>
  					<?php }?>
  				</tbody>
  			</table>
  		</div>
  	</div>

    <div class="box box-info" style="margin-top: 10px;">
  		<div class="box-header with-border">
  			<h4 class="box-title">DOKUMEN / KELENGKAPAN PENDUDUK YANG PERLU DIUNGGAH</h4>
  			<div class="box-tools">
  				<button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#unggah"><i class="fa fa-minus"></i></button>
  			</div>
  		</div>
      <form id="validasi" action="<?= $form_action?>" method="POST" enctype="multipart/form-data">
					<div class="box-body" id="unggah">
						<div class="form-group">
							<label for="nama">Nama / Jenis Dokumen</label>
							<input id="nama" name="nama" class="form-control input-sm required" type="text" placeholder="Nama Dokumen" value="<?= $dokumen['nama']?>"></input>	<input type="hidden" name="id_pend" value="<?= $penduduk['id']?>"/>
						</div>
						<div class="form-group">
							<label for="file" >Pilih File:</label>
							<div class="input-group input-group-sm">
								<input type="text" class="form-control" id="file_path" name="satuan">
								<input type="file" class="hidden" id="file" name="satuan">
								<input type="hidden" name="old_file" value="<?= $dokumen['satuan']?>">
								<span class="input-group-btn">
									<button type="button" class="btn btn-info btn-flat"  id="file_browser"><i class="fa fa-search"></i> Browse</button>
								</span>
							</div>
							<p class="help-block">Kosongkan jika tidak ingin mengubah dokumen.</p>
						</div>
          		<button type="submit" class="btn btn-social btn-flat btn-info btn-sm" id="ok"><i class='fa fa-check'></i> Simpan Dokumen</button>
					</div>
      </form>
  	</div>

  </form>
</div>

<script type='text/javascript'>
  $(document).ready(function(){
    $('#surat-table').DataTable({
    	"dom": 'rt<"bottom"p><"clear">',
    	"destroy": true,
      "paging": false,
      "ordering": false
    });

    $('#nama_surat').change(function(){
      var nama_surat = $(this).val();
      var url = "<?= site_url('first/ajax_table_dokumen_mandiri')?>";

      $.ajax({
        type: "POST",
        url: url,
        data: {
          nama_surat: nama_surat
        },
        dataType: "JSON",
        success: function(data)
        {
          var html;
          if (data.length == 0)
          {
            html = "<tr><td colspan='3' align='center'>No Data Available</td></tr>";
          }
          for (var i = 0; i < data.length; i++)
          {
            html += "<tr>"+"<td>"+data[i].nama_surat+"</td>";
          }
          $('#tbody-dokumen').html(html);
        },
        error: function(err, jqxhr, errThrown)
        {
          console.log(err);
        }
      })
   });

 });
 </script>
 <script>
 $('#file_browser').click(function(e)
 {
     e.preventDefault();
     $('#file').click();
 });

 $('#file').change(function()
 {
     $('#file_path').val($(this).val());
 });

 $('#file_path').click(function()
 {
     $('#file_browser').click();
 });
 </script>
 <script src="<?= base_url()?>assets/js/validasi.js"></script>
 <script src="<?= base_url()?>assets/js/jquery.validate.min.js"></script>
=======
<script type='text/javascript'>
  const LOKASI_DOKUMEN = '<?= base_url().LOKASI_DOKUMEN ?>';
</script>

<form class="contact_form" id="validasi" action="<?= site_url()?>" method="POST" enctype="multipart/form-data">

  <div class="box-header with-border">
    <span style="font-size: x-large"><strong>LAYANAN PERMOHONAN SURAT</strong></span>
    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-sign-in"></i>Kirim</button>
  </div>

  <div class="box-body">
    <div class="form form-horizontal">
      <div class="form-group">
        <label for="nama_surat" class="col-sm-3 control-label">Jenis Surat Yang Dimohon</label>
        <div class="col-sm-6 col-lg-8">
          <select class="form-control required input-sm" name="nama_surat" id="nama_surat">
            <option> -- Pilih Jenis Surat -- </option>
            <?php foreach ($menu_surat2 AS $data): ?>
              <option value="<?= $data['nama']?>"><?= $data['nama']?></option>
            <?php endforeach;?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="keterangan_tambahan" class="col-sm-3 control-label">Keterangan Tambahan</label>
        <div class="col-sm-8 col-lg-8">
          <textarea class="form-control input-sm" name="keterangan" rows="3" cols="46" placeholder="Ketik di sini untuk memberikan keterangan tambahan."></textarea>
        </div>
      </div>
      <div class="form-group">
        <label for="no_hp_aktif" class="col-sm-3 control-label">No. HP aktif</label>
        <div class="col-sm-6 col-lg-8">
          <input class="form-control input-sm" type="text" name="hp" placeholder="ketik no. HP" size="14"/>
        </div>
      </div>
    </div>
  </div>

  <div class="box box-info" style="margin-top: 10px;">
    <div class="box-header with-border">
      <h4 class="box-title">DOKUMEN / KELENGKAPAN PENDUDUK YANG DIBUTUHKAN</h4>
      <div class="box-tools">
        <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#surat"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <div class="box-body" id="surat">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
        <thead>
          <tr>
            <th width="800">Nama Dokumen</th>
            <th>&nbsp;</th>
          </tr>
        </thead>
        <tbody id="tbody-dokumen">
        </tbody>
      </table>
    </div>
  </div>

  <div class="box box-info" style="margin-top: 10px;">
    <div class="box-header with-border">
      <h4 class="box-title">DOKUMEN / KELENGKAPAN PENDUDUK YANG TERSEDIA</h4>
      <div class="box-tools">
        <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#dokumen"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <div class="box-body">
      <button type="button" title="Tambah Dokumen" data-remote="false" data-toggle="modal" data-target="#modal" data-title="Tambah Dokumen" class="btn btn-social btn-flat bg-olive btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" id="tambah_dokumen"><i class='fa fa-plus'></i>Tambah Dokumen</button>
      <table class="table table-striped table-bordered table-responsive" id="dokumen">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Dokumen</th>
            <th>Berkas</th>
            <th>Tanggal Upload</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody id="list_dokumen">        
        </tbody>        
      </table>
    </div>
  </div>
</form>
<div  class="modal fade" id="modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
        <h4 class='modal-title' id='myModalLabel'>Ubah dokumen</h4>
      </div>
      <form id="unggah_dokumen" action="" method="POST" enctype="multipart/form-data">
        <div class='modal-body'>
          <div class="row">
            <div class="col-sm-12">
              <div class="box box-danger">
                <div class="box-body">
                  <div class="form-group">
                    <label for="nama_dokumen">Nama / Jenis Dokumen</label>
                    <input id="nama_dokumen" name="nama" class="form-control input-sm required" type="text" placeholder="Nama Dokumen" value=""/>
                    <input type="text" class="hidden" name="id" id="id_dokumen" value=""/>
                    <input type="hidden" name="id_pend" value="<?= $this->session->userdata('id'); ?>">
                  </div>
                  <div class="form-group">
                    <label for="file" >Pilih File:</label>
                    <div class="input-group input-group-sm">
                      <input type="text" class="form-control" id="file_path" name="satuan">
                      <input type="file" class="hidden" id="file" name="satuan">
                      <input type="text" class="hidden" name="old_file" id="old_file" value="">
                      <span class="input-group-btn">
                        <button type="button" class="btn btn-info btn-flat" id="file_browser"><i class="fa fa-search"></i> Browse</button>
                      </span>
                    </div>
                    <p class="help-block">Kosongkan jika tidak ingin mengubah dokumen.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-social btn-flat btn-danger btn-sm" data-dismiss="modal"><i class='fa fa-sign-out'></i> Tutup</button>
          <button type="submit" class="btn btn-social btn-flat btn-info btn-sm" id="upload_btn"><i class='fa fa-check'></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

