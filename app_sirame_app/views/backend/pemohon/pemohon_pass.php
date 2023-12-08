<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Pengguna (Masyarakat)
			<small><?= webname() ?></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>pemohon-adm"><i class="fa fa-user-secret"></i>Pengguna (Masyarakat)</a></li>
			<li class="active"><i class="fa fa-lock"></i> Ubah Password</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
			<div class="box box-warning">
				<div class="box-body">
					<div class="col-sm-12" style="padding: 0;">
						<form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>pemohon-adm/edit-pass">
							<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
							<table class="table table-bordered" style="margin-bottom: 0">
								<?php if($this->session->flashdata('error')) { ?>
									<tr><td>
											<div class="alert alert-warning alert-dismissible">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
												<h4><i class="icon fa fa-ban"></i>Peringatan!</h4>
												<?php echo $this->session->flashdata('error'); ?>
											</div>
										</td></tr>
								<?php } ?>
								<tr>
									<td>
										<div class="row">
											<div class="col-xs-6">
												<label>Password Baru</label>
												<input type="password" class="form-control" name="password" id="password" required onkeyup="digit_pass()">
												<input type="hidden" name="idpemohon" value="<?= $pemohon[0]->idpemohon ?>" required>
												<span id="span-pass" class="text-red"></span>
											</div>
											<div class="col-xs-6">
												<label>Ketik Ulang Password Baru</label>
												<input type="password" class="form-control" name="password2" id="password2" required onkeyup="valid_pass()">
												<span id="span-valid" class="text-red"></span>
											</div>
									</td>
								</tr>
								<tr>
									<td>
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
	</section><div style="clear:both;"></div>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div style="clear:both;"></div>

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url(); ?>assets/lte/plugins/jQuery/jquery-2.2.3.min.js"></script>

<!-- page script -->
<script>
    $(function () {
        $("#example1").DataTable();
    });
</script>

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
