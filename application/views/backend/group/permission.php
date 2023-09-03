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
            <li class="active"><i class="fa fa-user-secret"></i> Permission</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="col-md-12" style="padding: 0">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title" style="margin-top: 5px">Permission</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col-sm-12" style="padding: 0">
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
						<table class="table table-bordered">
							<tr>
								<td><label>Group</label></td>
								<td><?= $group[0]->role ?></td>
							</tr>
						</table>

						<table id="example1" class="table table-bordered table-striped" style="width: auto">
							<thead>
							<tr>
								<th style="width: 10px">#</th>
								<th>Permission</th>
								<th>Status</th>
								<th><span class="fa fa-gear"></span></th>
							</tr>
							</thead>
							<tbody>
							<?php $n=1; foreach ($permission as $field) { ?>
								<tr>
									<td><?= $n++; ?></td>
									<td><?= $field->menu; ?></td>
									<td>
										<?php if ($field->akses == '1') { ?>
										<span class="fa fa-check" style="color: green"></span>
										<?php } elseif ($field->akses == '0') { ?>
										<span class="fa fa-close" style="color: red"></span>
										<?php } ?>
									</td>
									<td>
										<?php if ($field->akses == '0') { ?>
										<?php if (menu(13)) { ?>
											<a href="#" class="add-record" data-id="<?= $field->idpermission; ?>" data-id2="<?= $field->idgroup; ?>">
												<button type="button" class="btn bg-green btn-flat margin" title="Buka Akses" style="margin: 0; min-width: 40px">
													<span class="fa fa-check"></span>
												</button>
											</a>
										<?php } ?>
										<?php } ?>
										<?php if ($field->akses == '1') { ?>
										<?php if (menu(14)) { ?>
											<a href="#" class="edit-record" data-id="<?= $field->idpermission; ?>" data-id2="<?= $field->idgroup; ?>">
												<button type="button" class="btn bg-red btn-flat margin" title="Tutup Akses" style="margin: 0; min-width: 40px">
													<span class="fa fa-remove"></span>
												</button>
											</a>
										<?php } ?>
										<?php } ?>
									</td>
								</tr>
							<?php } ?>
							</tbody>
							<tfoot>
							<tr>
								<th>#</th>
								<th>Permission</th>
								<th>Status</th>
								<th><span class="fa fa-gear"></span></th>
							</tr>
							</tfoot>
						</table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
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
				<p>Yakin akan menutup akses menu ini?</p>
			</div>
			<div class="modal-footer">
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div id="myModal2" class="modal fade modal-success" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="icon fa fa-warning"></i> Konfirmasi</h4>
			</div>
			<div class="modal-body">
				<p>Yakin akan membuka akses menu ini?</p>
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
        $.ajaxSetup({
            data: csfrData
        });
        $(document).on('click','.edit-record',function(e){
            e.preventDefault();
            $("#myModal").modal('show');
            $.get('<?php echo base_url(); ?>group/permission-del',
                {id:$(this).attr('data-id'),id2:$(this).attr('data-id2'),data: csfrData},
                function(html){
                    $(".modal-footer").html(html);
                }
            );
        });
    });
</script>
<script>
    $(function(){
        var csfrData = {};
        $.ajaxSetup({
            data: csfrData
        });
        $(document).on('click','.add-record',function(e){
            e.preventDefault();
            $("#myModal2").modal('show');
            $.get('<?php echo base_url(); ?>group/permission-add',
                {id:$(this).attr('data-id'),id2:$(this).attr('data-id2'),data: csfrData},
                function(html){
                    $(".modal-footer").html(html);
                }
            );
        });
    });
</script>
