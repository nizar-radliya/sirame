<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
			Ubah Pengguna
			<small><?= webname() ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>pengguna"><i class="fa fa-user"></i> Pengguna</a></li>
            <li class="active"><i class="fa fa-edit"></i> Ubah Pengguna</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="col-md-12" style="padding: 0">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title" style="margin-top: 5px">Ubah Data</h3>

					<?php if (menu(7)) { ?>
					<a href="<?php echo base_url(); ?>pengguna/form-pass/<?= $pengguna[0]->idpengguna; ?>">
						<button type="button" class="btn bg-yellow-gradient btn-flat pull-right" style="margin-top: 0; margin-right: 0; margin-bottom: 0">
							<span class="fa fa-lock" style="margin-right: 5px"></span>
							Ubah Password
						</button>
					</a>
					<?php } ?>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col-sm-12" style="padding: 0">
                        <form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>pengguna/edit">
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
							<table class="table table-bordered" style="margin-bottom: 0">
                                <tr>
                                    <td width="50%">
                                        <label>NIP</label>
                                        <input type="text" class="form-control" name="nip" value="<?= $pengguna[0]->nip ?>" required>
                                        <input type="hidden" class="form-control" name="idpengguna" value="<?= $pengguna[0]->idpengguna ?>" required>
                                    </td>
									<td width="50%">
										<label>Nama Lengkap</label>
										<input type="text" class="form-control" name="nama" value="<?= $pengguna[0]->nama ?>" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Group</label>
										<select class="form-control" name="idgroup" required>
											<option value="" selected disabled>Pilih</option>
											<?php foreach ($group as $row) { ?>
												<?php if ($row->idgroup == $pengguna[0]->idgroup) { ?>
													<option value="<?= $row->idgroup ?>" selected><?= $row->role ?></option>
												<?php } else { ?>
													<option value="<?= $row->idgroup ?>"><?= $row->role ?></option>
												<?php } ?>
											<?php } ?>
										</select>
                                    </td>
									<td>
										<label>Username</label>
										<input type="text" class="form-control" name="username" value="<?= $pengguna[0]->username ?>" onfocus="this.value=''" required>
									</td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" value="<?= $pengguna[0]->email ?>" required>
                                    </td>
									<td>
										<label>Handphone</label>
										<input type="text" class="form-control" name="hp" value="<?= $pengguna[0]->hp ?>" required>
									</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
										<label>Foto</label> (JPG/JPEG/PNG)
										<input type="file" id="exampleInputFile" name="foto">
										<input type="hidden" name="file_name" value="<?= $pengguna[0]->foto; ?>">
										<?php if ($pengguna[0]->foto != null || $pengguna[0]->foto != '') { ?>
											<a href="<?= base_url() ?>/assets/file/pengguna/<?= $pengguna[0]->foto; ?>" target="_blank">
												<img src="<?= base_url() ?>/assets/file/pengguna/<?= $pengguna[0]->foto; ?>" width="90" style="margin-top: 10px">
											</a>
										<?php } ?>
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
