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
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/map/leaflet/leaflet-public.css"/>

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/map/leaflet/leaflet-ori.css" /> <!-- memanggil css di folder leaflet -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/map/leaflet/leaflet.groupedlayercontrol/src/leaflet.groupedlayercontrol.css"/>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/map/css/style.css" /> <!-- memanggil css style -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.defaultextent-master/dist/leaflet.defaultextent.css" />
	<script src="<?php echo base_url(); ?>assets/map/leaflet/leaflet.js"></script> <!-- memanggil leaflet.js di folder leaflet -->
	<script src="<?php echo base_url(); ?>assets/map/js/jquery-3.7.1.min.js"></script> <!-- memanggil jquery di folder js -->
	<script src="<?php echo base_url(); ?>assets/map/leaflet/leaflet-ajax/dist/leaflet.ajax.js"></script>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/leaflet.groupedlayercontrol/src/leaflet.groupedlayercontrol.js"></script>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/leaflet-providers-master/leaflet-providers.js"></script> <!-- memanggil leaflet-providers.js-->
	<script src="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.defaultextent-master/dist/leaflet.defaultextent.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/2.4.1/lodash.min.js"></script>

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/map/leaflet/leaflet-locatecontrol/dist/L.Control.Locate.css">
	<script src="<?php echo base_url(); ?>assets/map/leaflet/leaflet-locatecontrol/src/L.Control.Locate.js"></script>

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/map/leaflet/leaflet-switch-basemap/L.switchBasemap.css">
	<script src="<?php echo base_url(); ?>assets/map/leaflet/leaflet-switch-basemap/L.switchBasemap.js"></script>

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/map/leaflet/leaflet-betterscale/L.Control.BetterScale.css">
	<script src="<?php echo base_url(); ?>assets/map/leaflet/leaflet-betterscale/L.Control.BetterScale.js"></script>

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/map/leaflet/leaflet.mouseCoordinate/src/leaflet.mouseCoordinate.css">
	<script src="<?php echo base_url(); ?>assets/map/leaflet/leaflet.mouseCoordinate/src/leaflet.mouseCoordinate.js"></script>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/leaflet.mouseCoordinate/src/utm.js"></script>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/leaflet.mouseCoordinate/src/utmref.js"></script>

	<script src="<?php echo base_url(); ?>assets/map/leaflet/leaflet.betterwms/L.TileLayer.BetterWMS.js"></script>

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.EasyButton/src/easy-button.css"/>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.EasyButton/src/easy-button.js"></script>

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/map/leaflet/leaflet-measure/leaflet-measure.css"/>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/leaflet-measure/src/leaflet-measure.js"></script>

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/map/leaflet/leaflet.control.layers.tree/L.Control.Layers.Tree.css"/>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/leaflet.control.layers.tree/L.Control.Layers.Tree.js"></script>

	<!--<script src="<?php /*echo base_url(); */?>assets/map/leaflet/esri-leaflet/esri-leaflet.js"></script>
	<script src="<?php /*echo base_url(); */?>assets/map/leaflet/esri-leaflet/esri-leaflet-vector.js"></script>-->

	<!-- Load Esri Leaflet from CDN -->
	<script src="https://unpkg.com/esri-leaflet@^3.0.8/dist/esri-leaflet.js"></script>
	<!-- Load Esri Leaflet Vector from CDN -->
	<script src="https://unpkg.com/esri-leaflet-vector@4.0.0/dist/esri-leaflet-vector.js" crossorigin=""></script>

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.Basemaps/L.Control.Basemaps.css"/>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/Leaflet.Basemaps/L.Control.Basemaps.js"></script>

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/map/leaflet/leaflet-sidebar/css/leaflet-sidebar.css"/>
	<script src="<?php echo base_url(); ?>assets/map/leaflet/leaflet-sidebar/js/leaflet-sidebar.js"></script>

	<!--<link rel="stylesheet" href="<?php /*echo base_url(); */?>assets/map/leaflet/esri-leaflet-geocoder/esri-leaflet-geocoder.css">
	<script src="<?php /*echo base_url(); */?>assets/map/leaflet/esri-leaflet-geocoder/esri-leaflet-geocoder.js"></script>-->

	<!-- Load Esri Leaflet Geocoder from CDN -->
	<link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@^3.1.3/dist/esri-leaflet-geocoder.css">
	<script src="https://unpkg.com/esri-leaflet-geocoder@^3.1.3/dist/esri-leaflet-geocoder.js"></script>

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
	<!-- Map . end -->

	<style>
		html,
		body {
			height: 100%;
			margin: 0;
		}

		#map {
			position: absolute;
			top: 0;
			bottom: 0;
			width: 100%;
		}
	</style>

	<!--<script type="text/javascript">
		$(window).on('load', function() {
			$('#modal').modal('show');
		});
	</script>-->

