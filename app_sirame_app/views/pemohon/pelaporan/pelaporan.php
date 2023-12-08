<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pelaporan PKKPR
			<small><?= webname() ?></small>
        </h1>
        <ol class="breadcrumb">
			<li class="active"><i class="fa fa-calendar-check-o"></i> Pelaporan PKKPR</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0">
            <div class="box box-success">
				<div class="box-header with-border">
					<span style="font-size: 12px; font-style: italic">*Data disini tidak dapat diubah atau dihapus apabila sudah berstatus "PELAPORAN DITERIMA".</span>
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
                        <table id="example1" class="table table-bordered table-striped" style="width: 2000px">
                            <thead>
                            <tr>
							<tr>
								<th style="width: 10px">#</th>
								<th><span class="fa fa-gear"></span></th>
								<th>Nomor</th>
								<th>Status</th>
								<th>Terbit</th>
								<th>Pelaku Usaha</th>
								<th>Telepon</th>
								<th>KBLI</th>
								<th>Pemanfaatan Ruang</th>
								<th>Luas Dimohon</th>
								<th>Luas Disetujui</th>
								<th>Kecamatan</th>
								<th>Kelurahan</th>
							</tr>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $n=1; foreach ($kkpr as $field) { ?>
                                <tr>
                                    <td><?php echo $n++; ?></td>
									<td style="width: auto">
											<a href="<?php echo base_url(); ?>pelaporan/detil/<?= $field->nomor; ?>">
												<button type="button" class="btn bg-green-gradient btn-flat margin" title="Detil Data" style="margin: 0; min-width: 40px">
													<span class="fa fa-binoculars"></span>
												</button>
											</a>
									</td>
									<td><?php echo $field->nomor; ?></td>
									<td class="text-bold"><?php echo $field->statuskkpr; ?></td>
									<td><?php echo onlydate($field->tglterbit); ?></td>
									<td><?php echo $field->namapelaku; ?></td>
									<td><?php echo $field->tlppelaku; ?></td>
									<td><?php echo $field->judulkbli; ?></td>
									<td><?php echo $field->pr; ?></td>
									<td><?php echo $field->luasdimohon; ?></td>
									<td><?php echo $field->luasdisetujui; ?></td>
									<td><?php echo $field->nama_kec; ?></td>
									<td><?php echo $field->nama_kel; ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
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
