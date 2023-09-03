<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pengguna
			<small><?= webname() ?></small>
        </h1>
        <ol class="breadcrumb">
			<li class="active"><i class="fa fa-user"></i> Pengguna</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0">
            <div class="box box-success">
                <div class="box-header with-border">
					<?php if (menu(3)) { ?>
                    <a href="<?php echo base_url(); ?>pengguna/form-add">
                        <button type="button" class="btn bg-yellow-gradient btn-flat margin pull-right" style="margin-top: 0; margin-right: 0; margin-bottom: 0">
                            <span class="fa  fa-plus" style="margin-right: 5px"></span>
                            Tambah
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
                        <table id="example1" class="table table-bordered table-striped" style="width: 1240px">
                            <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Nama Lengkap</th>
								<th>NIP</th>
                                <th>Username</th>
                                <th>Group</th>
                                <th>Phone</th>
								<th width="10%"><span class="fa fa-gear"></span></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $n=1; foreach ($pengguna as $field) { ?>
                                <tr>
                                    <td><?php echo $n++; ?></td>
                                    <td><?php echo $field->nama; ?></td>
                                    <td><?php echo $field->nip; ?></td>
                                    <td><?php echo $field->username; ?></td>
									<td>
										<a href="<?php echo base_url(); ?>group/permission/<?php echo $field->idgroup; ?>">
											<?php echo read($field->idgroup,'group','idgroup')[0]->role; ?>
										</a>
									</td>
                                    <td><?php echo $field->hp; ?></td>
                                    <td>
										<?php if ($field->idpengguna == $this->session->userdata['idpengguna'] || $this->session->userdata['idpengguna']=='1') { ?>
										<?php if (menu(4)) { ?>
                                        <a href="<?php echo base_url(); ?>pengguna/form-edit/<?php echo $field->idpengguna; ?>">
                                            <button type="button" class="btn bg-blue-gradient btn-flat margin" title="Ubah Data" style="margin: 0; min-width: 40px">
                                                <span class="fa fa-edit"></span>
                                            </button>
                                        </a>
										<?php } } if (menu(6)) { ?>
                                        <a href="<?php echo base_url(); ?>pengguna/reset/<?php echo $field->idpengguna; ?>/<?php echo $field->hp; ?>">
                                            <button type="button" class="btn bg-maroon-gradient btn-flat margin" title="Reset Password" style="margin: 0; min-width: 40px">
                                                <span class="fa fa-key"></span>
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
                                <th>Nama Lengkap</th>
								<th>NIP</th>
                                <th>Username</th>
                                <th>Level</th>
                                <th>Phone</th>
                                <th><span class="fa fa-gear"></span></th>
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
				<p>Yakin akan menghapus data ini?</p>
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
        $(document).on('click','.edit-record',function(e){
            e.preventDefault();
            $("#myModal").modal('show');
            $.post('<?php echo base_url(); ?>pengguna/form_del',
                {id:$(this).attr('data-id')},
                function(html){
                    $(".modal-footer").html(html);
                }
            );
        });
    });
</script>
