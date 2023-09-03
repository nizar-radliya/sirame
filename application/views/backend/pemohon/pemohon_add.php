<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
			Pengguna (Masyarakat)
			<small><?= webname() ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>pemohon-adm"><i class="fa fa-user-secret"></i> Pengguna (Masyarakat)</a></li>
            <li class="active"><i class="fa fa-plus"></i> Tambah Pengguna (Masyarakat)</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="col-md-12" style="padding: 0">
            <div class="box box-warning">
                <div class="box-body">
                    <div class="col-sm-12" style="padding: 0">
                        <form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>pemohon-adm/add">
							<?php if ($this->session->flashdata('error')) { ?>
								<div class="alert alert-warning alert-dismissible">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
										&times;
									</button>
									<h4><i class="icon fa fa-ban"></i>Peringatan!</h4>
									<?php echo $this->session->flashdata('error'); ?>
								</div>
							<?php } ?>
							<table class="table table-bordered" style="margin-bottom: 0">
								<tr>
									<td width="50%">
										<label>Nomor KTP</label>
										<input type="number" name="noktp" id="noktp" class="form-control" placeholder="Nomor KTP" required onkeyup="digit_noktp()">
										<span id="span-noktp" class="text-red"></span>
									</td>
									<td width="50%">
										<label>Nama Lengkap</label>
										<input type="text" class="form-control" name="nama" required>
									</td>
								</tr>
								<tr>
									<td>
										<label>Jenis Kelamin</label>
										<select class="form-control" name="jk" required>
											<option value="" disabled selected>Jenis Kelamin</option>
											<?php foreach ($jk as $i) { ?>
												<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
											<?php } ?>
										</select>
									</td>
									<td>
										<label>Pekerjaan</label>
										<input type="text" class="form-control" name="pekerjaan" required>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<label>Alamat</label>
										<input type="text" class="form-control" name="alamat" required>
									</td>
								</tr>
								<tr>
									<td>
										<label>Provinsi</label>
										<select name="id_prov" class="form-control select2" id="prov" required>
											<option value="" disabled selected>Pilih Provinsi</option>
											<?php
											foreach ($provinsi as $prov) {
												echo '<option value="' . $prov->id_prov . '">' . $prov->nama_prov . '</option>';
											}
											?>
										</select>
									</td>
									<td>
										<label>Kabupaten/Kota</label>
										<select name="id_kota" class="form-control select2" id="kota" required>
											<option value='' disabled selected>Pilih Kabupaten Kota</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<label>Kecamatan</label>
										<select name="id_kec" class="form-control select2" id="kec" required>
											<option value='' disabled selected>Pilih Kecamatan</option>
										</select>
									</td>
									<td>
										<label>Kode Pos</label>
										<input type="number" class="form-control" name="kodepos" required>
									</td>
								</tr>
								<tr>
									<td>
										<label>Email</label>
										<input type="email" class="form-control" name="email" required>
									</td>
									<td>
										<label>Nomor Handphone</label>
										<input type="text" class="form-control" name="hp" required>
									</td>
								</tr>
								<tr>
									<td>
										<label>Password</label>
										<input type="password" name="password" id="password" class="form-control" placeholder="Password" required onkeyup="digit_pass()">
										<span id="span-pass" class="text-red"></span>
									</td>
									<td>
										<label>Konfirmasi Password</label>
										<input type="password" name="password2" id="password2" class="form-control" placeholder="Konfirmasi Password" required  onkeyup="valid_pass()">
										<span id="span-valid" class="text-red"></span>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<button type="submit" class="btn btn-warning" id="simpan">
											<span class="fa fa-save" style="margin-right: 5px"></span>
											Simpan
										</button>
									</td>
								</tr>
							</table>
                        </form>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </section><div style="clear:both;"></div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div style="clear:both;"></div>

<script>
	$(document).ready(function () {
		$("#prov").change(function () {
			var url = "<?php echo site_url('pemohon-adm/add_ajax_kota');?>/" + $(this).val();
			$('#kota').load(url);
			return false;
		})
	});

	$(document).ready(function () {
		$("#kota").change(function () {
			var url = "<?php echo site_url('pemohon-adm/add_ajax_kec');?>/" + $(this).val();
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
			document.getElementById("span-noktp").innerHTML = "";
		} else {
			document.getElementById("simpan").disabled = true;
			document.getElementById("span-noktp").innerHTML = "<i class='fa fa-exclamation'></i> Nomor KTP harus 16 digit";
		}
	}

    function digit_pass() {
        var password = document.getElementById('password').value;
        if ((password.length < 6)) {
            document.getElementById("simpan").disabled = true;
            document.getElementById("span-pass").innerHTML = "<i class='fa fa-exclamation'></i> Password masih kurang dari 6 karakter";
        } else {
            document.getElementById("simpan").disabled = false;
            document.getElementById("span-pass").innerHTML = "";
        }
    }

    function valid_pass() {
        var password    = document.getElementById('password').value;
        var password2   = document.getElementById('password2').value;
        if (password != password2) {
            document.getElementById("simpan").disabled = true;
            document.getElementById("span-valid").innerHTML = "<i class='fa fa-exclamation'></i> Password masih belum sama";
        } else {
            document.getElementById("simpan").disabled = false;
            document.getElementById("span-valid").innerHTML = "";
        }
    }
</script>
