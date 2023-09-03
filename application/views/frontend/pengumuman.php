<div class="custom-page-header border-bottom-light">
	<section class="page-header page-header-modern page-header-lg overlay overlay-light overlay-show overlay-op-9 m-0" style="background-image: url(<?php echo base_url(); ?>assets/porto/img/sirame/bg_page.png); background-size: cover; background-position: center;">
		<div class="container">
			<div class="row">
				<div class="col">
					<ul class="breadcrumb text-4 font-weight-semi-bold mb-2">
						<li><a href="<?php echo base_url(); ?>main" class="text-color-primary text-decoration-none text-capitalize">Beranda</a></li>
						<li class="text-color-primary active text-capitalize">Pengumuman</li>
					</ul>
					<h1 class="text-color-tertiary font-weight-semi-bold text-9">Pengumuman</h1>
				</div>
			</div>
		</div>
	</section>
</div>

<div class="container">
	<div class="row pt-5 mt-3 pb-3">
		<table class="table table-bordered table-striped mb-0" id="datatable-details">
			<thead>
			<tr>
				<th style="width: 10px">#</th>
				<th>Pengumuman</th>
				<th>Judul</th>
				<th>Tanggal</th>
				<th style="display: none"></th>
			</tr>
			</thead>
			<tbody>
			<?php $n=1; foreach ($pengumuman as $field) { ?>
				<tr>
					<td><?php echo $n++; ?></td>
					<td>
						<button type="button" class="btn btn-primary text-1 btn-outline custom-btn-style-1 font-weight-semibold" title="Selengkapnya" style="margin: 0; min-width: 40px" data-bs-toggle="modal" data-bs-target="#p<?php echo $field->idPengumuman; ?>">
							<span class="fa fa-text-width"></span>
						</button>
						<?php if ($field->berkas != '') { ?>
							<a href="<?php echo base_url(); ?>pengumuman/unduh/?file=<?php echo $field->berkas; ?>" target="_blank">
								<button type="button" class="btn btn-primary text-1 btn-outline custom-btn-style-1 font-weight-semibold" title="Unduh" style="margin: 0; min-width: 40px">
									<span class="fa fa-download"></span>
								</button>
							</a>
						<?php } ?>

						<div class="modal fade" id="p<?php echo $field->idPengumuman; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="largeModalLabel"><?php echo $field->judul; ?></h4>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
									</div>
									<div class="modal-body">
										<?php if (isset($field->berkas)) { ?>
											<a href="<?php echo base_url(); ?>pengumuman/unduh/?file=<?php echo $field->berkas; ?>" target="_blank">
												<button type="button" class="btn bg-blue-gradient btn-flat margin" title="Download Berkas" style="margin: 0; min-width: 40px">
													<span class="fa fa-download"></span>
												</button>
											</a>
										<?php } ?>
										<span class="text-aqua"><?php echo datetime($field->waktu); ?></span>
										<br>
										<br>
										<?php echo $field->isi; ?>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
					</td>
					<td><?php echo $field->judul; ?></td>
					<td><?php echo datetime($field->waktu); ?></td>
					<td style="display: none"><?= $field->isi; ?></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>
