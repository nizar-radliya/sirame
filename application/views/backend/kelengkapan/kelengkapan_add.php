<form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>kelengkapan/add-kelengkapan">
	<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
	<table class="table table-bordered" style="margin-bottom: 0">
		<tr>
			<td>
				<label><?= $jenis[0]->jeniskelengkapan ?></label>
				<br>
				<span class="text-white">* <?= $jenis[0]->keterangankelengkapan ?></span><br>
				<span class="text-white">* Format File: <?= $jenis[0]->type ?></span>
				<input type="hidden" name="nomor" value="<?= $kkpr[0]->nomor ?>" readonly>
				<input type="hidden" name="idpemohon" value="<?= $kkpr[0]->idpemohon ?>" readonly>
				<input type="hidden" name="idjenis" value="<?= $jenis[0]->idjenis ?>" readonly>
				<input type="hidden" name="type" value="<?= $jenis[0]->type ?>" readonly>
				<input type="hidden" name="init" value="<?= $jenis[0]->init ?>" readonly>
			</td>
		</tr>
		<tr>
			<td>
				<label>File Persyaratan</label>
				<input type="file" id="exampleInputFile" name="filekelengkapan" required>
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
	function digit_noktp() {
		var noktp = document.getElementById('noktp').value;
		if ((noktp.length == 16)) {
			document.getElementById("simpan").disabled = false;
			document.getElementById("span-noktp").innerHTML = "";
		} else {
			document.getElementById("simpan").disabled = true;
			document.getElementById("span-noktp").innerHTML = "<i class='fa fa-exclamation'></i> Nomor KTP harus 16 digit";
		}
	}
</script>
