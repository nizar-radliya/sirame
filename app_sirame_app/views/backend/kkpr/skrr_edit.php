<?php
/**
 * Title:   MySQL to GeoJSON (Requires https://github.com/phayes/geoPHP)
 * Notes:   Query a MySQL table or view and return the results in GeoJSON format, suitable for use in OpenLayers, Leaflet, etc.
 * Author:  Bryan R. McBride, GISP
 * Contact: bryanmcbride.com
 * GitHub:  https://github.com/bmcbride/PHP-Database-GeoJSON
 */

# Include required geoPHP library and define wkb_to_json function
include('./assets/map/geoPHP/geoPHP.inc');
function wkb_to_json($wkb) {
	$geom = geoPHP::load($wkb,'wkb');
	return $geom->out('json');
}

# Connect to MySQL database
include('./assets/map/condb.php');

# Build SQL SELECT statement and return the geometry as a WKB element
$sql = 'SELECT *, AsWKB(SHAPE) AS wkb, ST_AsText(ST_GeomFromWKB(SHAPE)) AS point, ST_AsText(ST_Centroid(SHAPE)) AS center, X(SHAPE) AS lng, Y(SHAPE) AS lat FROM skrr WHERE kodeskrr = "'.$skrr[0]->kodeskrr.'"';

# Try query or error
$rs = $conn->query($sql);
if (!$rs) {
	echo 'An SQL error occured.\n';
	exit;
}

# Build GeoJSON feature collection array
$geojson = array(
		'type'      => 'FeatureCollection',
		'features'  => array()
);

# Loop through rows to build feature arrays
while ($row = $rs->fetch(PDO::FETCH_ASSOC)) {
	$properties = $row;
	# Remove wkb and geometry fields from properties
	unset($properties['wkb']);
	unset($properties['SHAPE']);
	$feature = array(
			'type' => 'Feature',
			'geometry' => json_decode(wkb_to_json($row['wkb'])),
			'properties' => $properties
	);
	# Add feature arrays to feature collection array
	array_push($geojson['features'], $feature);

	$point = $row['point'];
	/*$lat = substr($point, strpos($point, "(") + 1,11);
	$lng = substr_replace(substr($point, strpos($point, " ") + 1,11),"", -1);*/
	if (substr($point,0,3) == 'POL') {
		$center = $row['center'];
		$lng = substr($center, strpos($center, "(") + 1,11);
		$lat = substr_replace(substr($center, strpos($center, " ") + 1,11),"", -1);
	} else {
		$lng = $row['lng'];
		$lat = $row['lat'];
	}
}

$layer = json_encode($geojson, JSON_NUMERIC_CHECK);

