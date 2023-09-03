<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php if (isset($title)) echo $title; ?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/lte/img/icon.png"/>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<!-- AdminLTE -->
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/lte/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/lte/bootstrap/css/jquery.bsPhotoGallery.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
		 folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/lte/dist/css/skins/_all-skins.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/lte/plugins/iCheck/flat/blue.css">
	<!-- Morris chart -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/lte/plugins/morris/morris.css">
	<!-- jvectormap -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/lte/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
	<!-- Date Picker -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/lte/plugins/datepicker/datepicker3.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/lte/plugins/daterangepicker/daterangepicker.css">
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet"
		  href="<?php echo base_url(); ?>assets/lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/lte/plugins/select2/select2.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/lte/plugins/datatables/dataTables.bootstrap.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/lte/dist/css/AdminLTE.min.css">
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet"
		  href="<?php echo base_url(); ?>assets/lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<!-- AdminLTE . end -->

	<!-- Map -->
	<?php if ($view == 'pemohon/map' || $view == 'pemohon/map_rdtr') { ?>
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/map/leaflet/leaflet.css"/>
	<?php } else { ?>
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/map/leaflet/leaflet-public.css"/>
	<?php } ?>
	<!-- memanggil css di folder leaflet -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.Basemaps/L.Control.Basemaps.css"/>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/map/leaflet/leaflet-sidebar/css/leaflet-sidebar.css"/>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/map/leaflet/leaflet.groupedlayercontrol/src/leaflet.groupedlayercontrol.css"/>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/map/css/style.css"/> <!-- memanggil css style -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.defaultextent-master/dist/leaflet.defaultextent.css"/>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/leaflet.js"></script>
	<!-- memanggil leaflet.js di folder leaflet -->
	<script src="<?php echo base_url(); ?>assets/map/js/jquery-3.4.1.min.js"></script>
	<!-- memanggil jquery di folder js -->
	<script src="<?php echo base_url(); ?>assets/map/leaflet/leaflet-ajax/dist/leaflet.ajax.js"></script>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/leaflet.groupedlayercontrol/src/leaflet.groupedlayercontrol.js"></script>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/leaflet-providers-master/leaflet-providers.js"></script>
	<!-- memanggil leaflet-providers.js-->
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

	<script src="<?php echo base_url(); ?>assets/map/leaflet/leaflet-easyPrint/dist/bundle.js"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/map/leaflet/leaflet-fullscreen/dist/leaflet.fullscreen.css">
	<script src="<?php echo base_url(); ?>assets/map/leaflet/leaflet-fullscreen/dist/Leaflet.fullscreen.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/leaflet-search-master/src/leaflet-search.js"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/map/leaflet/leaflet-search-master/src/leaflet-search.css">
</head>



