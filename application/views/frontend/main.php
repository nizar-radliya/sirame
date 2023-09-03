<!DOCTYPE html>
<html>
<head>

	<!-- Basic -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title><?php if(isset($title)) echo $title; ?></title>

	<meta name="keywords" content="Nizar" />
	<meta name="description" content="Nizar">
	<meta name="author" content="Nizar">

	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/porto/img/sirame/logo.png" type="image/x-icon" />
	<link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/porto/img/sirame/logo.png">

	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

	<!-- Web Fonts  -->
	<link id="googleFonts" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800%7CShadows+Into+Light&display=swap" rel="stylesheet" type="text/css">

	<!-- Vendor CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/porto/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/porto/vendor/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/porto/vendor/animate/animate.compat.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/porto/vendor/simple-line-icons/css/simple-line-icons.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/porto/vendor/owl.carousel/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/porto/vendor/owl.carousel/assets/owl.theme.default.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/porto/vendor/magnific-popup/magnific-popup.min.css">

	<!-- Theme CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/porto/css/theme.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/porto/css/theme-elements.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/porto/css/theme-blog.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/porto/css/theme-shop.css">

	<!-- Demo CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/porto/css/demos/demo-transportation-logistic.css">

	<!-- Skin CSS -->
	<link id="skinCSS" rel="stylesheet" href="<?php echo base_url(); ?>assets/porto/css/skins/skin-transportation-logistic.css">

	<!-- Theme Custom CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/porto/css/custom.css">

	<!-- Head Libs -->
	<script src="<?php echo base_url(); ?>assets/porto/vendor/modernizr/modernizr.min.js"></script>

	<!-- Porto Admin -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/porto-adm/vendor/select2/css/select2.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/porto-adm/vendor/select2-bootstrap-theme/select2-bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/porto-adm/vendor/datatables/media/css/dataTables.bootstrap5.css" />

	<!-- Map -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.Basemaps/L.Control.Basemaps.css"/>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/map/leaflet/leaflet-sidebar/css/leaflet-sidebar.css"/>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/map/leaflet/leaflet-public.css"/>

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/map/leaflet/leaflet-ori.css" /> <!-- memanggil css di folder leaflet -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/map/leaflet/leaflet.groupedlayercontrol/src/leaflet.groupedlayercontrol.css"/>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/map/css/style.css" /> <!-- memanggil css style -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.defaultextent-master/dist/leaflet.defaultextent.css" />
	<script src="<?php echo base_url(); ?>assets/map/leaflet/leaflet.js"></script> <!-- memanggil leaflet.js di folder leaflet -->
	<script src="<?php echo base_url(); ?>assets/map/js/jquery-3.4.1.min.js"></script> <!-- memanggil jquery di folder js -->
	<script src="<?php echo base_url(); ?>assets/map/leaflet/leaflet-ajax/dist/leaflet.ajax.js"></script>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/leaflet.groupedlayercontrol/src/leaflet.groupedlayercontrol.js"></script>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/leaflet-providers-master/leaflet-providers.js"></script> <!-- memanggil leaflet-providers.js-->
	<script src="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.defaultextent-master/dist/leaflet.defaultextent.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/2.4.1/lodash.min.js"></script>
	<!-- Map . end -->

	<script src="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.Basemaps/L.Control.Basemaps.js"></script>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/leaflet-sidebar/js/leaflet-sidebar.js"></script>

	<script src="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.draw/src/Leaflet.draw.js"></script>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.draw/src/Leaflet.Draw.Event.js"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.draw/src/leaflet.draw.css"/>

	<script src="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.draw/src/Toolbar.js"></script>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.draw/src/Tooltip.js"></script>

	<script src="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.draw/src/ext/GeometryUtil.js"></script>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.draw/src/ext/LatLngUtil.js"></script>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.draw/src/ext/LineUtil.Intersect.js"></script>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.draw/src/ext/Polygon.Intersect.js"></script>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.draw/src/ext/Polyline.Intersect.js"></script>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.draw/src/ext/TouchEvents.js"></script>

	<script src="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.draw/src/draw/DrawToolbar.js"></script>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.draw/src/draw/handler/Draw.Feature.js"></script>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.draw/src/draw/handler/Draw.SimpleShape.js"></script>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.draw/src/draw/handler/Draw.Polyline.js"></script>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.draw/src/draw/handler/Draw.Marker.js"></script>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.draw/src/draw/handler/Draw.Circle.js"></script>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.draw/src/draw/handler/Draw.CircleMarker.js"></script>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.draw/src/draw/handler/Draw.Polygon.js"></script>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.draw/src/draw/handler/Draw.Rectangle.js"></script>


	<script src="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.draw/src/edit/EditToolbar.js"></script>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.draw/src/edit/handler/EditToolbar.Edit.js"></script>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.draw/src/edit/handler/EditToolbar.Delete.js"></script>

	<script src="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.draw/src/Control.Draw.js"></script>

	<script src="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.draw/src/edit/handler/Edit.Poly.js"></script>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.draw/src/edit/handler/Edit.SimpleShape.js"></script>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.draw/src/edit/handler/Edit.Rectangle.js"></script>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.draw/src/edit/handler/Edit.Marker.js"></script>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.draw/src/edit/handler/Edit.CircleMarker.js"></script>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.draw/src/edit/handler/Edit.Circle.js"></script>

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/map/leaflet/leaflet-fullscreen/dist/leaflet.fullscreen.css">
	<script src="<?php echo base_url(); ?>assets/map/leaflet/leaflet-fullscreen/dist/Leaflet.fullscreen.min.js"></script>

