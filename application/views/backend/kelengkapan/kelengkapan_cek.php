<form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>kelengkapan-adm/cek">
	<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
	<table class="table table-bordered" style="margin-bottom: 0">
		<tr>
			<td>
				<label><?= read($kelengkapan[0]->idjenis,'jeniskelengkapan','idjenis')[0]->jeniskelengkapan ?></label>
				<input type="hidden" name="nomor" value="<?= $id ?>" readonly>
				<input type="hidden" name="idkelengkapan" value="<?= $id2 ?>" readonly>
			</td>
		</tr>
		<tr>
			<td>
				<label>Verifikasi Persyaratan</label>
				<select class="form-control" name="statuskelengkapan" required>
					<?php foreach ($statuskelengkapan as $i) { ?>
						<?php if ($i == $kelengkapan[0]->statuskelengkapan) { ?>
							<option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
						<?php } else { ?>
							<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						<?php } } ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<label>Catatan</label>
				<textarea name="catatan" class="form-control" rows="4" style="resize: none" placeholder="Tuliskan catatan untuk pemohon."><?= $kelengkapan[0]->catatan; ?></textarea>
			</td>
		</tr>
		<tr>
			<td>
				<button type="submit" class="btn btn-warning" id="simpan">
					<span class="fa fa-upload" style="margin-right: 5px"></span>
					Simpan
				</button>
			</td>
		</tr>
	</table>
</form>

<script>
	function digit_nokelengkapan() {
		var nokelengkapan = document.getElementById('nokelengkapan').value;
		if ((nokelengkapan.length == 16)) {
			document.getElementById("simpan").disabled = false;
			document.getElementById("span-nokelengkapan").innerHTML = "";
		} else {
			document.getElementById("simpan").disabled = true;
			document.getElementById("span-nokelengkapan").innerHTML = "<i class='fa fa-exclamation'></i> Nomor KTP harus 16 digit";
		}
	}
</script>