</head>

<body data-plugin-cursor-effect>
<div class="body">

	<div id="sidebar" class="leaflet-sidebar collapsed" style="height: 97%;">

		<!-- nav tabs -->
		<div class="leaflet-sidebar-tabs">
			<!-- top aligned tabs -->
			<ul role="tablist">
				<li><a href="<?= base_url() ?>" title="Kembali ke Beranda"><i class="fa fa-arrow-left active"></i></a></li>
				<li><a href="#menu" role="tab" title="Daftar Menu"><i class="fa fa-bars active"></i></a></li>
				<li><a href="#layer" role="tab" title="Daftar Layer"><i class="fa fa-layer-group"></i></a></li>
				<li><a href="#filter" role="tab" title="Pencarian Berdasarkan Koordinat Lokasi"><i class="fa fa-magnifying-glass-location"></i></a></li>
			</ul>

			<!-- bottom aligned tabs -->
			<ul role="tablist">
				<li><a href="#info" role="tab" title="Disclaimer"><i class="fa fa-triangle-exclamation"></i></a></li>
			</ul>
		</div>

		<!-- panel content -->
		<div class="leaflet-sidebar-content">
			<div class="leaflet-sidebar-pane" id="menu">
				<h1 class="leaflet-sidebar-header">
					Esok Lebih Mulia
					<span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
				</h1>

				<p style="margin-top: 10px; margin-right: 10px">
					<a href="<?php echo base_url(); ?>main" class="btn btn-outline btn-rounded btn-tertiary  btn-with-arrow mb-2" style="width: 100%">Beranda<span><i class="fas fa-chevron-right"></i></span></a><br>
					<?php if (menus(1)) { ?>
					<a href="<?php echo base_url(); ?>lapor" class="btn btn-outline btn-rounded btn-tertiary  btn-with-arrow mb-2" style="width: 100%">Pelaporan<span><i class="fas fa-chevron-right"></i></span></a><br>
					<?php } ?>
					<?php if (menus(2)) { ?>
						<a href="<?php echo base_url(); ?>peta" class="btn btn-outline btn-rounded btn-tertiary  btn-with-arrow mb-2" style="width: 100%">Pemetaan<span><i class="fas fa-chevron-right"></i></span></a><br>
					<?php } ?>
					<?php if (menus(3)) { ?>
						<a href="<?php echo base_url(); ?>file" class="btn btn-outline btn-rounded btn-tertiary  btn-with-arrow mb-2" style="width: 100%">Download<span><i class="fas fa-chevron-right"></i></span></a><br>
					<?php } ?>
					<?php if (menus(4)) { ?>
						<a href="<?php echo base_url(); ?>pengumuman/publik" class="btn btn-outline btn-rounded btn-tertiary  btn-with-arrow mb-2" style="width: 100%">Pengumuman<span><i class="fas fa-chevron-right"></i></span></a><br>
					<?php } ?>
				</p>

			</div>

			<div class="leaflet-sidebar-pane" id="layer">
				<h1 class="leaflet-sidebar-header">
					SIRAME PKKPR
					<span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
				</h1>
				<div id="new-parent" style="padding-top: 10px">
				</div>
			</div>

			<div class="leaflet-sidebar-pane" id="filter">
				<h1 class="leaflet-sidebar-header">
					Pencarian Lokasi
					<span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
				</h1>
				<p style="margin-top: 10px">
				<table class="table table-bordered" style="margin-bottom: 10px">
					<tr>
						<td colspan="2">
							<div class="alert alert-warning m-0">
								Format: <strong>Decimal Degrees (DD)</strong><br>
								<a href="https://www.pgc.umn.edu/apps/convert/" target="_blank">Coordinate Converter <i class="fas fa-arrow-right"></i></a>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<label>Longitude (X)</label>
							<input type="text" class="form-control" name="lng" id="lng" required placeholder="Long (X)">
						</td>
						<td>
							<label>Latitude (Y)</label>
							<input type="text" class="form-control" name="lat" id="lat" required placeholder="Lat (Y)">
						</td>
					</tr>
					<tr>
						<td colspan="2" style="text-align: center">
							<a href="#" class="zoom-map" data-id="-4.037013" data-id2="104.696632">
								<button type="button" class="btn btn-block btn-default btn-xs">Zoom Titik Koordinat</button>
							</a>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="text-align: center">
							<a href="#" class="zoom-loc">
								<button type="button" class="btn btn-block btn-default btn-xs">Zoom Lokasi Sekarang</button>
							</a>
						</td>
					</tr>
				</table>
				</p>
			</div>

			<div class="leaflet-sidebar-pane" id="info">
				<h1 class="leaflet-sidebar-header">
					Disclaimer
					<span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
				</h1>
				<p style="margin-top: 10px; text-align: justify">
					Setiap informasi yang dikelola unit pengelola dan penyebarluasan data serta ditampilkan pada Peta ini diberikan sebagaimana adanya dengan tetap memperhatikan ketentuan perlindungan informasi yang bersifat pribadi dan/atau bersifat rahasia, serta dengan pengertian bahwa unit pengelola dan penyebarluasan data tidak bertanggung jawab atau menjamin ketepatan waktu, keakuratan, atau kelengkapan informasi tersebut. Jika pengguna bermaksud mengandalkan informasi apa pun yang ditampilkan pada Peta ini, maka pengguna dapat mengajukan permohonan Pelayanan Informasi Publik melalui email: dpmptsp@bekasikab.go.id atau melalui layanan kirim pesan yang tersedia di web. Apabila pengguna menemukan ketidaksesuaian informasi terkait letak, bentuk, posisi, serta informasi penjelasan lainnya maka pengguna dapat melakukan klarifikasi kepada unit produksi terkait data dan informasi dimaksud atau pengguna dapat menyampaikan informasi tersebut melalui layanan Pelaporan di web SIRAME PKKPR.
				</p>
			</div>
		</div>
	</div>

	<div id="map" <!--style="margin-bottom: 50px; height: 715px;"-->> <!-- ini id="map" bisa di ganti dengan nama yang di inginkan -->
		<?php
		if(isset($view))
			$this->load->view($view);
		?>
	</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="largeModalLabel">Penjelasan dan Ketentuan</h4>
			</div>
			<div class="modal-body" style="text-align: justify">
				<ul class="list list-icons list-primary">
					<li><i class="fas fa-check"></i> Esok Lebih Mulia menyediakan data-data Peta Dasar, Peta Rencana dan Peta Tematik Sektoral di wilayah Kabupaten Ogan Komering Ulu Timur yang terbuka untuk publik dan dimaksudkan untuk mewujudkan keterbukaan informasi bagi masyarakat;</li>
					<li><i class="fas fa-check"></i> Data yang tersedia disitus ini merupakan data yang sudah melalui standarisasi atribut berdasarkan Permen ATR/BPN Nomor 14 Tahun 2021 dan KUGI Versi 5;</li>
					<li><i class="fas fa-check"></i> Kelengkapan data yang disajikan sesuai dengan produk hukum yang berlaku dan “sebagaimana adanya” (as is);</li>
					<li><i class="fas fa-check"></i> Kami berusaha menyajikan data seakurat mungkin, apabila terjadi terdapat perbedaan maka kembali kepada produk hukum yang berlaku;</li>
					<li><i class="fas fa-check"></i> PUTR Kabupaten OKUT tidak bertanggungjawab atas segala kesalahan atau kerugian yang timbul karena tindakan yang berkaitan dengan penggunaan data/informasi yang disajikan pada situs ini;</li>
					<li><i class="fas fa-check"></i> PUTR Kabupaten OKUT tidak bertanggungjawab atas data/informasi yang disampaikan oleh pihak ketiga yang menggunakan service dari situs ini, dan berlaku sebaliknya (vice versa);</li>
					<li><i class="fas fa-check"></i> Dengan menggunakan situs ini, pengguna setuju dengan Syarat dan Ketentuan yang berlaku.</li>
				</ul>
				<input type="checkbox" id="toggle" />
				<span>Saya mengerti dan menyetujui penjelasan dan ketentuan di atas.</span>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-dark" id="lanjutkan" data-bs-dismiss="modal" disabled="true">Lanjutkan</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalSV" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-body" style="text-align: justify">
				<ul class="list list-icons list-primary">
					<li><i class="fas fa-street-view"></i> Silakan klik pada bagian peta untuk mengaktifkan street view.</li>
				</ul>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-dark" data-bs-dismiss="modal">Lanjutkan</button>
			</div>
		</div>
	</div>
</div>

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


	<!-- Vendor -->
	<script src="<?php echo base_url(); ?>assets/porto/vendor/jquery/jquery-3.7.1.min.js"></script>
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

<script>
	$('#toggle').click(function () {
		//check if checkbox is checked
		if ($(this).is(':checked')) {
			$('#lanjutkan').removeAttr('disabled'); //enable input
		} else {
			$('#lanjutkan').attr('disabled', true); //disable input
		}
	});
</script>

</body>
</html>
