<section class="section section-with-shape-divider page-header page-header-modern page-header-lg border-0 my-0 lazyload overlay overlay-show overlay-color-primary" data-bg-src="<?php echo base_url(); ?>assets/porto/img/demos/business-consulting-3/parallax/parallax-1.jpg" style="background-size: cover; background-position: center;">
	<div class="container pb-5 my-3">
		<div class="row mb-4">
			<div class="col-md-12 align-self-center p-static order-2 text-center">
				<h1 class="font-weight-bold text-10">Download</h1>
			</div>
			<div class="col-md-12 align-self-center order-1">
				<ul class="breadcrumb d-block text-center" style="color: #D3D3D3">
					<li><a href="<?php echo base_url(); ?>" style="color: #f1c40e">Beranda</a></li>
					<li class="active">Download</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="shape-divider shape-divider-bottom shape-divider-reverse-x" style="height: 123px;">
		<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1920 123" preserveAspectRatio="xMinYMin">
			<polygon fill="#f1c40e" points="0,90 221,60 563,88 931,35 1408,93 1920,41 1920,-1 0,-1 "/>
			<polygon fill="#FFFFFF" points="0,75 219,44 563,72 930,19 1408,77 1920,25 1920,-1 0,-1 "/>
		</svg>
	</div>
</section>

<div class="container pt-3 mt-4">
	<div class="row">
		<div class="col" style="margin-bottom: 50px">
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
</div>
