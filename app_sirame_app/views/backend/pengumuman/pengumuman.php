<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pengumuman
			<small><?= webname() ?></small>
        </h1>
        <ol class="breadcrumb">
            <li class="active"><i class="fa fa-bullhorn"></i> Pengumuman</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0">
            <div class="box box-success">
                <div class="box-header with-border">
					<?php if (menu(27)) { ?>
                    <a href="<?php echo base_url(); ?>pengumuman/form-add/">
						<button type="button" class="btn bg-orange btn-flat margin pull-right" style="margin: 0">
                            <span class="fa  fa-plus" style="margin-right: 5px"></span>
                            Add
                        </button>
                    </a>
					<?php } ?>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
					<div class="col-sm-12" style="padding: 0; overflow-x: scroll; overflow-y: hidden;">
                        <?php if($this->session->flashdata('error')) { ?>
                            <div class="alert alert-warning alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-ban"></i>Peringatan!</h4>
                                <?php echo $this->session->flashdata('error'); ?>
                            </div>
                        <?php } else if ($this->session->flashdata('success')) { ?>
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-check"></i>Berhasil!</h4>
                                <?php echo $this->session->flashdata('success'); ?>
                            </div>
                        <?php } ?>
                        <table id="example1" class="table table-bordered table-striped" style="width: auto">
                            <thead>
                            <tr>
                                <th style="width: 10px">#</th>
								<th><span class="fa fa-gear"></span></th>
								<th>Judul</th>
								<th>Tanggal</th>
								<th>Berkas</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $n=1; foreach ($pengumuman as $field) { ?>
                                <tr>
                                    <td><?php echo $n++; ?></td>
									<td>
										<?php if (menu(28)) { ?>
											<a href="<?php echo base_url(); ?>pengumuman/form_edit/<?php echo $field->idPengumuman; ?>">
												<button type="button" class="btn bg-blue-gradient btn-flat margin" title="Ubah" style="margin: 0; min-width: 40px">
													<span class="fa fa-edit"></span>
												</button>
											</a>
										<?php } ?>
										<?php if (menu(29)) { ?>
											<a href="#" class="edit-record" data-id="<?php echo $field->idPengumuman; ?>">
												<button type="button" class="btn bg-red-gradient btn-flat margin" title="Hapus" style="margin: 0; min-width: 40px">
													<span class="fa fa-remove"></span>
												</button>
											</a>
										<?php } ?>
									</td>
                                    <td><?php echo $field->judul; ?></td>
                                    <td><?php echo datetime($field->waktu); ?></td>
                                    <td>
										<?php if ($field->berkas != '') { ?>
										<a href="<?php echo base_url(); ?>pengumuman/unduh/?file=<?php echo $field->berkas; ?>" target="_blank">
											<button type="button" class="btn bg-purple-gradient btn-flat margin" title="Unduh" style="margin: 0; min-width: 40px">
												<span class="fa fa-download"></span>
											</button>
										</a>
										<?php } ?>
									</td>
                                </tr>
                            <?php } ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
								<th><span class="fa fa-gear"></span></th>
								<th>Judul</th>
								<th>Tanggal</th>
								<th>Berkas</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
    </section><div style="clear:both;"></div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div id="myModal" class="modal fade modal-danger" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="icon fa fa-warning"></i> Konfirmasi</h4>
            </div>
            <div class="modal-body">
                <p>Yakin akan menghapus data ini?&hellip;</p>
            </div>
            <div class="modal-footer">
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url(); ?>assets/lte/plugins/jQuery/jquery-2.2.3.min.js"></script>

<!-- page script -->
<script>
    $(function () {
        $("#example1").DataTable();
    });
</script>

<script>
    $(function(){
        var csfrData = {};
        csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
        $.ajaxSetup({
            data: csfrData
        });
        $(document).on('click','.edit-record',function(e){
            e.preventDefault();
            $("#myModal").modal('show');
            $.get('<?php echo base_url(); ?>pengumuman/form_del',
                {id:$(this).attr('data-id'),data:csfrData},
                function(html){
                    $(".modal-footer").html(html);
                }
            );
        });
    });
</script>
