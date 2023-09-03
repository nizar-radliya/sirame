<section class="section section-with-shape-divider page-header page-header-modern page-header-lg border-0 my-0 lazyload overlay overlay-show overlay-color-primary" data-bg-src="<?php echo base_url(); ?>assets/porto/img/demos/business-consulting-3/parallax/parallax-1.jpg" style="background-size: cover; background-position: center;">
	<div class="container pb-5 my-3">
		<div class="row mb-4">
			<div class="col-md-12 align-self-center p-static order-2 text-center">
				<h1 class="font-weight-bold text-10">Login Layanan</h1>
			</div>
			<div class="col-md-12 align-self-center order-1">
				<ul class="breadcrumb d-block text-center" style="color: #D3D3D3">
					<li><a href="<?php echo base_url(); ?>" style="color: #f1c40e">Beranda</a></li>
					<li class="active">Login</li>
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

			<div class="row justify-content-center">

				<div class="col-md-6 col-lg-5 mb-5 mb-lg-0">
					<h2 class="font-weight-bold text-5 mb-0">Login</h2>
					<?php if($this->session->flashdata('error')) { ?>
					<div class="alert alert-warning">
						<strong><i class="fas fa-ban"></i></strong> <?php echo $this->session->flashdata('error'); ?>
					</div>
					<?php } ?>
					<form action="<?php echo base_url(); ?>log/login" method="post">
						<div class="row">
							<div class="form-group col">
								<label class="form-label text-color-dark text-3">Email address <span class="text-color-danger">*</span></label>
								<input type="text" name="user" class="form-control form-control-lg text-4" required>
							</div>
						</div>
						<div class="row">
							<div class="form-group col">
								<label class="form-label text-color-dark text-3">Password <span class="text-color-danger">*</span></label>
								<input type="password" name="pass" class="form-control form-control-lg text-4" required>
							</div>
						</div>
						<div class="row justify-content-between">
							<div class="form-group col-md-auto">
								<?php echo $recaptcha_html;?>
								<?php echo form_error('g-recaptcha-response'); ?>
							</div>
						</div>
						<div class="row">
							<div class="form-group col">
								<button type="submit" class="btn btn-dark btn-modern w-100 text-uppercase rounded-0 font-weight-bold text-3 py-3" data-loading-text="Loading...">Login</button>
								<div class="divider">
									<span class="bg-light px-4 position-absolute left-50pct top-50pct transform3dxy-n50">or</span>
								</div>
								<a href="<?php echo base_url(); ?>daftar" class="btn btn-primary-scale-2 btn-modern w-100 text-transform-none rounded-0 font-weight-bold align-items-center d-inline-flex justify-content-center text-3 py-3" data-loading-text="Loading...">REGISTER</a>
							</div>
						</div>
					</form>
				</div>
				<!--<div class="col-md-6 col-lg-5" style="text-align: justify">
					<h2 class="font-weight-bold text-5 mb-0">Layanan Masyarakat</h2>
					<blockquote>
						<a href="<?php /*echo base_url(); */?>layanan" class="custom-link-hover-effects text-decoration-none" data-cursor-effect-hover="plus" style="color: #222529">
						<span class="font-weight-bold">Surat Kerengan Rencana Ruang</span><br> Melalui layanan ini masyarakat dapat melakukan permohonan Surat Keterangan Rencana Ruang di PUPR Kabupaten Subang secara online.<br><span class="custom-view-more d-inline-flex font-weight-medium text-color-primary">
							Petunjuk Permohonan SKRR
							<img width="27" height="27" src="<?php /*echo base_url(); */?>assets/porto/img/demos/business-consulting-3/icons/arrow-right.svg" alt="" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-primary ms-2'}" style="width: 27px;" />
						</span>
						</a>
					</blockquote>
					<blockquote>
						<a href="https://oss.go.id/informasi/persyaratan-dasar?tab=kesesuaian-ruang&page=1" target="_blank" class="custom-link-hover-effects text-decoration-none" data-cursor-effect-hover="plus" style="color: #222529">
						<span class="font-weight-bold">Rencana Tapak (Site Plan)</span><br> Melalui layanan ini masyarakat dapat melakukan permohonan Rencana Tapak (Site Plan) di PUPR Kabupaten Subang secara online.<br><span class="custom-view-more d-inline-flex font-weight-medium text-color-primary">
							Petunjuk Permohonan Rencana Tapak
							<img width="27" height="27" src="<?php /*echo base_url(); */?>assets/porto/img/demos/business-consulting-3/icons/arrow-right.svg" alt="" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-primary ms-2'}" style="width: 27px;" />
						</span>
						</a>
					</blockquote>
				</div>-->
			</div>

		</div>
	</div>
</div>
