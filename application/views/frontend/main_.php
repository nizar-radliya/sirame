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
	<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/porto/img/logo.png" type="image/x-icon" />
	<link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/porto/img/logo.png">

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
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/porto/css/demos/demo-business-consulting-3.css">

	<!-- Skin CSS -->
	<link id="skinCSS" rel="stylesheet" href="<?php echo base_url(); ?>assets/porto/css/skins/skin-business-consulting-3.css">

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

<body data-plugin-cursor-effect>
<div class="body">
	<header id="header" class="header-effect-shrink" data-plugin-options="{'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': false, 'stickyChangeLogo': true, 'stickyStartAt': 120, 'stickyHeaderContainerHeight': 85}">
		<div class="header-body border-top-0">
			<div class="header-top header-top-default header-top-borders border-bottom-0 bg-color-light">
				<div class="container">
					<div class="header-row">
						<div class="header-column justify-content-between">
							<div class="header-row">
								<nav class="header-nav-top w-100 w-md-50pct w-xl-100pct">
									<ul class="nav nav-pills d-inline-flex custom-header-top-nav-background pe-5">
										<li class="nav-item py-2 d-inline-flex z-index-1">
											<span class="font-weight-normal align-items-center px-0 d-none d-xl-flex ms-3">
														<span>
															<img width="25" src="<?php echo base_url(); ?>assets/porto/img/demos/business-consulting-3/icons/email.svg" alt="Email Icon" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-light'}" />
														</span>
														<a class="text-color-light text-decoration-none font-weight-semibold text-3-5 ms-2" href="mailto:dpmptsp@bekasikab.go.id" data-cursor-effect-hover="plus" data-cursor-effect-hover-color="light">dpmptsp@bekasikab.go.id</a>
													</span>
										</li>
									</ul>
								</nav>
								<div class="d-flex align-items-center w-100">
									<ul class="ps-0 ms-auto mb-0">
										<li class="nav-item font-weight-semibold text-1 text-lg-2 text-color-dark d-none d-md-flex justify-content-end me-3">
											<!--Mon - Sat 9:00am - 3:00pm / Sunday - CLOSED-->
										</li>
									</ul>
									<ul class="social-icons social-icons-clean social-icons-icon-dark social-icons-big m-0 ms-lg-2">
										<li class="social-icons-instagram">
											<a href="https://www.instagram.com/dpmptspkabbekasi/" target="_blank" class="text-4" title="Instagram" data-cursor-effect-hover="fit"><i class="fab fa-instagram"></i></a>
										</li>
										<li class="social-icons-twitter">
											<a href="http://www.twitter.com/" target="_blank" class="text-4" title="Twitter" data-cursor-effect-hover="fit"><i class="fab fa-twitter"></i></a>
										</li>
										<li class="social-icons-facebook">
											<a href="http://www.facebook.com/" target="_blank" class="text-4" title="Facebook" data-cursor-effect-hover="fit"><i class="fab fa-facebook-f"></i></a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="header-container container" style="height: 117px;">
				<div class="header-row">
					<div class="header-column">
						<div class="header-row">
							<div class="header-logo">
								<a href="<?php echo base_url(); ?>">
									<img alt="Porto" width="300" height="61" src="<?php echo base_url(); ?>assets/porto/img/logo_app.png">
								</a>
							</div>
						</div>
					</div>
					<div class="header-column justify-content-end w-100">
						<div class="header-row">
							<div class="header-nav header-nav-links order-2 order-lg-1">
								<div class="header-nav-main header-nav-main-square header-nav-main-text-capitalize header-nav-main-effect-1 header-nav-main-sub-effect-1">
									<nav class="collapse">
										<ul class="nav nav-pills" id="mainNav">
											<li>
												<a class="nav-link <?php if($menu=='main'){ ?>active<?php } ?>" href="<?php echo base_url(); ?>main">
													Beranda
												</a>
											</li>
											<?php if (menus(1)) { ?>
												<li>
													<a class="nav-link <?php if($menu=='peta'){ ?>active<?php } ?>" href="<?php echo base_url(); ?>peta">
														Peta
													</a>
												</li>
											<?php } ?>
											<li class="dropdown">
												<a class="nav-link <?php if($menu=='layanan'){ ?>active<?php } ?> dropdown-toggle" href="#">
													Layanan
												</a>
												<ul class="dropdown-menu">
													<?php if (menus(2)) { ?>
													<li>
														<a href="<?php echo base_url(); ?>layanan" class="dropdown-item">Pelaporan KKPR</a>
													</li>
													<?php } ?>
												</ul>
											</li>
											<?php if (menus(4)) { ?>
											<li>
												<a class="nav-link <?php if($menu=='file'){ ?>active<?php } ?>" href="<?php echo base_url(); ?>file">
													Download
												</a>
											</li>
											<?php } ?>
											<?php if (menus(5)) { ?>
											<li>
												<a class="nav-link <?php if($menu=='pengumuman'){ ?>active<?php } ?>" href="<?php echo base_url(); ?>pengumuman/publik">
													Pengumuman
												</a>
											</li>
											<?php } ?>
										</ul>
									</nav>
								</div>
							</div>
						</div>
					</div>
					<?php if (menus(6)) { ?>
					<div class="header-column header-column-search justify-content-end align-items-center d-flex w-auto flex-row">
						<a href="<?php echo base_url(); ?>log/sitaru" class="btn btn-dark custom-btn-style-1 font-weight-semibold text-3-5 btn-px-3 py-2 ws-nowrap ms-4 d-none d-lg-block" data-cursor-effect-hover="plus" data-cursor-effect-hover-color="light"><span>Login</span></a>
						<div class="header-nav-features header-nav-features-no-border">
							<div class="header-nav-feature header-nav-features-search d-inline-flex">
								<a href="#" class="header-nav-features-toggle text-decoration-none" data-focus="headerSearch">
									<i class="icons icon-magnifier header-nav-top-icon text-3-5 text-color-dark text-color-hover-primary font-weight-semibold top-3"></i>
								</a>
								<div class="header-nav-features-dropdown header-nav-features-dropdown-mobile-fixed border-radius-0" id="headerTopSearchDropdown">
									<form role="search" action="#" method="get">
										<div class="simple-search input-group">
											<input class="form-control text-1" id="headerSearch" name="q" type="search" value="" placeholder="Search...">
											<button class="btn" type="submit">
												<i class="icons icon-magnifier header-nav-top-icon text-color-dark text-color-hover-primary top-2"></i>
											</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<button class="btn header-btn-collapse-nav" data-bs-toggle="collapse" data-bs-target=".header-nav-main nav">
							<i class="fas fa-bars"></i>
						</button>
					</div>
					<?php } ?>
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

	<footer id="footer" class="border-top-0 m-0 lazyload" style="background-size: cover; background-position: center; background-repeat: no-repeat; background-color: #1875D1;">
		<div class="container pt-3">
			<div class="row pt-3 mt-5">
				<div class="col-lg-3 mb-4 mb-lg-0">
					<!--<a href="<?php /*echo base_url(); */?>" class="text-decoration-none">
						<img src="<?php /*echo base_url(); */?>assets/porto/img/logo-footer.png" class="img-fluid mb-4" width="123" height="33" alt="" />
					</a>-->
					<h4 class="font-weight-bold text-5">SIRAME KKPR</h4>
					<p class="text-3-5" style="color: #F1C40E">Aplikasi Pelaporan dan Pemetaan KKPR</p>
					<p class="text-3-5" style="color: #F1C40E">Versi 1.0</p>
					<ul class="social-icons social-icons-clean social-icons-clean-with-border social-icons-medium social-icons-icon-light">
						<li class="social-icons-instagram"><a href="https://www.instagram.com/dpmptspkabbekasi/" target="_blank" title="Linkedin" data-cursor-effect-hover="fit"><i class="fab fa-instagram"></i></a></li>
					</ul>
				</div>
				<div class="col-lg-3 mb-4 mb-lg-0">
					<ul class="list list-icons list-icons-lg">
						<li class="d-flex px-0 mb-1">
							<img width="25" src="<?php echo base_url(); ?>assets/porto/img/demos/business-consulting-3/icons/phone.svg" alt="Phone Icon" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-light'}" />
							<a href="tel:0260411106" class="text-color-light font-weight-semibold text-3-4 ms-2">(0260) 411-106</a>
						</li>
						<li class="d-flex px-0 my-3">
							<img width="25" src="<?php echo base_url(); ?>assets/porto/img/demos/business-consulting-3/icons/email.svg" alt="Email Icon" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-light'}" />
							<a href="mailto:dpmptsp@bekasikab.go.id" class="text-color-light font-weight-semibold text-3-4 ms-2">dpmptsp@bekasikab.go.id</a>
						</li>
						<li class="d-flex font-weight-semibold text-color-light px-0 mb-1">
							<img width="25" src="<?php echo base_url(); ?>assets/porto/img/demos/business-consulting-3/icons/map-pin.svg" alt="Location" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-light me-2'}" />
							Komplek Perkantoran PemKab Bekasi Gedung B1 Jln. Deltamas Boulevard Sukamahi - Cikarang Pusat - Kabupaten Bekasi - Jawa Barat 17530
						</li>
					</ul>
				</div>
				<div class="col-lg-4 mb-4 mb-lg-0">
					<!-- Google Maps - Go to the bottom of the page to change settings and map location. -->
					<div id="googlemaps" class="google-map m-0" style="height: 190px;"></div>
				</div>
				<div class="col-lg-2">
					<h4 class="font-weight-bold text-5">Link Terkait</h4>
					<ul class="list list-icons list-icons-sm">
						<li>
							<i class="fas fa-angle-right text-color-default"></i>
							<a href="https://gistaru.atrbpn.go.id/" target="_blank" class="link-hover-style-1 ms-1"> GISTARU</a>
						</li>
						<li>
							<i class="fas fa-angle-right text-color-default"></i>
							<a href="https://satupeta.jabarprov.go.id/#/map" target="_blank" class="link-hover-style-1 ms-1"> SATU PETA JABAR</a>
						</li>
						<li>
							<i class="fas fa-angle-right text-color-default"></i>
							<a href="https://dpmptsp.bekasikab.go.id" target="_blank" class="link-hover-style-1 ms-1"> DPMPTSP KABUPATEN BEKASI</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="footer-copyright container bg-transparent">
			<div class="row pb-5">
				<div class="col-lg-12 text-center m-0">
					<hr class="bg-color-light opacity-1 mt-5 mb-4">
					<p class="text-3-4" style="color: #F1C40E">Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu - Kabupaten Bekasi. © 2023. Versi 1.0</p>
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

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbZTkoR7ZcS3FoFuYhrNLo2m-mtoNeULg&callback=myMap&libraries=places"></script>
<script>

	/*
	Map Settings

		Find the Latitude and Longitude of your address:
			- https://www.latlong.net/
			- http://www.findlatitudeandlongitude.com/find-address-from-latitude-and-longitude/

	*/

	function initializeGoogleMaps() {
		// Map Initial Location
		var initLatitude = -6.5529472;
		var initLongitude = 107.7642415;

		// Map Markers
		var mapMarkers = [{
			latitude: initLatitude,
			longitude: initLongitude,
			html: "<strong>Dinas Bina Marga dan Penataan Ruang</strong><br>Provinsi Jawa Barat<br><br><a href='#' onclick='mapCenterAt({latitude: -4.3707381, longitude: 104.3615502, zoom: 16}, event)'>[+] zoom here</a>",
			icon: {
				image: "<?php echo base_url(); ?>assets/porto/img/demos/business-consulting-3/map-pin.png",
				iconsize: [26, 27],
				iconanchor: [12, 27]
			}
		}];

		// Map Extended Settings
		var mapSettings = {
			controls: {
				draggable: (($.browser.mobile) ? false : true),
				panControl: false,
				zoomControl: false,
				mapTypeControl: false,
				scaleControl: false,
				streetViewControl: false,
				overviewMapControl: false
			},
			scrollwheel: false,
			markers: mapMarkers,
			latitude: initLatitude,
			longitude: initLongitude,
			zoom: 14
		};

		var map = $('#googlemaps').gMap(mapSettings),
			mapRef = $('#googlemaps').data('gMap.reference');

		// Styles from https://snazzymaps.com/
		var styles = [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}];

		var styledMap = new google.maps.StyledMapType(styles, {
			name: 'Styled Map'
		});

		mapRef.mapTypes.set('map_style', styledMap);
		mapRef.setMapTypeId('map_style');
	}

	// Initialize Google Maps when element enter on browser view
	theme.fn.intObs( '#googlemaps', 'initializeGoogleMaps()', {} );

	// Map text-center At
	var mapCenterAt = function(options, e) {
		e.preventDefault();
		$('#googlemaps').gMap("centerAt", options);
	}

</script>

</body>
</html>
