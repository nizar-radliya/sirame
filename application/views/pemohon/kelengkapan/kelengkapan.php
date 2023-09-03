<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Kelengkapan PKKPR
			<small><?= webname() ?></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>kkpr"><i class="fa fa-file-text-o"></i>PKKPR</li></a></li>
			<li class="active"><i class="fa fa-check-square-o"></i> Kelengkapan PKKPR</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="box box-success" style="margin-bottom: 0">
					<div class="box-header with-border">

						<select class="form-control select2" name="" id="iddi" style="width: auto" onchange="javascript:location.href = this.value;">
							<option disabled>Nomor PKKPR</option>
							<?php foreach ($noreg as $field) { ?>
								<?php if ($field->nomor == $kkpr[0]->nomor) { ?>
									<option value="<?php echo base_url(); ?>kelengkapan/index/<?= $field->nomor; ?>" selected><?= $field->nomor; ?></option>
								<?php } else { ?>
									<option value="<?php echo base_url(); ?>kelengkapan/index/<?= $field->nomor; ?>"><?= $field->nomor; ?></option>
								<?php } } ?>
						</select>
					</div>
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

							<table class="table table-bordered table-striped" style="width: 100%; margin-bottom: 5px">
								<tr>
									<th colspan="4" style="text-align: center; background-color: #0D340D; color: #ffffff;"><h4 class="text-bold">Data Kelengkapan</h4></th>
								</tr>
							</table>

							<table id="example1" class="table table-bordered table-striped">
								<thead>
								<tr>
									<th style="width: 10px">#</th>
									<th><span class="fa fa-gear"></span></th>
									<th>Jenis Kelengkapan</th>
									<th>Status</th>
									<th>Tgl Unggah</th>
									<th>Tgl Verifikasi</th>
								</tr>
								</thead>
								<tbody>
								<?php $n=1; foreach ($jeniskelengkapan as $field) {
									$kkpr_kelengkapan = readkelengkapan($kkpr[0]->nomor,$field->idjenis);
									?>
									<tr>
										<td><?php echo $n++; ?></td>
										<td style="width: auto">
											<?php if (!empty($kkpr_kelengkapan)) { ?>
											<a href="<?php echo base_url(); ?>kelengkapan/unduh/?file=<?= $kkpr_kelengkapan[0]->filekelengkapan ?>" target="_blank">
												<button type="button" class="btn bg-purple-gradient btn-flat margin" title="Unduh" style="margin: 0; min-width: 40px">
													<span class="fa fa-download"></span>
												</button>
											</a>
											<?php if ($kkpr_kelengkapan[0]->statuskelengkapan != 'KELENGKAPAN DITERIMA') { ?>
												<a href="#" class="kelengkapan-del" data-id="<?= $kkpr_kelengkapan[0]->nomor; ?>" data-id2="<?= $kkpr_kelengkapan[0]->idkelengkapan; ?>">
													<button type="button" class="btn bg-red-gradient btn-flat margin" title="Hapus" style="margin: 0; min-width: 40px">
														<span class="fa fa-remove"></span>
													</button>
												</a>
											<?php } ?>
											<a href="#" class="kelengkapan-cek" data-id="<?= $kkpr_kelengkapan[0]->nomor; ?>" data-id2="<?= $kkpr_kelengkapan[0]->idkelengkapan; ?>">
												<button type="button" class="btn bg-gray-active btn-flat margin" title="Verifikasi" style="margin: 0; min-width: 40px">
													<span class="fa fa-file-text-o"></span>
												</button>
											</a>
											<?php } else { ?>
													<a href="#" class="kelengkapan-add" data-id="<?= $kkpr[0]->nomor; ?>" data-id2="<?= $field->idjenis; ?>">
														<button type="button" class="btn bg-blue-gradient btn-flat margin" title="Unggah" style="margin: 0; min-width: 40px">
															<span class="fa fa-upload"></span>
														</button>
													</a>
											<?php } ?>
										</td>
										<td><?php echo $field->jeniskelengkapan; ?></td>
										<?php if (!empty($kkpr_kelengkapan)) { ?>
										<th>
											<?php if ($kkpr_kelengkapan[0]->statuskelengkapan == 'MENUNGGU VERIFIKASI') { ?>
												<button type="button" style="width: 100%" class="btn bg-yellow btn-flat"><?= $kkpr_kelengkapan[0]->statuskelengkapan; ?></button>
											<?php } else if ($kkpr_kelengkapan[0]->statuskelengkapan == 'KELENGKAPAN DITOLAK') { ?>
												<button type="button" style="width: 100%" class="btn bg-maroon btn-flat"><?= $kkpr_kelengkapan[0]->statuskelengkapan; ?></button>
											<?php } else if ($kkpr_kelengkapan[0]->statuskelengkapan == 'KELENGKAPAN DITERIMA') { ?>
												<button type="button" style="width: 100%" class="btn bg-green btn-flat"><?= $kkpr_kelengkapan[0]->statuskelengkapan; ?></button>
											<?php } ?>
										</th>
										<td><?php echo onlydate($kkpr_kelengkapan[0]->tglupload); ?></td>
										<td><?php echo onlydate($kkpr_kelengkapan[0]->tglverifikasi); ?></td>
										<?php } else { ?>
												<td>-</td>
												<td>-</td>
												<td>-</td>
										<?php } ?>
									</tr>
								<?php } ?>
								</tbody>
							</table>

							<table class="table table-bordered" style="text-align: justify; margin-bottom: 0">
								<tr>
									<th colspan="4" style="text-align: center; background-color: #0D340D; color: #ffffff;"><h4 class="text-bold">Data PKKPR</h4></th>
								</tr>
								<tr>
									<td style="width: 25%"><label>Nomor PKKPR</label></td>
									<td class="text-bold" style="width: 25%"><?= $kkpr[0]->nomor ?></td>
									<td style="width: 25%"><label>Tanggal Terbit</label></td>
									<td style="width: 25%"><?= onlydate($kkpr[0]->tglterbit) ?></td>
								</tr>
								<tr>
									<td><label>Nama Pelaku Usaha</label></td>
									<td><?= $kkpr[0]->namapelaku ?></td>
									<td><label>NPWP</label></td>
									<td><?= $kkpr[0]->npwp ?></td>
								</tr>
								<tr>
									<td><label>Alamat Kantor</label></td>
									<td colspan="3"><?= $kkpr[0]->alamatpelaku ?></td>
								</tr>
								<tr>
									<td><label>Telepon Kantor</label></td>
									<td><?= $kkpr[0]->tlppelaku ?></td>
									<td><label>Email Kantor</label></td>
									<td><?= $kkpr[0]->emailpelaku ?></td>
								</tr>
								<tr>
									<td><label>Status Penanaman Modal</label></td>
									<td><?= $kkpr[0]->spm ?></td>
									<td><label>Skala Usaha</label></td>
									<td><?= $kkpr[0]->skalausaha ?></td>
								</tr>
								<tr>
									<td><label>Luas Tanah yang Dimohon</label></td>
									<td colspan="3"><?= number_format($kkpr[0]->luasdimohon, 2, '.', ',') ?></td>
								</tr>
								<tr>
									<td><label>Kecamatan Lokasi</label></td>
									<td><?= read($kkpr[0]->id_kec,'kecamatan','id_kec')[0]->nama_kec; ?></td>
									<td><label>Kelurahan Lokasi</label></td>
									<td><?= read($kkpr[0]->id_kel,'kelurahan','id_kel')[0]->nama; ?></td>
								</tr>
								<tr>
									<td><label>Luas Tanah yang disetujui</label></td>
									<td><?= number_format($kkpr[0]->luasdisetujui, 2, '.', ',') ?></td>
									<td><label>Peruntukan Pemanfaatan Ruang</label></td>
									<td><?= $kkpr[0]->pr ?></td>
								</tr>
								<tr>
									<td><label>Kode KBLI</label></td>
									<td><?= $kkpr[0]->kodekbli ?></td>
									<td><label>Judul KBLI</label></td>
									<td><?= $kkpr[0]->judulkbli ?></td>
								</tr>
								<tr>
									<td><label>Koefisien Dasar Bangunan maksimum</label></td>
									<td><?= $kkpr[0]->kdbmak ?></td>
									<td><label>Koefisien Lantai Bangunan maksimum</label></td>
									<td><?= $kkpr[0]->klbmak ?></td>
								</tr>
								<tr>
									<td><label>Indikasi Program Pemanfaatan Ruang</label></td>
									<td><?= $kkpr[0]->ippr ?></td>
									<td><label>Persyaratan Pelaksanaan Kegiatan Pemanfaatan Ruang</label></td>
									<td><?= $kkpr[0]->ppkpr ?></td>
								</tr>
								<tr>
									<td><label>Garis Sempadan Bangunan minimum</label></td>
									<td><?= $kkpr[0]->gsbmin ?></td>
									<td><label>Jarak Bebas Bangunan minimum</label></td>
									<td><?= $kkpr[0]->jbbmin ?></td>
								</tr>
								<tr>
									<td><label>Koefisien Dasar Hijau minimum</label></td>
									<td><?= $kkpr[0]->kdhmin ?></td>
									<td><label>Koefisien Tapak Basement minimum</label></td>
									<td><?= $kkpr[0]->ktbmin ?></td>
								</tr>
								<tr>
									<td><label>Jaringan Utilitas Kota</label></td>
									<td><?= $kkpr[0]->juk ?></td>
									<td><label>Status Input Data</label></td>
									<td class="text-bold"><?= $kkpr[0]->statuskkpr ?></td>
								</tr>
								<tr>
									<th colspan="4" style="text-align: center; background-color: #0D340D; color: #ffffff"><h4 class="text-bold">Data Pengguna</h4></th>
								</tr>
								<tr>
									<td><label>Nomor KTP</label></td>
									<td><?= $kkpr[0]->noktp ?></td>
									<td><label>Nama Lengkap</label></td>
									<td><?= $kkpr[0]->namapemohon ?></td>
								</tr>
								<tr>
									<td><label>Email</label></td>
									<td><?= $kkpr[0]->email ?></td>
									<td><label>Nomor Handphone</label></td>
									<td><?= $kkpr[0]->hp ?></td>
								</tr>
								<tr>
									<td><label>Pekerjaan</label></td>
									<td><?= $kkpr[0]->pekerjaan ?></td>
									<td><label>Kewarganegaraan</label></td>
									<td><?= $kkpr[0]->wn ?></td>
								</tr>
								<tr>
									<td><label>Provinsi</label></td>
									<td><?= read($kkpr[0]->id_prov,'provinsi','id_prov')[0]->nama_prov; ?></td>
									<td><label>Kabupaten/Kota</label></td>
									<td><?= read($kkpr[0]->kotapemohon,'kota','id_kota')[0]->nama_kota; ?></td>
								</tr>
								<tr>
									<td><label>Kecamatan</label></td>
									<td><?= read($kkpr[0]->kecpemohon,'kecamatan','id_kec')[0]->nama_kec; ?></td>
									<td><label>Kode Pos</label></td>
									<td><?= $kkpr[0]->kodepos ?></td>
								</tr>
								<tr>
									<td><label>Alamat</label></td>
									<td colspan="3"><?= $kkpr[0]->alamat ?></td>
								</tr>
							</table>
						</div>
					</div>
					<!-- /.box-body -->
				</div>
	</section><div style="clear:both;"></div>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div id="modalAdd" class="modal fade modal-primary" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="icon fa fa-file-o"></i> Unggah Kelengkapan</h4>
			</div>
			<div class="modal-body">
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div id="modalDel" class="modal fade modal-danger" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="icon fa fa-warning"></i> Hapus Kelengkapan</h4>
			</div>
			<div class="modal-footer">
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div id="modalCek" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="icon fa fa-file-o"></i> Catatan</h4>
			</div>
			<div class="modal-body">
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div id="myModalSetujui" class="modal fade modal-success" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="icon fa fa-calendar-check-o"></i> Masuk Tahap Survei</h4>
			</div>
			<div class="modal-body">
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
		$(document).on('click','.kelengkapan-add',function(e){
			e.preventDefault();
			$("#modalAdd").modal('show');
			$.get('<?php echo base_url(); ?>kelengkapan/add',
					{id:$(this).attr('data-id'),id2:$(this).attr('data-id2'),data:csfrData},
					function(html){
						$(".modal-body").html(html);
					}
			);
		});
	});
