<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            PKKPR
			<small><?= webname() ?></small>
        </h1>
        <ol class="breadcrumb">
			<li class="active"><i class="fa fa-file-text-o"></i> PKKPR</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0">
            <div class="box box-success">
				<div class="box-header with-border">
					<span style="font-size: 12px; font-style: italic">*Data pelaporan PKKPR tidak dapat diubah atau dihapus apabila sudah berstatus "KELENGKAPAN DITERIMA".</span>
						<a href="<?php echo base_url(); ?>kkpr/form-add">
							<button type="button" class="btn bg-yellow-gradient btn-flat margin pull-right" style="margin-top: 0; margin-right: 0; margin-bottom: 0">
								<span class="fa  fa-plus" style="margin-right: 5px"></span>
								Tambah
							</button>
						</a>
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
							</thead>
							<tbody>
							<?php $n=1; foreach ($kkpr as $field) { ?>
								<tr>
									<td><?php echo $n++; ?></td>
									<td style="width: auto">
										<a href="<?php echo base_url(); ?>kkpr/detil/<?= $field->nomor; ?>">
											<button type="button" class="btn bg-green-gradient btn-flat margin" title="Detil Data" style="margin: 0; min-width: 40px">
												<span class="fa fa-file-text-o"></span>
											</button>
										</a>
										<?php if ($field->statuskkpr != 'PKKPR VALID') { ?>
											<a href="<?php echo base_url(); ?>kkpr/form-edit/<?= $field->nomor; ?>">
												<button type="button" class="btn bg-blue-gradient btn-flat margin" title="Ubah Data" style="margin: 0; min-width: 40px">
													<span class="fa fa-edit"></span>
												</button>
											</a>
										<?php } ?>
										<?php if ($field->statuskkpr != 'PKKPR VALID') { ?>
											<a href="#" class="edit-record" data-id="<?= $field->nomor; ?>">
												<button type="button" class="btn bg-red-gradient btn-flat margin" title="Hapus Data" style="margin: 0; min-width: 40px">
													<span class="fa fa-remove"></span>
												</button>
											</a>
										<?php } ?>
											<a href="<?php echo base_url(); ?>kelengkapan/index/<?= $field->nomor; ?>">
												<button type="button" class="btn bg-purple btn-flat margin" title="Persyaratan" style="margin: 0; min-width: 40px">
													<span class="fa fa-check-square-o"></span>
												</button>
											</a>
										<?php if ($field->statuskkpr == 'PKKPR VALID') { ?>
											<a href="<?php echo base_url(); ?>kelengkapan/tanda-terima/<?= $field->nomor; ?>" target="_blank">
												<button type="button" class="btn bg-black btn-flat margin" title="Download Bukti Verifikasi PKKPR" style="margin: 0; min-width: 40px">
													<span class="fa fa-print"></span>
												</button>
											</a>
										<?php } ?>
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

<div id="myModal" class="modal fade modal-danger" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="icon fa fa-warning"></i> Konfirmasi</h4>
            </div>
            <div class="modal-body">
				<p>Yakin akan menghapus data ini? Data pelaporan PKKPR tidak dapat dihapus apabila sudah berhasil verifikasi kelengkapan.</p>
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
			$.get('<?php echo base_url(); ?>kkpr/form_del',
					{id:$(this).attr('data-id'),data:csfrData},
					function(html){
						$(".modal-footer").html(html);
					}
			);
		});
	});
</script>
