<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			PKKPR
			<small><?= webname() ?></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>kkpr"><i class="fa fa-file-text-o"></i> PKKPR</a></li>
			<li class="active"><i class="fa fa-plus"></i> Tambah PKKPR</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="col-md-12" style="padding: 0">
			<div class="box box-warning">
				<div class="box-body">
					<div class="col-sm-12" style="padding: 0">
						<form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>kkpr/add">
							<?php if ($this->session->flashdata('error')) { ?>
								<div class="alert alert-warning alert-dismissible">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
										&times;
									</button>
									<h4><i class="icon fa fa-ban"></i>Peringatan!</h4>
									<?php echo $this->session->flashdata('error'); ?>
								</div>
							<?php } ?>
							<table class="table table-bordered" style="margin-bottom: 0">
								<tr>
									<td colspan="2">
										<div class="callout callout-info" style="margin-bottom: 0">
											<h4>Data Pelaku Usaha</h4>
										</div>
									</td>
								</tr>
								<tr>
									<td width="50%">
										<label>Nama Pelaku Usaha</label>
										<input type="text" name="namapelaku" class="form-control" required>
										<span id="span-noktp" class="text-red"></span>
									</td>
									<td width="50%">
										<label>NPWP</label>
										<input type="text" class="form-control" name="npwp" required>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<label>Alamat Kantor</label>
										<input type="text" class="form-control" name="alamatpelaku" required>
									</td>
								</tr>
								<tr>
									<td>
										<label>Telepon Kantor</label>
										<input type="text" class="form-control" name="tlppelaku" required>
									</td>
									<td>
										<label>Email Kantor</label>
										<input type="email" class="form-control" name="emailpelaku" required>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<label>Status Penanaman Modal</label>
										<input type="text" class="form-control" name="spm" required>
									</td>
								</tr>
								<tr>
									<td>
										<label>Skala Usaha</label>
										<input type="text" class="form-control" name="skalausaha" required>
									</td>
									<td>
										<label>Luas Tanah yang Dimohon</label>
										<input type="number" step="0.01" class="form-control" name="luasdimohon" required>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<label>Alamat Lokasi Usaha</label>
										<input type="text" class="form-control" name="alamatusaha" required>
									</td>
								</tr>
								<tr>
									<td>
										<label>Kecamatan Lokasi Usaha</label>
										<select class="form-control select2" name="id_kec" id="kec" required>
											<option disabled selected value="">Pilih Kecamatan</option>
											<?php foreach ($kecamatan as $field) { ?>
												<option value="<?= $field->id_kec ?>"><?= $field->nama_kec ?></option>
											<?php } ?>
										</select>
									</td>
									<td>
										<label>Keluarahan Lokasi Usaha</label>
										<select class="form-control select2" name="id_kel" id="kel" required>
											<option disabled selected value="">Pilih Kecamatan Terlebih Dahulu</option>
										</select>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<div class="callout callout-info" style="margin-bottom: 0">
											<h4>Data Persetujuan PKKPR</h4>
										</div>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<label>Nomor PKKPR</label>
										<input type="text" class="form-control" name="nomor" required>
									</td>
								</tr>
								<tr>
									<td>
										<label>Luas Tanah yang disetujui</label>
										<input type="number" step="0.01" class="form-control" name="luasdisetujui" required>
									</td>
									<td>
										<label>Peruntukan Pemanfaatan Ruang</label>
										<input type="text" class="form-control" name="pr" required>
									</td>
								</tr>
								<tr>
									<td>
										<label>Kode KBLI</label>
										<input type="text" class="form-control" name="kodekbli" required>
									</td>
									<td>
										<label>Judul KBLI</label>
										<input type="text" class="form-control" name="judulkbli" required>
									</td>
								</tr>
								<tr>
									<td>
										<label>Koefisien Dasar Bangunan maksimum</label>
										<input type="number" step="0.01" class="form-control" name="kdbmak" required>
									</td>
									<td>
										<label>Koefisien Lantai Bangunan maksimum</label>
										<input type="number" step="0.01" class="form-control" name="klbmak" required>
									</td>
								</tr>
								<tr>
									<td>
										<label>Indikasi Program Pemanfaatan Ruang</label>
										<input type="text" class="form-control" name="ippr" required>
									</td>
									<td>
										<label>Persyaratan Pelaksanaan Kegiatan Pemanfaatan Ruang</label>
										<input type="text" class="form-control" name="ppkpr" required>
									</td>
								</tr>
								<tr>
									<td>
										<label>Garis Sempadan Bangunan minimum</label>
										<input type="number" step="0.01" class="form-control" name="gsbmin">
									</td>
									<td>
										<label>Jarak Bebas Bangunan minimum</label>
										<input type="number" step="0.01" class="form-control" name="jbbmin">
									</td>
								</tr>
								<tr>
									<td>
										<label>Koefisien Dasar Hijau minimum</label>
										<input type="number" step="0.01" class="form-control" name="kdhmin">
									</td>
									<td>
										<label>Koefisien Tapak Basement minimum</label>
										<input type="number" step="0.01" class="form-control" name="ktbmin">
									</td>
								</tr>
								<tr>
									<td>
										<label>Jaringan Utilitas Kota</label>
										<input type="number" step="0.01" class="form-control" name="juk">
									</td>
									<td>
										<label>Tanggal Diterbitkan</label>
										<input type="date" class="form-control" name="tglterbit" required>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<button type="submit" class="btn btn-warning" id="simpan">
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

<script>
	$(document).ready(function () {
		$("#kec").change(function () {
			var url = "<?php echo site_url('kkpr/add_ajax_kel');?>/" + $(this).val();
			$('#kel').load(url);
			return false;
		})
	});
</script>