<?php if ($view == 'pemohon/map' || $view == 'pemohon/skrr/skrr_peta' || $view == 'pemohon/skrr/skrr_add' || $view == 'pemohon/skrr/skrr_edit'
|| $view == 'pemohon/persyaratan/persyaratan_detil' || $view == 'pemohon/pelaporan/pelaporan_detil' || $view == 'pemohon/pengkajian/pengkajian_detil'
|| $view == 'pemohon/dokumen/dokumen_detil' || $view == 'pemohon/persyaratan_sp/persyaratan_detil' || $view == 'pemohon/pengkajian_sp/pengkajian_detil'
|| $view == 'pemohon/dokumen_sp/dokumen_detil') { ?>
<body class="hold-transition skin-green fixed sidebar-collapse sidebar-mini">
<?php } else { ?>
<body class="hold-transition skin-green fixed sidebar-mini">
<?php } ?>
<div class="wrapper">

	<!-- Start - Nav Header -->
	<header class="main-header">
		<!-- Logo -->
		<a href="<?php echo base_url(); ?>pemohon" class="logo">
			<!-- mini logo for sidebar mini 50x50 pixels -->
			<span class="logo-mini"><b>SK</b></span>
			<!-- logo for regular state and mobile devices -->
			<span class="logo-lg"><b>SIRAME PKKPR</b></span>
		</a>
		<!-- Header Navbar: style can be found in header.less -->
		<nav class="navbar navbar-static-top">
			<!-- Sidebar toggle button-->
			<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
				<span class="sr-only">Toggle navigation</span>
			</a>

			<?php
			$idpemohon = $this->session->userdata('idpemohon');
			$nama = $this->session->userdata('nama');
			$email = $this->session->userdata('email');
			$hp = $this->session->userdata('hp');
			$noktp = $this->session->userdata('noktp');
			?>

			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					<li class="dropdown user user-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<img src="<?= base_url(); ?>assets/lte/img/login-yellow.png" class="user-image"
								 alt="User Image">
							<span class="hidden-xs"><?= $nama ?></span>
						</a>
						<ul class="dropdown-menu">
							<!-- User image -->
							<li class="user-header">
								<img src="<?= base_url(); ?>assets/lte/img/login-yellow.png" class="img-circle"
									 alt="User Image">
								<p>
									<?= $nama ?>
									<small><?= $email ?></small>
									<small><?= $noktp ?></small>
								</p>
							</li>
							<!-- Menu Footer-->
							<li class="user-footer">
								<!--<div class="pull-left">
                        <a href="<?php /*echo base_url(); */ ?>" class="btn btn-default btn-flat">Profile</a>
                    </div>-->
								<div class="pull-right">
									<a href="<?= base_url(); ?>daftar/logout" class="btn btn-default btn-flat">Logout</a>
								</div>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
	</header>
	<!-- End - Nav Header -->

	<!-- Start - Nav Sidebar -->
	<!-- Left side column. contains the logo and sidebar -->
	<aside class="main-sidebar">
		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">
			<!-- Sidebar user panel -->
			<div class="user-panel" <?php if ($view == 'pemohon/map_rdtr') { ?>style="background-color: #3C8DBC"<?php } ?>>
				<div class="pull-left image">
					<img src="<?= base_url(); ?>assets/lte/img/login-yellow.png" class="img-circle"
						 alt="User Image">
				</div>
				<div class="pull-left info">
					<p><?= $nama ?></p>
					<a href="#"><i class="fa fa-circle text-warning"></i> Pemohon</a>
				</div>
			</div>
			<ul class="sidebar-menu">
				<hr style="border: 1px solid #1e282c; margin: 0"/>
				<li class="<?php if ($menu == 'dashboard') { ?>active<?php } ?> treeview">
					<a href="<?= base_url(); ?>pemohon">
						<i class="fa fa-dashboard"></i> <span>Dashboard</span>
					</a>
				</li>
				<li class="header" style="color: #3C8DBC;">MENU SIRAME</li>
				<li class="<?php if ($menu == 'kkpr') { ?>active<?php } ?> treeview">
					<a href="<?= base_url(); ?>kkpr">
						<i class="fa fa-file-text-o"></i> <span>PKKPR</span>
					</a>
				</li>
				<li class="<?php if ($menu == 'pelaporan') { ?>active<?php } ?> treeview">
					<a href="<?= base_url(); ?>pelaporan">
						<i class="fa fa-calendar-check-o"></i> <span>Pelaporan</span>
					</a>
				</li>
				<li class="<?php if ($menu == 'pemetaan') { ?>active<?php } ?> treeview">
					<a href="<?php echo base_url(); ?>peta/kkpr" target="_blank">
						<i class="fa fa-map-o"></i> <span>Pemetaan</span>
					</a>
				</li>
				<li class="header" style="color: #3C8DBC;">MENU LAINNYA</li>
				<li class="<?php if ($menu == 'pengumuman') { ?>active<?php } ?> treeview">
					<a href="<?= base_url(); ?>pengumuman/pemohon">
						<i class="fa fa-bullhorn"></i> <span>Pengumuman</span>
					</a>
				</li>
				<li class="<?php if ($menu == 'file') { ?>active<?php } ?> treeview">
					<a href="<?= base_url(); ?>file/pemohon">
						<i class="fa fa-download"></i> <span>Download</span>
					</a>
				</li>
			</ul>
		</section>
		<!-- /.sidebar -->
	</aside>
	<!-- End - Nav Sidebar -->

	<!-- Start - Content View -->
	<?php
	if (isset($view))
		$this->load->view($view);
	?>
	<!-- End - Content View -->

	<footer class="main-footer">
		<div class="pull-right hidden-xs">
			<b>Version</b> 1.0.0
		</div>
		<strong class="text-black">&copy; 2023 &mdash; APLIKASI PELAPORAN DAN PEMETAAN PKKPR KABUPATEN BEKASI</strong>
	</footer>

	<!-- jQuery 2.2.3 -->
	<script src="<?php echo base_url(); ?>assets/lte/plugins/jQuery/jquery-2.2.3.min.js"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="<?php echo base_url(); ?>assets/lte/bootstrap/js/bootstrap.min.js"></script>
	<!-- SlimScroll -->
	<script src="<?php echo base_url(); ?>assets/lte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
	<!-- FastClick -->
	<script src="<?php echo base_url(); ?>assets/lte/plugins/fastclick/fastclick.js"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url(); ?>assets/lte/dist/js/app.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="<?php echo base_url(); ?>assets/lte/dist/js/demo.js"></script>
	<!-- FLOT CHARTS -->
	<script src="<?php echo base_url(); ?>assets/lte/plugins/flot/jquery.flot.min.js"></script>
	<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
	<script src="<?php echo base_url(); ?>assets/lte/plugins/flot/jquery.flot.resize.min.js"></script>
	<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
	<script src="<?php echo base_url(); ?>assets/lte/plugins/flot/jquery.flot.categories.min.js"></script>

	<script src="<?php echo base_url(); ?>assets/lte/bootstrap/js/jquery.bsPhotoGallery.js"></script>
	<script>
		$(document).ready(function () {
			$('ul.first').bsPhotoGallery({
				"classes": "col-lg-2 col-md-4 col-sm-3 col-xs-4 col-xxs-12",
				"hasModal": true,
				// "fullHeight" : false
			});
		});
	</script>

	<!-- Select2 -->
	<script src="<?php echo base_url(); ?>assets/lte/plugins/select2/select2.full.min.js"></script>
	<!-- Bootstrap WYSIHTML5 -->
	<script src="<?php echo base_url(); ?>assets/lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
	<!-- CK Editor -->
	<script src="https://cdn.ckeditor.com/4.5.7/full/ckeditor.js"></script>
	<!-- DataTables -->
	<script src="<?php echo base_url(); ?>assets/lte/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/lte/plugins/datatables/dataTables.bootstrap.min.js"></script>

	<!-- Page script -->
	<script>
		$(function () {
			//Initialize Select2 Elements
			$(".select2").select2();
		});

		<?php if ($view == 'pemohon/pengumuman_add' || $view == 'pemohon/pengumuman_edit' || $view == 'pemohon/pelaporan/pelaporan_add'
		|| $view == 'pemohon/pelaporan/pelaporan_edit' || $view == 'pemohon/pengkajian_add' || $view == 'pemohon/pengkajian_edit'
		|| $view == 'pemohon/dokumen_add' || $view == 'pemohon/dokumen_edit') { ?>
		$(function () {
			CKEDITOR.replace('editor1');
			//bootstrap WYSIHTML5 - text editor
			$(".textarea").wysihtml5();
		});
		<?php } ?>
	</script>

	<script>
		$(function () {
			var csfrData = {};
			$.ajaxSetup({
				data: csfrData
			});
			$(document).on('click', '.zoom-map', function (e) {

				var lng = document.getElementById('lng').value;
				var lat = document.getElementById('lat').value;
				e.preventDefault();

				var tempMarker = L.marker([lat, lng]).addTo(map);
				tempMarker.bindPopup("<b>Hasil Zoom Titik Koordinat").openPopup();
				map.flyTo([lat, lng], 18);
			});
		});
	</script>

	<script>
		$(function () {
			var csfrData = {};
			$.ajaxSetup({
				data: csfrData
			});
			$(document).on('click', '.zoom-loc', function (e) {
				locateUser();
			});
		});
	</script>

</body>
</html>
