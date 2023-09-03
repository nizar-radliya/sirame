<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
			Group
			<small><?= webname() ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>group"><i class="fa fa-users"></i> Group</a></li>
            <li class="active"><i class="fa fa-edit"></i> Ubah Group</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="col-md-12" style="padding: 0">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title" style="margin-top: 5px">Ubah Data</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col-sm-12" style="padding: 0">
                        <!--start ========================================================================================= work-->
                        <form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>group/edit">
                            <table class="table table-bordered">
                                <?php if($this->session->flashdata('error')) { ?>
                                    <tr><td>
                                            <div class="alert alert-warning alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <h4><i class="icon fa fa-ban"></i>Peringatan!</h4>
                                                <?php echo $this->session->flashdata('error'); ?>
                                            </div>
                                    </td></tr>
								<?php } else if ($this->session->flashdata('success')) { ?>
									<tr><td>
										<div class="alert alert-success alert-dismissible">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
											<h4><i class="icon fa fa-check"></i>Berhasil!</h4>
											<?php echo $this->session->flashdata('success'); ?>
										</div>
									</td></tr>
								<?php } ?>
                                <tr>
                                    <td>
                                        <label>Group</label>
                                        <input type="text" class="form-control" name="role" value="<?= $group[0]->role ?>" required>
                                        <input type="hidden" class="form-control" name="idgroup" value="<?= $group[0]->idgroup ?>" required>
                                    </td>
                                </tr>
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
