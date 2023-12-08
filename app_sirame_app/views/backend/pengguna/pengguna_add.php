<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
			Tambah Pengguna
			<small><?= webname() ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>pengguna"><i class="fa fa-user"></i> Pengguna</a></li>
            <li class="active"><i class="fa fa-plus"></i> Tambah Pengguna</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="col-md-12" style="padding: 0">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title" style="margin-top: 5px">Tambah Data</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col-sm-12" style="padding: 0">
                        <!--start ========================================================================================= work-->
                        <form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>pengguna/add">
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
                                        <label>NIP</label>
                                        <input type="text" class="form-control" name="nip" required>
                                    </td>
									<td width="50%">
										<label>Nama Lengkap</label>
										<input type="text" class="form-control" name="nama" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Group</label>
										<select class="form-control" name="idgroup" required>
											<option value="" selected disabled>Pilih</option>
											<?php foreach ($group as $row) { ?>
												<option value="<?= $row->idgroup ?>"><?= $row->role ?></option>
											<?php } ?>
										</select>
                                    </td>
									<td>
										<label>Username</label>
										<input type="text" class="form-control" name="username" onfocus="this.value=''" required>
									</td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password" id="password" onkeyup="digit_pass()" onfocus="this.value=''" placeholder="Minimal 6 karakter" required>
										<span id="span-pass" class="text-red"></span>
                                    </td>
									<td>
										<label>Konfirmasi Password</label>
										<input type="password" class="form-control" name="password2" id="password2" onkeyup="valid_pass()" onfocus="this.value=''" placeholder="Ketik ulang password" required>
										<span id="span-valid" class="text-red"></span>
									</td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" required>
                                    </td>
									<td>
										<label>Handphone</label>
										<input type="text" class="form-control" name="hp" required>
									</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
										<label>Foto</label>
										<input type="file" id="exampleInputFile" name="foto" required>
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
                        <!--end =========================================================================================== work-->
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