</head>

<body data-plugin-page-transition>
<div class="body p-relative bottom-1">
	<header id="header" class="header-effect-reveal" data-plugin-options="{'stickyEnabled': true, 'stickyEffect': 'reveal', 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': false, 'stickyChangeLogo': false, 'stickyStartAt': 200, 'stickySetTop': '-44px'}">
		<div class="header-body border-0 border-bottom-light">
			<div class="header-container container-fluid p-0">
				<div class="header-row">
					<div class="header-column header-column-border-right flex-grow-0 d-sticky-header-active-none">
						<div class="header-row">
							<div class="header-logo p-relative top-1 m-0">
								<a href="index.html">
									<img alt="Porto" width="320" height="150" src="<?php echo base_url(); ?>assets/porto/img/sirame/logo_main.png">
								</a>
							</div>
						</div>
					</div>
					<div class="header-column">
						<div class="border-bottom-light w-100">
							<div class="hstack gap-4 px-4 py-2 font-weight-semi-bold d-none d-lg-flex">
								<div class="d-none d-lg-inline-block ps-1"><span class="text-color-default text-color-hover-primary text-2">Sirame PKKPR</span></div>
								<div class="vr d-lg-inline-block opacity-2 d-none d-xl-inline-block"></div>
								<div class="d-none d-xl-inline-block"><span class="text-color-default text-color-hover-primary text-2">DPMPTSP Kabupaten Bekasi</span></div>
								<div class="ms-auto d-none d-lg-inline-block">
									<!--<ul class="nav nav-pills">
										<li class="nav-item dropdown">
											<a class="nav-link text-2 p-0 text-color-default" href="#" role="button" id="dropdownLanguage" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												english
												<i class="fas fa-angle-down"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-end text-2" aria-labelledby="dropdownLanguage">
												<a class="dropdown-item text-color-default" href="#">English</a>
												<a class="dropdown-item text-color-default" href="#">Español</a>
												<a class="dropdown-item text-color-default" href="#">Française</a>
											</div>
										</li>
									</ul>-->
								</div>
								<div class="vr opacity-2 d-none d-lg-inline-block"></div>
								<div class="d-none d-lg-inline-block">
									<ul class="nav nav-pills me-1">
										<li class="nav-item pe-2 mx-1">
											<a href="http://www.facebook.com/" target="_blank" title="Facebook" class="text-color-default text-color-hover-primary text-2"><i class="fab fa-facebook-f"></i></a>
										</li>
										<li class="nav-item px-2 mx-1">
											<a href="http://www.twitter.com/" target="_blank" title="Twitter" class="text-color-default text-color-hover-primary text-2"><i class="fab fa-twitter"></i></a>
										</li>
										<li class="nav-item px-2 mx-1">
											<a href="http://www.instagram.com/" target="_blank" title="Instagram" class="text-color-default text-color-hover-primary text-2"><i class="fab fa-instagram"></i></a>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="header-row h-100">
							<div class="hstack h-100 w-100">
								<div class="h-100 w-100 w-xl-auto">
									<div class="header-nav header-nav-links h-100 justify-content-end justify-content-lg-start me-4 me-lg-0 ms-lg-3">
										<div class="header-nav-main header-nav-main-square header-nav-main-dropdown-no-borders header-nav-main-text-capitalize header-nav-main-text-size-4 header-nav-main-arrows header-nav-main-full-width-mega-menu header-nav-main-mega-menu-bg-hover header-nav-main-effect-5">
											<nav class="collapse">
												<ul class="nav nav-pills" id="mainNav">
													<li>
														<a class="nav-link <?php if($menu=='main'){ ?>active<?php } ?>" href="<?php echo base_url(); ?>main">
															Beranda
														</a>
													</li>
													<?php if (menus(1)) { ?>
														<li>
															<a class="nav-link <?php if($menu=='lapor'){ ?>active<?php } ?>" href="<?php echo base_url(); ?>lapor">
																Pelaporan
															</a>
														</li>
													<?php } ?>
													<?php if (menus(2)) { ?>
														<li>
															<a class="nav-link <?php if($menu=='peta'){ ?>active<?php } ?>" href="<?php echo base_url(); ?>peta">
																Pemetaan
															</a>
														</li>
													<?php } ?>
													<?php if (menus(3)) { ?>
														<li>
															<a class="nav-link <?php if($menu=='file'){ ?>active<?php } ?>" href="<?php echo base_url(); ?>file">
																Download
															</a>
														</li>
													<?php } ?>
													<?php if (menus(4)) { ?>
														<li>
															<a class="nav-link <?php if($menu=='pengumuman'){ ?>active<?php } ?>" href="<?php echo base_url(); ?>pengumuman/publik">
																Pengumuman
															</a>
														</li>
													<?php } ?>
												</ul>
											</nav>
										</div>
										<button class="btn header-btn-collapse-nav" data-bs-toggle="collapse" data-bs-target=".header-nav-main nav">
											<i class="fas fa-bars"></i>
										</button>
									</div>
								</div>
								<div class="vr opacity-2 ms-auto d-none d-xl-inline-block"></div>
								<div class="px-4 d-xxl-inline-block ws-nowrap">
									<?php if (menus(5)) { ?>
									<a href="<?php echo base_url(); ?>daftar" class="btn border-0 px-4 py-2 line-height-9 btn-warning me-2">Daftar</a>
									<?php } ?>
									<?php if (menus(6)) { ?>
									<a href="<?php echo base_url(); ?>log" class="btn border-0 px-4 py-2 line-height-9 btn-success">Masuk</a>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<div role="main" class="main">

		<?php
		if(isset($view))
			$this->load->view($view);
		?>

	</div>
	<footer id="footer" class="position-relative top-1 bg-tertiary border-top-0">

		<div class="container py-5">
			<div class="row pt-5">
				<div class="col-lg-4">
					<a href="demo-transportation-logistic.html" class="text-decoration-none">
						<img src="<?php echo base_url(); ?>assets/porto/img/sirame/logo_footer.png" class="img-fluid mb-4" width="200">
					</a>
					<p class="text-3-5 pe-lg-2">Aplikasi Pelaporan dan Pemetaan PKKPR Kabupaten Bekasi. </p>
					<ul class="list list-unstyled">
						<li class="d-flex align-items-center mb-4">
							<a href="mailto:porto@transportation-logistic.com" class="d-inline-flex align-items-center text-decoration-none text-color-light text-color-hover-primary font-weight-semibold text-4-5">dpmptsp@bekasikab.go.id</a>
						</li>
						<li class="d-flex align-items-center mb-4">
							<a href="tel:8001234567" class="d-inline-flex align-items-center text-decoration-none text-color-light text-color-hover-primary font-weight-semibold text-4-5">021-22156666</a>
						</li>
					</ul>
					<div class="d-none d-xxl-inline-block ws-nowrap">
						<a href="#" class="btn border-0 px-4 py-2 line-height-9 btn-warning text-color-dark me-2">Daftar</a>
						<a href="#" class="btn border-0 px-4 py-2 line-height-9 btn-success">Masuk</a>
					</div>
				</div>
				<div class="col-lg-8">
					<div class="row mb-5">
						<div class="col-lg-6 mb-4 mb-lg-0">
							<h4 class="text-color-light font-weight-semibold mb-3">Navigasi Menu</h4>
							<ul class="list list-unstyled columns-lg-2">
								<li><a href="<?php echo base_url(); ?>main" class="text-color-grey text-color-hover-primary">Beranda</a></li>
								<li><a href="<?php echo base_url(); ?>lapor" class="text-color-grey text-color-hover-primary">Lapor PKKPR</a></li>
								<li><a href="<?php echo base_url(); ?>peta" class="text-color-grey text-color-hover-primary">Peta PKKPR</a></li>
								<li><a href="<?php echo base_url(); ?>file" class="text-color-grey text-color-hover-primary">Download</a></li>
								<li><a href="<?php echo base_url(); ?>pengumuman/publik" class="text-color-grey text-color-hover-primary">Pengumuman</a></li>
							</ul>
						</div>
						<div class="col-lg-6">
							<h4 class="text-color-light font-weight-semibold mb-3">Tautan Terkait</h4>
							<ul class="list list-unstyled columns-lg-2">
								<li><a href="https://dpmptsp.bekasikab.go.id" target="_blank" class="text-color-grey text-color-hover-primary">DPMPTSP</a></li>
								<li><a href="https://boss.bekasikab.go.id/" target="_blank" class="text-color-grey text-color-hover-primary">BOSS</a></li>
								<li><a href="https://oss.go.id/informasi/persyaratan-dasar?tab=kesesuaian-ruang&page=1" target="_blank" class="text-color-grey text-color-hover-primary">OSS</a></li>
								<li><a href="https://gistaru.atrbpn.go.id/" target="_blank" class="text-color-grey text-color-hover-primary">GISTARU</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-copyright bg-transparent">
			<div class="container">
				<hr class="bg-color-light opacity-1">
				<div class="row">
					<div class="col mt-4 mb-4 pb-4">
						<p class="text-center text-3 mb-0 text-color-grey">DPMPTSP KABUPATEN BEKASI © 2023</p>
					</div>
				</div>
			</div>
		</div>
	</footer>

</div>

<!-- Vendor -->
<script src="<?php echo base_url(); ?>assets/porto/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/porto/vendor/jquery.appear/jquery.appear.min.js"></script>
<script src="<?php echo base_url(); ?>assets/porto/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="<?php echo base_url(); ?>assets/porto/vendor/jquery.cookie/jquery.cookie.min.js"></script>
<script src="<?php echo base_url(); ?>assets/porto/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/porto/vendor/jquery.validation/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/porto/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
<script src="<?php echo base_url(); ?>assets/porto/vendor/jquery.gmap/jquery.gmap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/porto/vendor/lazysizes/lazysizes.min.js"></script>
<script src="<?php echo base_url(); ?>assets/porto/vendor/isotope/jquery.isotope.min.js"></script>
<script src="<?php echo base_url(); ?>assets/porto/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="<?php echo base_url(); ?>assets/porto/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="<?php echo base_url(); ?>assets/porto/vendor/vide/jquery.vide.min.js"></script>
<script src="<?php echo base_url(); ?>assets/porto/vendor/vivus/vivus.min.js"></script>

<!-- Demo -->
<script src="<?php echo base_url(); ?>assets/porto/js/demos/demo-transportation-logistic.js"></script>

<!-- Theme Base, Components and Settings -->
<script src="<?php echo base_url(); ?>assets/porto/js/theme.js"></script>

<!-- Current Page Vendor and Views -->
<script src="<?php echo base_url(); ?>assets/porto/js/views/view.contact.js"></script>

<!-- Theme Custom -->
<script src="<?php echo base_url(); ?>assets/porto/js/custom.js"></script>

<!-- Theme Initialization Files -->
<script src="<?php echo base_url(); ?>assets/porto/js/theme.init.js"></script>

<!-- Porto Admin -->
<!-- Specific Page Vendor -->
<script src="<?php echo base_url(); ?>assets/porto-adm/vendor/select2/js/select2.js"></script>
<script src="<?php echo base_url(); ?>assets/porto-adm/vendor/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/porto-adm/vendor/datatables/media/js/dataTables.bootstrap5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/porto-adm/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/porto-adm/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/porto-adm/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/porto-adm/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>assets/porto-adm/vendor/datatables/extras/TableTools/JSZip-2.5.0/jszip.min.js"></script>
<!--<script src="--><?php //echo base_url(); ?><!--assets/porto-adm/vendor/datatables/extras/TableTools/pdfmake-0.1.32/pdfmake.min.js"></script>-->
<script src="<?php echo base_url(); ?>assets/porto-adm/vendor/datatables/extras/TableTools/pdfmake-0.1.32/vfs_fonts.js"></script>

<!-- Examples -->
<script src="<?php echo base_url(); ?>assets/porto-adm/js/examples/examples.datatables.default.js"></script>
<script src="<?php echo base_url(); ?>assets/porto-adm/js/examples/examples.datatables.row.with.details.js"></script>
<script src="<?php echo base_url(); ?>assets/porto-adm/js/examples/examples.datatables.tabletools.js"></script>

</body>
</html>
