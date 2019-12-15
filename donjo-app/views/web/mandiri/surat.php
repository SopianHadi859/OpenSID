<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<style type="text/css">
  table.table th {
    text-align: left;
  }
</style>
<script type='text/javascript'>
  const LOKASI_DOKUMEN = '<?= base_url().LOKASI_DOKUMEN ?>';
</script>

<form class="contact_form" id="validasi" action="<?= site_url('permohonan_surat/form')?>" method="POST" enctype="multipart/form-data">

  <div class="box-header with-border">
    <span style="font-size: x-large"><strong>LAYANAN PERMOHONAN SURAT</strong></span>
    <button type="submit" class="btn btn-primary pull-right" value="Kirim" id="kirim"><i class="fa fa-sign-in"></i>Kirim</button>
    <input type="hidden" name="pemohon" value="<?= $_SESSION['nama']?>"/>
    <input type="hidden" readonly="readonly" name="nik" value="<?= $_SESSION['nik']?>"/>
  </div>

  <div class="box-body">
    <div class="form form-horizontal">
      <div class="form-group">
        <label for="nama_surat" class="col-sm-3 control-label">Jenis Surat Yang Dimohon</label>
        <div class="col-sm-6 col-lg-8">
          <select class="form-control required input-sm" name="id_surat">
            <option> -- Pilih Jenis Surat -- </option>
            <?php foreach ($menu_surat_mandiri AS $data): ?>
              <option value="<?= $data['id']?>"><?= $data['nama']?></option>
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
</form>

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
      var url = "<?= site_url('first/ajax_table_surat_permohonan1')?>";

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
            html += "<tr>"+"<td>"+data[i].ref_surat_nama+"</td>";
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
