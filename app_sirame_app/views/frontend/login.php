<div class="container">
	<div class="row pt-5 mt-3 pb-3">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<?php if($this->session->flashdata('error')) { ?>
					<div class="alert alert-warning">
						<strong><i class="fas fa-ban"></i></strong> <?php echo $this->session->flashdata('error'); ?>
					</div>
				<?php } ?>
				<form action="<?php echo base_url(); ?>log/login" method="post">
					<div class="row">
						<div class="form-group col">
							<label class="form-label text-color-dark text-3">Email address <span class="text-color-danger">*</span></label>
							<input type="text" name="user" class="form-control form-control-lg text-4" autocomplete="off" required>
						</div>
					</div>
					<div class="row">
						<div class="form-group col">
							<label class="form-label text-color-dark text-3">Password <span class="text-color-danger">*</span></label>
							<input type="password" name="pass" class="form-control form-control-lg text-4" autocomplete="off" required>
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
							<button type="submit" class="btn btn-success btn-modern w-100 text-uppercase rounded-0 font-weight-bold text-3 py-3" data-loading-text="Loading...">MASUK</button>
							<div class="divider">
								<span class="bg-light px-4 position-absolute left-50pct top-50pct transform3dxy-n50">or</span>
							</div>
							<a href="<?php echo base_url(); ?>daftar" class="btn btn-warning btn-modern w-100 text-transform-none rounded-0 font-weight-bold align-items-center d-inline-flex justify-content-center text-3 py-3" data-loading-text="Loading...">DAFTAR</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
