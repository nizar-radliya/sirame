<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
			File
            <small><?= webname() ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>file-adm"><i class="fa fa-file-text"></i>File</a></li>
			<li class="active"><i class="fa fa-plus-circle"></i> Tambah File</li>
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
                    <div class="col-sm-12" style="padding: 0;">
                        <form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>file-adm/add">
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                            <table class="table table-bordered">
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
                                        <label>Nama File</label>
                                        <input type="text" class="form-control" name="nama" required />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Pilih File</label>
                                        <input type="file" id="exampleInputFile" name="file_rtrw" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Keterangan</label>
										<input type="text" class="form-control" name="keterangan" required />
                                    </td>
                                </tr>
								<td>
									<label>Sifat</label>
									<select multiple class="form-control" name="sifat" required style="height: 53px">
										<?php foreach ($sifat as $i) { ?>
											<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
										<?php } ?>
									</select>
								</td>
                                <tr>
                                    <td>
										<button type="submit" class="btn btn-warning" id="save">
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
