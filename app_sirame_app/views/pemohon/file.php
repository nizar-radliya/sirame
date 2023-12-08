<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Download File
			<small><?= webname() ?></small>
		</h1>
		<ol class="breadcrumb">
			<li class="active"><i class="fa fa-file-text"></i> Download File</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0">
			<div class="box box-success">

				<!-- /.box-header -->
				<div class="box-body">
					<div class="col-sm-12" style="padding: 0; overflow-x: scroll; overflow-y:hidden;">

						<table id="example1" class="table table-bordered table-striped" style="width: 1200px">
							<thead>
							<tr>
								<th style="width: 10px">#</th>
								<th width="14%"><span class="fa fa-gear"></span></th>
								<th>Nama File</th>
								<th>Keterangan</th>
								<th>Sifat</th>
								<th>Tanggal</th>
							</tr>
							</thead>
							<tbody>
							<?php $n=1; foreach ($file as $field) { ?>
								<tr>
									<td><?php echo $n++; ?></td>
									<td>
										<a href="<?php echo base_url(); ?>file-adm/unduh/?file=<?php echo $field->file; ?>" target="_blank">
											<button type="button" class="btn bg-purple-gradient btn-flat margin" title="Unduh" style="margin: 0; min-width: 40px">
												<span class="fa fa-download"></span>
											</button>
										</a>
									</td>
									<td><?php echo $field->nama; ?></td>
									<td><?php echo $field->keterangan; ?></td>
									<td><?php echo $field->sifat; ?></td>
									<td><?php echo datetime($field->tgl); ?></td>
								</tr>
							<?php } ?>
							</tbody>
							<tfoot>
							<tr>
								<th style="width: 10px">#</th>
								<th><span class="fa fa-gear"></span></th>
								<th>Nama File</th>
								<th>Keterangan</th>
								<th>Sifat</th>
								<th>Tanggal</th>
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

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url(); ?>assets/lte/plugins/jQuery/jquery-2.2.3.min.js"></script>

<!-- page script -->
<script>
	$(function () {
		$("#example1").DataTable();
	});
</script>