$conn = NULL;
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content" style="height: 100%; padding: 0 10px;">
		<div class="row">
			<div class="col-md-8" style="padding: 0;height: 615px;border-right: 1px #999999 solid">

				<div id="map">
					<script>
						// MENGATUR TITIK KOORDINAT TITIK TENGAH & LEVEL ZOOM PADA BASEMAP
						var geojsonFeatures = <?php echo json_encode($geojson, JSON_NUMERIC_CHECK); ?>;

						var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
								osmAttrib = '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors',
								osm = L.tileLayer(osmUrl, {maxZoom: 20, attribution: osmAttrib}),
								map = new L.Map('map', {attributionControl: false, center: new L.LatLng(<?= $lat ?>, <?= $lng ?>), zoom: 20}),
								drawnItems = L.featureGroup().addTo(map),
								peta = new L.LayerGroup();

						var items = [];

						// MENAMPILKAN SKALA
						L.control.scale({imperial: false}).addTo(map);
						// ------------------- VECTOR ----------------------------

						function locateUser() {
							map.locate({setView: true, watch: true}) /* This will return map so you can do chaining */
								.on('locationfound', function(e){
									var marker = L.marker([e.latitude, e.longitude]).bindPopup('Lokasi anda saat ini.');
									var circle = L.circle([e.latitude, e.longitude], e.accuracy/2, {
										weight: 1,
										color: 'blue',
										fillColor: '#cacaca',
										fillOpacity: 0.2
									});
									map.addLayer(marker);
									map.addLayer(circle);
								})
								.on('locationerror', function(e){
									console.log(e);
									alert("Location access denied.");
								});
						}

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

						// PILIHAN BASEMAP YANG AKAN DITAMPILKAN
						var googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
							maxZoom: 20,
							subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
						});

						var googleHybrid = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
							maxZoom: 20,
							subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
						});

						var googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
							maxZoom: 20,
							subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
						});

						var googleTerrain = L.tileLayer('http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}', {
							maxZoom: 20,
							subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
						});
						var baseLayers = {
							"Google Street": googleStreets.addTo(map),
							"Google Satellite": googleSat,
							"Google Hybrid": googleHybrid,
							"Google Terrain": googleTerrain
						};

						// membuat pilihan untuk menampilkan layer
						var overlays = {
							"<span style='color: #3C8DBC; font-size: 14px'>BATAS ADMINISTRASI</span>": {
								"<img src='<?= base_url() ?>assets/map/legend/kec.png' width='103' style='margin-bottom:3px'><br><span style='margin-left: 18px'>Batas Administrasi Kecamatan</span>": admkec.addTo(map),
							},
							"<span style='color: #3C8DBC; font-size: 14px'>RENCANA TATA RUANG WILAYAH</span>": {
								"Pola Ruang<br><span style='font-size:12px'><img src='<?= base_url() ?>assets/map/legend/cagaralam.png' width='16' style='margin-left: 15px;'> Cagar Alam<br><img src='<?= base_url() ?>assets/map/legend/hl.png' width='16' style='margin-left: 15px;'> Hutan Lindung<br><img src='<?= base_url() ?>assets/map/legend/hpt.png' width='16' style='margin-left: 15px;'> Hutan Produksi Terbatas<br><img src='<?= base_url() ?>assets/map/legend/hp.png' width='16' style='margin-left: 15px;'> Hutan Produksi Tetap<br><img src='<?= base_url() ?>assets/map/legend/hankam.png' width='16' style='margin-left: 15px;'> Kawasan Hankam<br><img src='<?= base_url() ?>assets/map/legend/bakau.png' width='16' style='margin-left: 15px;'> Kawasan Pantai Berhutan Bakau<br><img src='<?= base_url() ?>assets/map/legend/perikanan.png' width='16' style='margin-left: 15px;'> Kawasan Perikanan Budidaya<br><img src='<?= base_url() ?>assets/map/legend/perkebunan.png' width='16' style='margin-left: 15px;'> Kawasan Perkebunan<br><img src='<?= base_url() ?>assets/map/legend/permukiman_desa.png' width='16' style='margin-left: 15px;'> Kawasan Permukiman Perdesaan<br><img src='<?= base_url() ?>assets/map/legend/permukiman_kota.png' width='16' style='margin-left: 15px;'> Kawasan Permukiman Perkotaan<br><img src='<?= base_url() ?>assets/map/legend/pertanian_basah.png' width='16' style='margin-left: 15px;'> Kawasan Pertanian Lahan Basah<br><img src='<?= base_url() ?>assets/map/legend/pertanian_kering.png' width='16' style='margin-left: 15px;'> Kawasan Pertanian Lahan Kering<br><img src='<?= base_url() ?>assets/map/legend/industri.png' width='16' style='margin-left: 15px;'> Kawasan Peruntukkan Industri<br><img src='<?= base_url() ?>assets/map/legend/tambang.png' width='16' style='margin-left: 15px;'> Kawasan Peruntukkan Pertambangan<br><img src='<?= base_url() ?>assets/map/legend/waduk.png' width='16' style='margin-left: 15px;'> Kawasan Tangkapan Air Waduk<br><img src='<?= base_url() ?>assets/map/legend/pariwisata.png' width='16' style='margin-left: 15px;'> Kawasan Wisata<br><img src='<?= base_url() ?>assets/map/legend/danau.png' width='16' style='margin-left: 15px;'> Danau<br><img src='<?= base_url() ?>assets/map/legend/wisata-alam.png' width='16' style='margin-left: 15px;'> Taman Wisata Alam</span>": polaruang.addTo(map),
							}
						};
						var options = {
							exclusiveGroups: [""], //checkbox
							//exclusiveGroups: ["KOTA BANDUNG"] //for radio
							//position:'topleft'
						};

						// MENAMPILKAN TOOLS UNTUK MEMILIH BASEMAP
						L.control.groupedLayers(baseLayers, overlays, options).addTo(map);

						map.addControl(new L.Control.Fullscreen());

						map.addControl(new L.Control.Draw({
							edit: {
								featureGroup: drawnItems,
								marker: {
									allowIntersection: true
								},
								poly: {
									allowIntersection: true
								},
								remove: false
							},
							draw: {
								polygon : false,
								rectangle : false,
								circle : false,
								circlemarker : false,
								marker : false,
								polyline: false
							}
						}));

						map.on(L.Draw.Event.CREATED, function (event) {
							/*var layer = event.layer;
							drawnItems.addLayer(layer);*/

							var type = event.layerType;
							var layer = event.layer;

							drawnItems.addLayer(layer);

							var shape = layer.toGeoJSON();
							var shape_for_db = JSON.stringify(shape);
							var type = JSON.stringify(shape.geometry.type);
							var coordinates = JSON.stringify(shape.geometry.coordinates);
							var remove_sb = coordinates.replace(/[\[\]']+/g, '');
							var remove_co = remove_sb.replace(/,/g, " ");
							var remove_sp = remove_co.replace(/ 10/g, " 10");
							document.getElementById("SHAPE").value = type.replace(/['"]+/g, '') + "(" + remove_sp + ")";

							var xlng = coordinates.substring(
									coordinates.lastIndexOf("[") + 1,
									coordinates.lastIndexOf(",")
							);
							document.getElementById("lng").value = xlng;
							var ylat = coordinates.substring(
									coordinates.lastIndexOf(",") + 1,
									coordinates.lastIndexOf("]")
							);
							document.getElementById("lat").value = ylat;

						});

						map.on(L.Draw.Event.DELETED, function (event) {
							document.getElementById("SHAPE").value = "";
							document.getElementById("lng").value = "";
							document.getElementById("lat").value = "";
						});

						map.on(L.Draw.Event.EDITED, function (e) {
							var layers = e.layers;
							layers.eachLayer(function (layer) {
								if (layer instanceof L.Marker) {
									var shape = layer.toGeoJSON();
									var type = JSON.stringify(shape.geometry.type);
									var coordinates = JSON.stringify(shape.geometry.coordinates);
									var remove_sb = coordinates.replace(/[\[\]']+/g, '');
									var remove_co = remove_sb.replace(/,/g, " ");
									var remove_sp = remove_co.replace(/ 10/g, " 10");
									document.getElementById("SHAPE").value = type.replace(/['"]+/g, '') + "(" + remove_sp + ")";

									var xlng = coordinates.substring(
											coordinates.lastIndexOf("[") + 1,
											coordinates.lastIndexOf(",")
									);
									document.getElementById("lng").value = xlng;
									var ylat = coordinates.substring(
											coordinates.lastIndexOf(",") + 1,
											coordinates.lastIndexOf("]")
									);
									document.getElementById("lat").value = ylat;
								} else if (layer instanceof L.Polygon) {
									var shape = layer.toGeoJSON();
									var type = JSON.stringify(shape.geometry.type);
									var coordinates = JSON.stringify(shape.geometry.coordinates);
									var remove_sb = coordinates.replace(/[\[\]']+/g, '');
									var remove_co = remove_sb.replace(/,/g, " ");
									var remove_sp = remove_co.replace(/ 10/g, ", 10");
									document.getElementById("SHAPE").value = type.replace(/['"]+/g, '') + "((" + remove_sp + "))";
									var xlng = coordinates.substring(
											coordinates.lastIndexOf("[") + 1,
											coordinates.lastIndexOf(",")
									);
									document.getElementById("lng").value = xlng;
									var ylat = coordinates.substring(
											coordinates.lastIndexOf(",") + 1,
											coordinates.lastIndexOf("]]]")
									);
									document.getElementById("lat").value = ylat;
								}
							});
						});

						L.geoJson(geojsonFeatures, {
							onEachFeature: onEachFeature
						});

						function onEachFeature(feature, layer) {
							drawnItems.addLayer(layer);
						}

						var info = L.control({position:'bottomright'});
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
			</div>
			<div class="col-md-4" style="padding: 0 5px;height: 615px; background: #FFFFFF; overflow-x: hidden; overflow-y: scroll;">
				<section class="content-header">
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url(); ?>skrr"><i class="fa fa-file-text-o"></i>Pengaduan</li></a></li>
						<li class="active"><i class="fa fa-edit"></i> Ubah Pengajuan</li>
					</ol>
				</section>
				<form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>skrr/edit">
					<table class="table table-bordered" style="margin-bottom: 0">
						<tr>
							<td colspan="2">
								<label>Kordinat</label>
								<textarea required name="SHAPE" id="SHAPE" class="form-control" rows="4" style="resize: none" placeholder="Point(Latitude(x) Longitude(y))"><?php echo empty($point) ? "" : $point; ?></textarea>
							</td>
						</tr>
						<?php if ($this->session->flashdata('success')) { ?>
							<tr>
								<td colspan="2">
									<div class="alert alert-success alert-dismissible" style="margin-bottom: 0">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
											&times;
										</button>
										<h4><i class="icon fa fa-check"></i>Berhasil!</h4>
										<?php echo $this->session->flashdata('success'); ?>
									</div>
								</td>
							</tr>
						<?php } ?>
						<?php if ($this->session->flashdata('error')) { ?>
							<tr>
								<td colspan="2">
									<div class="alert alert-warning alert-dismissible">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
											&times;
										</button>
										<h4><i class="icon fa fa-ban"></i>Peringatan!</h4>
										<?php echo $this->session->flashdata('error'); ?>
									</div>
								</td>
							</tr>
						<?php } ?>
						<tr>
							<td>
								<label>Longitude (X)</label>
								<input type="text" class="form-control" value="<?= $skrr[0]->lng ?>" name="lng" id="lng" required placeholder="Longitude (X)">
								<input type="hidden" class="form-control" value="<?= $skrr[0]->kodeskrr ?>" name="kodeskrr" required>
							</td>
							<td>
								<label>Latitude (Y)</label>
								<input type="text" class="form-control" value="<?= $skrr[0]->lat ?>" name="lat" id="lat" required placeholder="Latitude (Y)">
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<a href="#" class="zoom-map">
									<button type="button" class="btn btn-block btn-default btn-xs">Zoom Titik Koordinat</button>
								</a>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<a href="#" class="zoom-loc">
									<button type="button" class="btn btn-block btn-default btn-xs">Zoom Lokasi Sekarang</button>
								</a>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<label>Atas Nama</label>
								<input type="text" class="form-control" name="atasnama" value="<?= $skrr[0]->atasnama ?>" placeholder="Atas Nama">
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<label>Jenis Permohonan</label>
								<select class="form-control" name="jenis" required>
									<option value="" disabled selected>Pilih Jenis Permohonan</option>
									<?php foreach ($jenis as $i) { ?>
										<?php if ($i == $skrr[0]->jenis) { ?>
											<option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
										<?php } else { ?>
											<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
										<?php } } ?>
								</select>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<label>Kategori Permohonan</label>
								<select class="form-control" name="kategori" id="kategori" onchange="namaperusahaan(this.value)" required>
									<option value="" disabled selected>Pilih Kategori Pemohon</option>
									<?php foreach ($kategori as $i) { ?>
										<?php if ($i == $skrr[0]->kategori) { ?>
											<option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
										<?php } else { ?>
											<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
										<?php } } ?>
								</select>
								<input type="text" class="form-control" name="perusahaan" id="perusahaan" value="<?= $skrr[0]->perusahaan ?>" placeholder="Nama Perusahaan" <?php if ($skrr[0]->kategori != 'Perusahaan') { ?>style="display: none" <?php } ?>>
								<input type="text" class="form-control" name="nib" id="nib" value="<?= $skrr[0]->nib ?>" placeholder="NIB" <?php if ($skrr[0]->kategori != 'Perusahaan') { ?>style="display: none" <?php } ?>>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<label>Alamat Lokasi Terkait Pengaduan</label>
								<input type="text" class="form-control" value="<?= $skrr[0]->alamatskrr ?>" name="alamatskrr" required>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<label>Kecamatan</label>
								<select class="form-control select2" name="id_kec" id="kec" required>
									<option disabled selected value="">Pilih Kecamatan</option>
									<?php
									foreach ($kecamatan as $kec) {
										if ($skrr[0]->id_kec == $kec->id_kec) {
											echo '<option value="' . $kec->id_kec . '" selected>' . $kec->nama_kec . '</option>';
										} else {
											echo '<option value="' . $kec->id_kec . '">' . $kec->nama_kec . '</option>';
										}
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<label>Kelurahan/Desa</label>
								<select class="form-control select2" name="id_kel" id="kel" required>
									<option disabled selected value="">Pilih Kelurahan</option>
									<?php foreach (readkelbykec($skrr[0]->id_kec) as $kel) { ?>
										<?php if ($kel->id_kel == $skrr[0]->id_kel) { ?>
											<option value='<?= $kel->id_kel ?>' selected><?= $kel->nama; ?></option>
										<?php } else { ?>
											<option value='<?= $kel->id_kel ?>'><?= $kel->nama; ?></option>
										<?php } ?>
									<?php } ?>
								</select>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<label>Peruntukan / Rencana Kegiatan</label>
								<input type="text" class="form-control" value="<?= $skrr[0]->alamatskrr ?>" name="peruntukan" placeholder="Peruntukan / Rencana Kegiatan" required>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<label>Luas Tanah Keseluruhan (m2)</label>
								<input type="number" class="form-control" value="<?= $skrr[0]->luastanah ?>" name="luastanah" placeholder="Luas Tanah Keseluruhan (m2)" required>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<label>Luas Tanah yang Dimohon (m2)</label>
								<input type="number" class="form-control" value="<?= $skrr[0]->luastanahdimohon ?>" name="luastanahdimohon" placeholder="Luas Tanah yang Dimohon (m2)" required>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<label>Bukti Penguasaan Tanah</label>
								<input type="text" class="form-control" value="<?= $skrr[0]->buktipenguasaantanah ?>" name="buktipenguasaantanah" placeholder="Bukti Penguasaan Tanah" required>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<button type="submit" class="btn btn-warning" id="save">
									<span class="fa fa-save" style="margin-right: 5px"></span>
									Simpan
								</button>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</section>
	<div style="clear:both;"></div>
</div>
<!-- /.content-wrapper -->

<div style="clear:both;"></div>

<div id="myModalPerkotaan" class="modal fade modal-success" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="icon fa fa-building-o"></i> Sistem Perkotaan</h4>
			</div>
			<div class="modal-body">
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div id="myModalTransportasiSarana" class="modal fade modal-success" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="icon fa fa-plane"></i> Sistem Jaringan Sarana Transportasi</h4>
			</div>
			<div class="modal-body">
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div id="myModalPembangkit" class="modal fade modal-success" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="icon fa fa-flash"></i> Sistem Jaringan Energi: Pembangkit Listrik & Gardu</h4>
			</div>
			<div class="modal-body">
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div id="myModalSda" class="modal fade modal-success" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="icon fa fa-flash"></i> Sistem Jaringan SDA</h4>
			</div>
			<div class="modal-body">
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div id="myModalStrategis" class="modal fade modal-warning" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="icon fa fa-map"></i> Kawasan Strategis</h4>
			</div>
			<div class="modal-body">
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div id="myModal" class="modal fade modal-success" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="icon fa fa-map-signs"></i> Sistem Jaringan Transportasi: Jalan</h4>
			</div>
			<div class="modal-body">
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
	function namaperusahaan(val)
	{
		if(val==="Perusahaan") {
			document.getElementById('perusahaan').style.display = 'block';
			document.getElementById('perusahaan').setAttribute("required", "required");
		}
		else
			document.getElementById('perusahaan').style.display='none';
			document.getElementById("perusahaan").required = false;
	}

	function namapemanfaatan(val)
	{
		if(val==="lainnya") {
			document.getElementById('pemanfaatan').style.display = 'block';
			document.getElementById('pemanfaatan').setAttribute("required", "required");
		}
		else
			document.getElementById('pemanfaatan').style.display='none';
			document.getElementById("pemanfaatan").required = false;
	}

	function surat(val)
	{
		if(val==="Investasi") {
			document.getElementById('nosurat').style.display = 'block';
			document.getElementById('nosurat').setAttribute("required", "required");
			document.getElementById('tglsurat').style.display = 'block';
			document.getElementById('tglsurat').setAttribute("required", "required");
		}
		else {
			document.getElementById('nosurat').style.display = 'none';
			document.getElementById("nosurat").required = false;
			document.getElementById('tglsurat').style.display = 'none';
			document.getElementById("tglsurat").required = false;
		}
	}
</script>

<script>
	$(document).ready(function () {
		$("#kec").change(function () {
			var url = "<?php echo site_url('skrr/add_ajax_kel');?>/" + $(this).val();
			$('#kel').load(url);
			return false;
		})
	});
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
			document.getElementById('SHAPE').value='Point('+lng+' '+lat+')' ;
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