</script>

<script>
	$(function(){
		var csfrData = {};
		csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
		$.ajaxSetup({
			data: csfrData
		});
		$(document).on('click','.kelengkapan-del',function(e){
			e.preventDefault();
			$("#modalDel").modal('show');
			$.get('<?php echo base_url(); ?>kelengkapan/kelengkapan-del',
					{id:$(this).attr('data-id'),id2:$(this).attr('data-id2'),data:csfrData},
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
		csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
		$.ajaxSetup({
			data: csfrData
		});
		$(document).on('click','.kelengkapan-cek',function(e){
			e.preventDefault();
			$("#modalCek").modal('show');
			$.get('<?php echo base_url(); ?>kelengkapan/kelengkapan-cek',
					{id:$(this).attr('data-id'),id2:$(this).attr('data-id2'),data:csfrData},
					function(html){
						$(".modal-body").html(html);
					}
			);
		});
	});
</script>

<script>
	$(function(){
		var csfrData = {};
		csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
		$.ajaxSetup({
			data: csfrData
		});
		$(document).on('click','.setujui-semua',function(e){
			e.preventDefault();
			$("#myModalSetujui").modal('show');
			$.get('<?php echo base_url(); ?>kelengkapan/setujui-semua',
				{id:$(this).attr('data-id'),data:csfrData},
				function(html){
					$(".modal-body").html(html);
				}
			);
		});
	});
</script>
