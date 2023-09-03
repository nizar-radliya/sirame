<div class="container">
	<div class="row pt-5 mt-3 pb-3">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<?php if($this->session->flashdata('error')) { ?>
					<div class="alert alert-warning">
						<strong><i class="fas fa-ban"></i></strong> <?php echo $this->session->flashdata('error'); ?>
					</div>
				<?php } ?>
				<?php if($this->session->flashdata('success')) { ?>
					<div class="alert alert-success">
						<strong><i class="far fa-thumbs-up"></i></strong> <?php echo $this->session->flashdata('success'); ?>
					</div>
				<?php } ?>
				<form action="<?php echo base_url(); ?>daftar/add" method="post">
					<div class="row">
						<div class="form-group col">
							<label class="form-label text-color-dark text-3">Nomor KTP <span class="text-color-danger">*</span></label>
							<input type="number" name="noktp" id="noktp" class="form-control form-control-lg text-4" required onkeyup="digit_noktp()">
							<div class="alert alert-warning alert-sm" id="alert-noktp" style="display: none"></div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col">
							<label class="form-label text-color-dark text-3">Nama lengkap <span class="text-color-danger">*</span></label>
							<input type="text" name="nama" class="form-control form-control-lg text-4" required>
						</div>
					</div>
					<div class="row">
						<div class="form-group col">
							<label class="form-label text-color-dark text-3">Jenis Kelamin <span class="text-color-danger">*</span></label>
							<select class="form-control form-control-lg text-4" name="jk" required>
								<option value="" disabled selected></option>
								<?php foreach ($jk as $i) { ?>
									<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="form-group col">
							<label class="form-label text-color-dark text-3">Pekerjaan <span class="text-color-danger">*</span></label>
							<input type="text" name="pekerjaan" class="form-control form-control-lg text-4" required>
						</div>
					</div>
					<div class="row">
						<div class="form-group col">
							<label class="form-label text-color-dark text-3">Nomor Handphone <span class="text-color-danger">*</span></label>
							<input type="text" name="hp" class="form-control form-control-lg text-4" required>
						</div>
					</div>
					<div class="row">
						<div class="form-group col">
							<label class="form-label text-color-dark text-3">Email <span class="text-color-danger">*</span></label>
							<input type="email" name="email" class="form-control form-control-lg text-4" required>
						</div>
					</div>
					<div class="row">
						<div class="form-group col">
							<label class="form-label text-color-dark text-3">Alamat <span class="text-color-danger">*</span></label>
							<input type="text" name="alamat" class="form-control form-control-lg text-4" required>
						</div>
					</div>
					<div class="row">
						<div class="form-group col">
							<label class="form-label text-color-dark text-3">Kode Pos <span class="text-color-danger">*</span></label>
							<input type="number" name="kodepos" class="form-control form-control-lg text-4" required>
						</div>
					</div>
					<div class="row">
						<div class="form-group col">
							<label class="form-label text-color-dark text-3">Provinsi <span class="text-color-danger">*</span></label>
							<select name="id_prov" class="form-control form-control-lg text-4 select2" id="prov" required>
								<option value="" disabled selected></option>
								<?php
								foreach ($provinsi as $prov) {
									echo '<option value="' . $prov->id_prov . '">' . $prov->nama_prov . '</option>';
								}
								?>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="form-group col">
							<label class="form-label text-color-dark text-3">Kabupaten/Kota <span class="text-color-danger">*</span></label>
							<select name="id_kota" class="form-control form-control-lg text-4 select2" id="kota" required>
								<option value='' disabled selected></option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="form-group col">
							<label class="form-label text-color-dark text-3">Kecamatan <span class="text-color-danger">*</span></label>
							<select name="id_kec" class="form-control form-control-lg text-4 select2" id="kec" required>
								<option value='' disabled selected></option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="form-group col">
							<label class="form-label text-color-dark text-3">Password <span class="text-color-danger">*</span></label>
							<input type="password" name="password" id="password" class="form-control form-control-lg text-4" required onkeyup="digit_pass()">
							<div class="alert alert-warning alert-sm" id="alert-pass" style="display: none"></div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col">
							<label class="form-label text-color-dark text-3">Ketik Ulang Password <span class="text-color-danger">*</span></label>
							<input type="password" name="password2" id="password2" class="form-control form-control-lg text-4" required onkeyup="valid_pass()">
							<div class="alert alert-warning alert-sm" id="alert-valid" style="display: none"></div>
						</div>
					</div>
					<div class="row justify-content-between">
						<div class="form-group col-md-auto">
							<?php echo $recaptcha_html;?>
							<?php echo form_error('g-recaptcha-response'); ?>
						</div>
					</div>
					<div class="row">
						<div class="form-group col">
							<button type="submit" id="simpan" class="btn btn-warning btn-modern w-100 text-uppercase rounded-0 font-weight-bold text-3 py-3" data-loading-text="Loading...">DAFTAR</button>
							<div class="divider">
								<span class="bg-light px-4 position-absolute left-50pct top-50pct transform3dxy-n50">or</span>
							</div>
							<a href="<?php echo base_url(); ?>log/sitaru" class="btn btn-success btn-modern w-100 text-transform-none rounded-0 font-weight-bold align-items-center d-inline-flex justify-content-center text-3 py-3" data-loading-text="Loading...">MASUK</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function () {
		$("#prov").change(function () {
			var url = "<?php echo site_url('daftar/add_ajax_kota');?>/" + $(this).val();
			$('#kota').load(url);
			return false;
		})
	});

	$(document).ready(function () {
		$("#kota").change(function () {
			var url = "<?php echo site_url('daftar/add_ajax_kec');?>/" + $(this).val();
			$('#kec').load(url);
			return false;
		})
	});
</script>

<script>
	function digit_noktp() {
		var noktp = document.getElementById('noktp').value;
		if ((noktp.length == 16)) {
			document.getElementById("simpan").disabled = false;
			document.getElementById("alert-noktp").style.display = 'none';
			document.getElementById("alert-noktp").innerHTML = "";
		} else {
			document.getElementById("simpan").disabled = true;
			document.getElementById("alert-noktp").style.display = 'block';
			document.getElementById("alert-noktp").innerHTML = "<i class='fa fa-exclamation'></i> Nomor KTP harus 16 digit";
		}
	}

	function digit_pass() {
		var password = document.getElementById('password').value;
		if ((password.length < 6)) {
			document.getElementById("simpan").disabled = true;
			document.getElementById("alert-pass").style.display = 'block';
			document.getElementById("alert-pass").innerHTML = "<i class='fa fa-exclamation'></i> Password masih kurang dari 6 karakter";
		} else {
			document.getElementById("simpan").disabled = false;
			document.getElementById("alert-pass").style.display = 'none';
			document.getElementById("alert-pass").innerHTML = "";
		}
	}

	function valid_pass() {
		var password    = document.getElementById('password').value;
		var password2   = document.getElementById('password2').value;
		if (password != password2) {
			document.getElementById("simpan").disabled = true;
			document.getElementById("alert-valid").style.display = 'block';
			document.getElementById("alert-valid").innerHTML = "<i class='fa fa-exclamation'></i> Password masih belum sama";
		} else {
			document.getElementById("simpan").disabled = false;
			document.getElementById("alert-valid").style.display = 'none';
			document.getElementById("alert-valid").innerHTML = "";
		}
	}
</script>
