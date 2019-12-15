<div class="box-footer">
	<div class="row">
		<div class="col-xs-12">
			<?php if ($mandiri): ?>
				<button type="reset" onclick="window.history.back();" class="btn btn-social btn-flat btn-danger btn-sm"><i class="fa fa-times"></i> Batal</button>
			<?php else: ?>
				<button type="reset" onclick="$('#validasi').trigger('reset');" class="btn btn-social btn-flat btn-danger btn-sm"><i class="fa fa-times"></i> Batal</button>
			<?php endif; ?>
			<?php if (SuratCetak($url)): ?>
				<button type="button" onclick="$('#'+'validasi').attr('action','<?= $form_action?>');$('#'+'validasi').submit();" class="btn btn-social btn-flat btn-info btn-sm pull-right"><i class="fa fa-print"></i> Cetak</button>
			<?php endif; ?>
			<?php if ($mandiri): ?>
				<button type="button" onclick="$('#validasi').attr('action', '<?= site_url('permohonan_surat/kirim')?>'); $('#validasi').submit();" class="btn btn-social btn-flat btn-success btn-sm pull-right" style="margin-right: 5px;"><i class="fa fa-file-text"></i> Kirim</button>
			<?php else: ?>
				<?php if (SuratExport($url)): ?>
					<button type="button" onclick="$('#'+'validasi').attr('action','<?= $form_action2?>');$('#'+'validasi').submit();" class="btn btn-social btn-flat btn-success btn-sm pull-right" style="margin-right: 5px;"><i class="fa fa-file-text"></i> Ekspor Dok</button>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	</div>
</div>
