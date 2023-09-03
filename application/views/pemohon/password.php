<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
			<small><?= webname() ?></small>
        </h1>
        <ol class="breadcrumb">
            <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content" style="padding-top: 0">
        <div class="col-md-12" style="padding: 15px;">

			<div class="row">
				<div class="col-md-6" style="padding: 0;">
					<div class="box box-success">
						<div class="box-header with-border">
							<h3 class="box-title"><i class="fa fa-key"></i> Ubah Password</h3>
						</div>
						<div class="box-body">
					<form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>pemohon/pass">
						<?php if ($this->session->flashdata('error')) { ?>
							<div class="alert alert-warning alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
									&times;
								</button>
								<h4><i class="icon fa fa-ban"></i>Peringatan!</h4>
								<?php echo $this->session->flashdata('error'); ?>
							</div>
						<?php } ?>
						<?php if ($this->session->flashdata('success')) { ?>
							<div class="alert alert-success alert-dismissible" style="margin-bottom: 0">
								<button type="button" class="close" data-dismiss="alert"
										aria-hidden="true">&times;
								</button>
								<h4><i class="icon fa fa-check"></i>Berhasil!</h4>
								<?php echo $this->session->flashdata('success'); ?>
							</div>
						<?php } ?>
						<table class="table table-bordered" style="background-color: #FFFFFF; margin-bottom: 0">
							<tr>
								<td>
									<label>Password Sekarang</label>
									<input type="password" class="form-control" name="pass" required>
								</td>
							</tr>
							<tr>
								<td>
									<label>Password Baru</label>
									<input type="password" class="form-control" name="password" id="password" required onkeyup="digit_pass()">
									<span id="span-pass" class="text-red"></span>
								</td>
							</tr>
							<tr>
								<td>
									<label>Ketik Ulang Password Baru</label>
									<input type="password" class="form-control" name="password2" id="password2" required onkeyup="valid_pass()">
									<span id="span-valid" class="text-red"></span>
								</td>
							</tr>
							<tr>
								<td>
									<button type="submit" class="btn btn-warning" id="simpan" style="float: right">
										<span class="fa fa-save" style="margin-right: 5px"></span>
										Simpan
									</button>
									<a href="<?= base_url(); ?>pemohon">
									<button type="button" class="btn btn-danger" id="simpan" style="float: right; margin-right: 5px">
										<span class="fa fa-user" style="margin-right: 5px"></span>
										Biodata
									</button>
									</a>
								</td>
							</tr>
						</table>
					</form>
						</div>
					</div>
				</div>
			</div>
    </section>
	<div style="clear:both;"></div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div style="clear:both;"></div>

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url(); ?>assets/lte/plugins/jQuery/jquery-2.2.3.min.js"></script>

<script>
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
