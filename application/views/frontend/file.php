<div class="custom-page-header border-bottom-light">
	<section class="page-header page-header-modern page-header-lg overlay overlay-light overlay-show overlay-op-9 m-0" style="background-image: url(<?php echo base_url(); ?>assets/porto/img/sirame/bg_page.png); background-size: cover; background-position: center;">
		<div class="container">
			<div class="row">
				<div class="col">
					<ul class="breadcrumb text-4 font-weight-semi-bold mb-2">
						<li><a href="<?php echo base_url(); ?>main" class="text-color-primary text-decoration-none text-capitalize">Beranda</a></li>
						<li class="text-color-primary active text-capitalize">Download</li>
					</ul>
					<h1 class="text-color-tertiary font-weight-semi-bold text-9">Download</h1>
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
				<th width="5%"><span class="fa fa-download"></span></th>
				<th>Nama File</th>
				<th>Tanggal</th>
				<th style="display: none">Keterangan</th>
			</tr>
			</thead>
			<tbody>
			<?php $n=1; foreach ($file as $field) { ?>
				<tr>
					<td><?php echo $n++; ?></td>
					<td>
						<a href="<?php echo base_url(); ?>file/unduh/?file=<?php echo $field->file; ?>" target="_blank">
							<button type="button" class="btn btn-primary text-1 btn-outline custom-btn-style-1 font-weight-semibold" title="Unduh" style="margin: 0; min-width: 40px">
								<span class="fa fa-download"></span>
							</button>
						</a>
					</td>
					<td><?php echo $field->nama; ?></td>
					<td><?php echo datetime($field->tgl); ?></td>
					<td style="display: none"><?= $field->keterangan; ?></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>
