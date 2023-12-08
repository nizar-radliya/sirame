<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pengumuman
			<small><?= webname() ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>pengumuman"><i class="fa fa-bullhorn"></i>Pengumuman</a></li>
            <li class="active"><i class="fa fa-plus"></i> Tambah Pengumuman</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="col-md-12" style="padding: 0">
            <div class="box box-warning">
                <div class="box-body">
					<div class="col-sm-12" style="padding: 0">
                        <form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>pengumuman/add">
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
                                        <label>Judul</label>
                                        <input type="text" class="form-control" name="judul" required="required" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Berkas</label>
                                        <input type="file" id="exampleInputFile" name="berkas">
										<span style="font-size: 12px; font-style: italic">*Boleh dikosongkan.</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Isi Pengumuman</label>
                                        <textarea id="editor1" name="isi" required="required"></textarea>
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
