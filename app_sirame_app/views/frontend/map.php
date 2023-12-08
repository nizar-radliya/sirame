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

	<style>
		html,
		body {
			height: 100%;
			margin: 0;
		}

		#map {
			width: 100%;
			height: 100%;
		}
	</style>

</head>

<body data-plugin-cursor-effect>
<div class="body">

	<div id="sidebar" class="leaflet-sidebar collapsed" style="height: 97%;">

		<!-- nav tabs -->
		<div class="leaflet-sidebar-tabs">
			<!-- top aligned tabs -->
			<ul role="tablist">
				<li><a href="#menu" role="tab"><i class="fa fa-bars active"></i></a></li>
				<li><a href="#layer" role="tab"><i class="fa fa-map"></i></a></li>
			</ul>

			<!-- bottom aligned tabs -->
			<ul role="tablist">
				<li><a href="#info" role="tab"><i class="fa fa-circle-info"></i></a></li>
			</ul>
		</div>

		<!-- panel content -->
		<div class="leaflet-sidebar-content">
			<div class="leaflet-sidebar-pane" id="menu">
				<h1 class="leaflet-sidebar-header">
					Sitaru Subang
					<span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
				</h1>
				<p style="margin-top: 10px">

					<a href="<?php echo base_url(); ?>main" class="btn btn-outline btn-rounded btn-tertiary  btn-with-arrow mb-2" style="width: 100%">Beranda<span><i class="fas fa-chevron-right"></i></span></a><br>
					<?php if (menus(1)) { ?>
					<a href="<?php echo base_url(); ?>peta" class="btn btn-outline btn-rounded btn-tertiary  btn-with-arrow mb-2" style="width: 100%">Peta<span><i class="fas fa-chevron-right"></i></span></a><br>
					<?php } ?>
					<?php if (menus(2)) { ?>
					<a href="<?php echo base_url(); ?>layanan" class="btn btn-outline btn-rounded btn-tertiary  btn-with-arrow mb-2" style="width: 100%">Surat Keterangan Rencana Ruang<span><i class="fas fa-chevron-right"></i></span></a><br>
					<?php } ?>
					<?php if (menus(3)) { ?>
					<a href="<?php echo base_url(); ?>layanan/rencana-tapak" class="btn btn-outline btn-rounded btn-tertiary  btn-with-arrow mb-2" style="width: 100%">Rencana Tapak / Site Plan<span><i class="fas fa-chevron-right"></i></span></a><br>
					<?php } ?>
					<?php if (menus(4)) { ?>
					<a href="<?php echo base_url(); ?>file" class="btn btn-outline btn-rounded btn-tertiary  btn-with-arrow mb-2" style="width: 100%">Download<span><i class="fas fa-chevron-right"></i></span></a><br>
					<?php } ?>
					<?php if (menus(5)) { ?>
					<a href="<?php echo base_url(); ?>pengumuman/publik" class="btn btn-outline btn-rounded btn-tertiary  btn-with-arrow mb-2" style="width: 100%">Pengumuman<span><i class="fas fa-chevron-right"></i></span></a><br>
					<?php } ?>
					<?php if (menus(6)) { ?>
					<a href="<?php echo base_url(); ?>log/sitaru" class="btn btn-outline btn-rounded btn-tertiary  btn-with-arrow mb-2" style="width: 100%">Login<span><i class="fas fa-chevron-right"></i></span></a>
					<?php } ?>

				</p>
			</div>

			<div class="leaflet-sidebar-pane" id="layer">
				<h1 class="leaflet-sidebar-header">
					Layer Peta
					<span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
				</h1>
				<div id="new-parent" style="padding-top: 10px">
				</div>
			</div>

			<div class="leaflet-sidebar-pane" id="info">
				<h1 class="leaflet-sidebar-header">
					Disclaimer
					<span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
				</h1>
				<p style="margin-top: 10px; text-align: justify">
					Setiap informasi yang dikelola unit pengelola dan penyebarluasan data serta ditampilkan pada Peta ini diberikan sebagaimana adanya dengan tetap memperhatikan ketentuan perlindungan informasi yang bersifat pribadi dan/atau bersifat rahasia, serta dengan pengertian bahwa unit pengelola dan penyebarluasan data tidak bertanggung jawab atau menjamin ketepatan waktu, keakuratan, atau kelengkapan informasi tersebut. Jika pengguna bermaksud mengandalkan informasi apa pun yang ditampilkan pada Peta ini, maka pengguna dapat mengajukan permohonan Pelayanan Informasi Publik PUPR Kabupaten Subang melalui email: pupr@subang.go.id. Apabila pengguna menemukan ketidaksesuaian informasi terkait letak, bentuk, posisi, serta informasi penjelasan lainnya maka pengguna dapat melakukan klarifikasi kepada unit produksi terkait data dan informasi dimaksud atau pengguna dapat menyampaikan informasi tersebut melalui layanan kirim pesan di web Sitaru Subang.
				</p>
			</div>
		</div>
	</div>

	<div id="map" style="margin-bottom: 50px; height: 715px;> <!-- ini id="map" bisa di ganti dengan nama yang di inginkan -->
	<script>
		// MENGATUR TITIK KOORDINAT TITIK TENGAH & LEVEL ZOOM PADA BASEMAP
		var map = L.map('map', {attributionControl: false}).setView([-6.502976, 107.744584], 10);
		var peta = new L.LayerGroup();
		var items = [];

		// MENAMPILKAN SKALA
		L.control.scale({imperial: false}).addTo(map);
		// ------------------- VECTOR ----------------------------

		tr_jalankab = new L.GeoJSON.AJAX("<?php echo base_url(); ?>assets/map/layer/tr_jalankab.php", {
			style: function (feature) {
				var linecolor, weight;
				linecolor = '#5788de';
				weight = 2;
				return {color: linecolor, weight: weight}; // Berikan efek trasparan pada bagian "fillOpacity" agar basemap dapat terlihat
			},
			onEachFeature: function (feature, layer) {
				var linecolor, weight;
				linecolor = '#5788de';
				weight = 4;
				items.push(layer); // ini dibuat untuk menghubungkan variabel items ke dalam layer, ini berfungsi untuk menjalankan tool pencarian
				//items.push(layer); // ini dibuat untuk menghubungkan variabel items ke dalam layer, ini berfungsi untuk menjalankan tool pencarian
				layer.bindTooltip("<center>" + feature.properties.nama + "</center>"),
					that = this;

				layer.on('mouseover', function (e) {
					this.setStyle({
						color: linecolor, weight: weight
					});

					if (!L.Browser.ie && !L.Browser.opera) {
						layer.bringToFront();
					}

					info.update(layer.feature.properties);
				});
				layer.on('mouseout', function (e) {
					tr_jalankab.resetStyle(e.target);
					info.update();
				});
				layer.on('click', function (e) {
					$("#myModalJalankab").modal('show');
					$.get('<?php echo base_url(); ?>peta/jalankab',
						{id: feature.properties.idjalankab},
						function (html) {
							$(".modal-body").html(html);
						}
					);
				});
			}
		}).addTo(peta); // layer peta fungsi tr_jalankab ini ditmbahkan ke dalam variabel 'peta'

		var tr_jalanlain = new L.GeoJSON.AJAX("<?php echo base_url(); ?>assets/map/layer/tr_jalanlain.php", {
			style: function (feature) {
				var linecolor, weight, idfungsi = feature.properties.nama;
				if (idfungsi == "Jalan Arteri") {
					linecolor = '#fc6f03';
					weight = 2;
				} else if (idfungsi == "Jalan Kolektor") {
					linecolor = '#fcc203';
					weight = 2;
				} else if (idfungsi == "Jalan Lokal") {
					linecolor = '#5788de';
					weight = 2;
				} else if (idfungsi == "Jalan Lain" || idfungsi == "Jalan Setapak") {
					linecolor = '#57de77';
					weight = 2;
				} else if (idfungsi == "Jalan Rencana") {
					linecolor = '#666666';
					weight = 2;
				} else {
					linecolor = '#000000';
					weight = 2;
				}
				return {color: linecolor, weight: weight}; // Berikan efek trasparan pada bagian "fillOpacity" agar basemap dapat terlihat
			},
			onEachFeature: function (feature, layer) {
				var linecolor, weight, idfungsi = feature.properties.nama;
				if (idfungsi == "Jalan Arteri") {
					linecolor = '#fc6f03';
					weight = 4;
				} else if (idfungsi == "Jalan Kolektor") {
					linecolor = '#fcc203';
					weight = 4;
				} else if (idfungsi == "Jalan Lokal") {
					linecolor = '#5788de';
					weight = 4;
				} else if (idfungsi == "Jalan Lain" || idfungsi == "Jalan Setapak") {
					linecolor = '#57de77';
					weight = 4;
				} else if (idfungsi == "Jalan Rencana") {
					linecolor = '#666666';
					weight = 4;
				} else {
					linecolor = '#000000';
					weight = 4;
				}
				items.push(layer); // ini dibuat untuk menghubungkan variabel items ke dalam layer, ini berfungsi untuk menjalankan tool pencarian
				//items.push(layer); // ini dibuat untuk menghubungkan variabel items ke dalam layer, ini berfungsi untuk menjalankan tool pencarian
				layer.bindTooltip("<center>" + feature.properties.nama + "</center>"),
					that = this;

				layer.on('mouseover', function (e) {
					this.setStyle({
						color: linecolor, weight: weight
					});

					if (!L.Browser.ie && !L.Browser.opera) {
						layer.bringToFront();
					}

					info.update(layer.feature.properties);
				});
				layer.on('mouseout', function (e) {
					tr_jalanlain.resetStyle(e.target);
					info.update();
				});
				layer.on('click', function (e) {
					$("#myModalJalanlain").modal('show');
					$.get('<?php echo base_url(); ?>peta/jalanlain',
						{id: feature.properties.idjalanlain},
						function (html) {
							$(".modal-body").html(html);
						}
					);
				});
			}
		}).addTo(peta); // layer peta fungsi jalan ini ditmbahkan ke dalam variabel 'peta'

		var polaruang = new L.GeoJSON.AJAX("<?php echo base_url(); ?>assets/map/layer/polaruang.php", {
			style: function (feature) {
				var fillColor, fungsi = feature.properties.nama;
				if (fungsi == 'Cagar Alam') {
					fillColor = '#9999ff';
				} else if (fungsi == 'Hutan Lindung') {
					fillColor = '#e0ffe6';
				} else if (fungsi == 'Hutan Produksi Terbatas') {
					fillColor = '#b3e6e6';
				} else if (fungsi == 'Hutan Produksi Tetap') {
					fillColor = '#99f2cc';
				} else if (fungsi == 'Kawasan Hankam') {
					fillColor = '#e64cff';
				} else if (fungsi == 'Kawasan Pantai Berhutan Bakau') {
					fillColor = '#e6d9ff';
				} else if (fungsi == 'Kawasan Perikanan Budidaya') {
					fillColor = '#73b2ff';
				} else if (fungsi == 'Kawasan Perkebunan') {
					fillColor = '#ccff80';
				} else if (fungsi == 'Kawasan Permukiman Perdesaan') {
					fillColor = '#ffcc4c';
				} else if (fungsi == 'Kawasan Permukiman Perkotaan') {
					fillColor = '#ffb340';
				} else if (fungsi == 'Kawasan Pertanian Lahan Basah') {
					fillColor = '#ccffb3';
				} else if (fungsi == 'Kawasan Pertanian Lahan Kering') {
					fillColor = '#d9ffe6';
				} else if (fungsi == 'Kawasan Peruntukkan Industri') {
					fillColor = '#e6e6b3';
				} else if (fungsi == 'Kawasan Peruntukkan Pertambangan') {
					fillColor = '#bfbfbf';
				} else if (fungsi == 'Kawasan Tangkapan Air Waduk') {
					fillColor = '#00ffff';
				} else if (fungsi == 'Kawasan Wisata') {
					fillColor = '#ffe6ff';
				} else if (fungsi == 'Danau') {
					fillColor = '#b8ffc7';
				} else if (fungsi == 'Taman Wisata Alam') {
					fillColor = '#ffccff';
				} else {
					fillColor = '#ffffff';
				}
				return {
					color: "#000000",
					dashArray: '1',
					weight: 1,
					fillColor: fillColor,
					fillOpacity: 0.7
				}; // Berikan efek trasparan pada bagian "fillOpacity" agar basemap dapat terlihat
			},
			onEachFeature: function (feature, layer) {
				items.push(layer); // ini dibuat untuk menghubungkan variabel items ke dalam layer, ini berfungsi untuk menjalankan tool pencarian
				layer.bindTooltip("<center>" + feature.properties.nama + "</center>"),
					that = this;

				layer.on('click', function (e) {
					$("#myModalPolaruang").modal('show');
					$.get('<?php echo base_url(); ?>peta/polaruang',
						{id: feature.properties.idpr},
						function (html) {
							$(".modal-body").html(html);
						}
					);
				});

				layer.on('mouseover', function (e) {
					if (!L.Browser.ie && !L.Browser.opera) {
						layer.bringToFront();
					}

					info.update(layer.feature.properties);
				});
				layer.on('mouseout', function (e) {
					info.update();
				});
				/*layer.on('click', function (e) {
					$("#myModalPolaruang").modal('show');
					$.get('<?php echo base_url(); ?>peta/polaruang',
												{id: feature.properties.idpr},
												function (html) {
													$(".modal-body").html(html);
												}
										);
									});*/
			}
		}).addTo(peta); // layer peta polaruang ini ditambahkan ke dalam variabel 'peta'

		var admkec = new L.GeoJSON.AJAX("<?php echo base_url(); ?>assets/map/layer/admkec.php", {
			style: function (feature) {
				var fillColor = feature.properties.color;
				return {
					color: "#000000",
					dashArray: '3 4 4',
					weight: 0.8,
					fillColor: fillColor,
					fillOpacity: 0
				}; // Berikan efek trasparan pada bagian "fillOpacity" agar basemap dapat terlihat
			},
			onEachFeature: function (feature, layer) {
				items.push(layer); // ini dibuat untuk menghubungkan variabel items ke dalam layer, ini berfungsi untuk menjalankan tool pencarian
				layer.bindPopup("<center>" + feature.properties.nama + "</center>"), // popup yang akan ditampilkan diambil dari filed nama
					that = this; // perintah agar menghasilkan efek hover pada idobjek layer

				layer.on('mouseover', function (e) {
					if (!L.Browser.ie && !L.Browser.opera) {
						layer.bringToBack();
					}

					info.update(layer.feature.properties);
				});
				layer.on('mouseout', function (e) {
					info.update();
				});
				layer.on('click', function (e) {
					$("#myModalFile").modal('show');
					$.get('<?php echo base_url(); ?>peta/file',
						{id: feature.properties.idkec},
						function (html) {
							$(".modal-body").html(html);
						}
					);
				});
			}
		}).addTo(peta); // layer peta administrasi kabupaten kota ini ditmbahkan ke dalam variabel 'peta'

		// MENAMBAHKAN TOOL PENCARIAN
		function sortNama(a, b) {
			var _a = a.feature.properties.nama; // nama field yang akan dijadikan acuan di dalam tool pencarian

			var _b = b.feature.properties.nama; // nama field yang akan dijadikan acuan di dalam tool pencarian

			if (_a < _b) {
				return -1;
			}
			if (_a > _b) {
				return 1;
			}
			return 0;
		}

		// MENAMBAHKAN TOOL PENCARIAN
		function sortNama(a, b) {
			var _a = a.feature.properties.nama; // nama field yang akan dijadikan acuan di dalam tool pencarian

			var _b = b.feature.properties.nama; // nama field yang akan dijadikan acuan di dalam tool pencarian

			if (_a < _b) {
				return -1;
			}
			if (_a > _b) {
				return 1;
			}
			return 0;
		}

		L.Control.Search = L.Control.extend({
			options: {
				// topright, topleft, bottomleft, bottomright
				position: 'topleft',
				placeholder: ' Pencarian ...'
			},
			initialize: function (options /*{ data: {...}  }*/) {
				// constructor
				L.Util.setOptions(this, options);
			},
			onAdd: function (map) {
				// happens after added to map
				var container = L.DomUtil.create('div', 'search-container');
				this.form = L.DomUtil.create('form', 'form', container);
				var group = L.DomUtil.create('div', 'form-group', this.form);
				this.input = L.DomUtil.create('input', 'form-control input-sm pencarian', group);
				this.input.type = 'text';
				this.input.placeholder = this.options.placeholder;
				this.results = L.DomUtil.create('div', 'list-group', group);
				L.DomEvent.addListener(this.input, 'keyup', _.debounce(this.keyup, 300), this);
				L.DomEvent.addListener(this.form, 'submit', this.submit, this);
				L.DomEvent.disableClickPropagation(container);
				return container;
			},
			onRemove: function (map) {
				// when removed
				L.DomEvent.removeListener(this._input, 'keyup', this.keyup, this);
				L.DomEvent.removeListener(form, 'submit', this.submit, this);
			},
			keyup: function (e) {
				if (e.keyCode === 38 || e.keyCode === 40) {
					// do nothing
				} else {
					this.results.innerHTML = '';
					if (this.input.value.length > 0) {
						var value = this.input.value;
						var results = _.take(_.filter(this.options.data, function (x) {
							if (x.feature.properties.nama != null) {
								return x.feature.properties.nama.toUpperCase().indexOf(value.toUpperCase()) > -1;
							}
						}).sort(sortNama), 10);
						_.map(results, function (x) {
							var a = L.DomUtil.create('a', 'list-group-item daftar');
							a.href = '';
							a.setAttribute('data-result-name', x.feature.properties.nama); // nama field yang akan dijadikan acuan di dalam tool pencarian

							a.innerHTML = x.feature.properties.nama; // nama field yang akan dijadikan acuan di dalam tool pencarian

							this.results.appendChild(a);
							L.DomEvent.addListener(a, 'click', this.itemSelected, this);
							return a;
						}, this);
					}
				}
			},
			itemSelected: function (e) {
				L.DomEvent.preventDefault(e);
				this._div = L.DomUtil.create('div', 'div-legend');
				var elem = e.target;
				var value = elem.innerHTML;
				this.input.value = elem.getAttribute('data-result-name');
				var feature = _.find(this.options.data, function (x) {
					return x.feature.properties.nama === this.input.value; // nama field yang akan dijadikan acuan di dalam tool pencarian
				}, this);
				if (feature) {
					var geo = feature.toGeoJSON();
					var tipe = geo.geometry.type;
					//alert(tipe);
					if (tipe == 'Polygon' || tipe == 'MultiPolygon') {
						this._map.fitBounds(feature.getBounds());
						feature.bindTooltip(geo.properties.nama).openTooltip();
					} else if (tipe == 'LineString' || tipe == 'MultiLineString') {
						this._map.fitBounds(feature.getBounds());
						feature.bindTooltip(geo.properties.nama).openTooltip();
					} else if (tipe == 'Point') {
						this._map.flyTo(feature._latlng, 20);
						feature.bindTooltip(geo.properties.nama).openTooltip();
					}
				}
				this.results.innerHTML = '';
			},
			submit: function (e) {
				L.DomEvent.preventDefault(e);
			}
		});

		L.control.search = function (id, options) {
			return new L.Control.Search(id, options);
		}
		L.control.search({
			data: items
		}).addTo(map);

		// menambahkan tools defautl extent
		L.control.defaultExtent().addTo(map);

		var baseLayers = {};

		// membuat pilihan untuk menampilkan layer
		var overlays = {
			"<span style='color: #3C8DBC; font-size: 14px'>BATAS ADMINISTRASI</span>": {
				"<img src='<?= base_url() ?>assets/map/legend/kec.png' width='103' style='margin-bottom:3px'><br><span style='margin-left: 18px'>Batas Administrasi Kecamatan</span>": admkec.addTo(map),
			},
			"<span style='color: #3C8DBC; font-size: 14px'>RENCANA TATA RUANG WILAYAH</span>": {
				"Pola Ruang<br><span style='font-size:12px'><img src='<?= base_url() ?>assets/map/legend/cagaralam.png' width='16' style='margin-left: 15px;'> Cagar Alam<br><img src='<?= base_url() ?>assets/map/legend/hl.png' width='16' style='margin-left: 15px;'> Hutan Lindung<br><img src='<?= base_url() ?>assets/map/legend/hpt.png' width='16' style='margin-left: 15px;'> Hutan Produksi Terbatas<br><img src='<?= base_url() ?>assets/map/legend/hp.png' width='16' style='margin-left: 15px;'> Hutan Produksi Tetap<br><img src='<?= base_url() ?>assets/map/legend/hankam.png' width='16' style='margin-left: 15px;'> Kawasan Hankam<br><img src='<?= base_url() ?>assets/map/legend/bakau.png' width='16' style='margin-left: 15px;'> Kawasan Pantai Berhutan Bakau<br><img src='<?= base_url() ?>assets/map/legend/perikanan.png' width='16' style='margin-left: 15px;'> Kawasan Perikanan Budidaya<br><img src='<?= base_url() ?>assets/map/legend/perkebunan.png' width='16' style='margin-left: 15px;'> Kawasan Perkebunan<br><img src='<?= base_url() ?>assets/map/legend/permukiman_desa.png' width='16' style='margin-left: 15px;'> Kawasan Permukiman Perdesaan<br><img src='<?= base_url() ?>assets/map/legend/permukiman_kota.png' width='16' style='margin-left: 15px;'> Kawasan Permukiman Perkotaan<br><img src='<?= base_url() ?>assets/map/legend/pertanian_basah.png' width='16' style='margin-left: 15px;'> Kawasan Pertanian Lahan Basah<br><img src='<?= base_url() ?>assets/map/legend/pertanian_kering.png' width='16' style='margin-left: 15px;'> Kawasan Pertanian Lahan Kering<br><img src='<?= base_url() ?>assets/map/legend/industri.png' width='16' style='margin-left: 15px;'> Kawasan Peruntukkan Industri<br><img src='<?= base_url() ?>assets/map/legend/tambang.png' width='16' style='margin-left: 15px;'> Kawasan Peruntukkan Pertambangan<br><img src='<?= base_url() ?>assets/map/legend/waduk.png' width='16' style='margin-left: 15px;'> Kawasan Tangkapan Air Waduk<br><img src='<?= base_url() ?>assets/map/legend/pariwisata.png' width='16' style='margin-left: 15px;'> Kawasan Wisata<br><img src='<?= base_url() ?>assets/map/legend/danau.png' width='16' style='margin-left: 15px;'> Danau<br><img src='<?= base_url() ?>assets/map/legend/wisata-alam.png' width='16' style='margin-left: 15px;'> Taman Wisata Alam</span>": polaruang.addTo(map),
			},
			"<span style='color: #3C8DBC; font-size: 14px'>SISTEM JARINGAN JALAN</span>": {
				"<span style='font-size:12px'><img src='<?= base_url() ?>assets/map/legend/lokal.png' width='50'> Jalan Kabupaten</span>": tr_jalankab.addTo(map),
				"Fungsi Jalan<br><span style='font-size:12px'><img src='<?= base_url() ?>assets/map/legend/arteri.png' width='50' style='margin-left: 15px;'> Arteri<br><img src='<?= base_url() ?>assets/map/legend/kolektor.png' width='50' style='margin-left: 15px;'> Kolektor<br><img src='<?= base_url() ?>assets/map/legend/lokal.png' width='50' style='margin-left: 15px;'> Lokal<br><img src='<?= base_url() ?>assets/map/legend/lingkungan.png' width='50' style='margin-left: 15px;'> Lingkungan<br><img src='<?= base_url() ?>assets/map/legend/rencana.png' width='50' style='margin-left: 15px;'> Rencana</span>": tr_jalanlain,
			}
		};

		var options = {
			exclusiveGroups: [""], //checkbox
			//exclusiveGroups: ["KOTA BANDUNG"] //for radio
			//position:'topleft'
			scrollbars: true,
			collapsed: false,
			autoZIndex: true
		};

		control = L.control.groupedLayers(baseLayers, overlays, {
			collapsed: false,
		}).addTo(map);

		var basemaps = [
			// google Street
			L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
				maxZoom: 20,
				subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
			}),
			// google hybrid
			L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
				maxZoom: 20,
				subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
			}),
			// google satelite
			L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
				maxZoom: 20,
				subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
			}),
			// google terain
			L.tileLayer('http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}', {
				maxZoom: 20,
				subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
			}),
		];
		map.addControl(
			L.control.basemaps({
				position: "bottomright",
				basemaps: basemaps,
				tileX: 0,
				tileY: 0,
				tileZ: 1
			})
		);

		// Call the getContainer routine.
		var htmlObject = control.getContainer();
		// Get the desired parent node.
		var a = document.getElementById('new-parent');

		// Finally append that node to the new parent, recursively searching out and re-parenting nodes.
		function setParent(el, newParent) {
			newParent.appendChild(el);
		}

		setParent(htmlObject, a);

		map.addControl(new L.Control.Fullscreen());

		var sidebar = L.control.sidebar({
			container: 'sidebar',
			position: 'left'
		})
			.addTo(map);

		var info = L.control({position:'topright'});
		info.onAdd = function (map) {
			this._div = L.DomUtil.create('div', 'div-info');
			this.update();
			return this._div;
		};
		info.update = function (props) {
			if (props != undefined) {
				if (props.idpr != undefined) {
					this._div.innerHTML = '<h4 style="font-style: italic; text-align: center; margin-bottom: 10px">Pola Ruang</h4>' + (props ?
						'<table class="table table-bordered" style="text-align: justify; margin: 0;">' +
						'<tr><th style="padding: 2px 0">Sub Zona</th><td style="padding: 2px">:</td><td style="padding: 2px">' + props.nama + '</td></tr>' +
						'<tr><th style="padding: 2px 0">Kawasan</th><td style="padding: 2px">:</td><td style="padding: 2px">' + props.kawasan + '</td></tr>' +
						'</table>'
						: '');
				} else if (props.id != undefined) {
					this._div.innerHTML = '<h4 style="font-style: italic; text-align: center; margin-bottom: 10px">Infrastruktur Transportasi: Jalan</h4>' + (props ?
						'<table class="table table-bordered" style="text-align: justify; margin: 0;">' +
						'<tr><th style="padding: 2px 0">Nama Fasilitas</th><td style="padding: 2px">:</td><td style="padding: 2px">' + props.nama + '</td></tr>' +
						'<tr><th style="padding: 2px 0">Kecamatan</th><td style="padding: 2px">:</td><td style="padding: 2px">' + props.kecamatan + '</td></tr>' +
						'<tr><th style="padding: 2px 0">Kelurahan</th><td style="padding: 2px">:</td><td style="padding: 2px">' + props.kelurahan + '</td></tr>' +
						'</table>'
						: '');
				} else {
					this._div.innerHTML = '<h4 style="font-style: italic; text-align: center; margin-bottom: 10px">Informasi Peta</h4>' + (props ?
						'<b>' + props.nama + '</b>'
						: '');
				}
			} else {
				this._div.innerHTML = '<h4 style="font-style: italic; text-align: center">Arahkan Kursor Pada Peta</h4>';
			}
		};
		info.addTo(map);
	</script>
</div>

<div class="modal fade" id="myModalPolaruang" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><i class="icon fa fa-layer-group"></i> RTRW: Pola Ruang</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="myModalJalankab" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><i class="icon fa fa-road"></i> Transportasi: Jalan Kabupaten</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="myModalJalanlain" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><i class="icon fa fa-road"></i> Transportasi: Jalan</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->


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

</body>
</html>
