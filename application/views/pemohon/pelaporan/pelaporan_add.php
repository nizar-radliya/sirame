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
$sql = 'SELECT *, AsWKB(SHAPE) AS wkb, ST_AsText(ST_GeomFromWKB(SHAPE)) AS point, ST_AsText(ST_Centroid(SHAPE)) AS center, X(SHAPE) AS lng, Y(SHAPE) AS lat FROM kkpr_peta WHERE nomor = "'.$kkpr[0]->nomor.'"';

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
	if (substr($point,0,3) == 'POL' || substr($point,0,3) == 'MUL') {
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
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Pelaporan PKKPR
			<small><?= webname() ?></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>pelaporan"><i class="fa fa-calendar-check-o"></i>Pelaporan PKKPR</li></a></li>
			<li><a href="<?php echo base_url(); ?>pelaporan/detil/<?= $kkpr[0]->nomor ?>"><i class="fa fa-binoculars"></i>Data</li></a></li>
			<li class="active"><i class="fa fa-plus"></i> Tambah</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="box box-success" style="margin-bottom: 0">
					<div class="box-header with-border">

						<select class="form-control select2" name="" id="iddi" style="width: auto" onchange="javascript:location.href = this.value;">
							<option disabled>Nomor PKKPR</option>
							<?php foreach ($noreg as $field) { ?>
								<?php if ($field->nomor == $kkpr[0]->nomor) { ?>
									<option value="<?php echo base_url(); ?>pelaporan/form-add/<?= $field->nomor; ?>" selected><?= $field->nomor; ?></option>
								<?php } else { ?>
									<option value="<?php echo base_url(); ?>pelaporan/form-add/<?= $field->nomor; ?>"><?= $field->nomor; ?></option>
								<?php } } ?>
						</select>
					</div>
					<div class="box-body">
						<div class="col-sm-12" style="padding: 0; overflow-x: scroll; overflow-y: hidden;">
							<?php if($this->session->flashdata('error')) { ?>
								<div class="alert alert-warning alert-dismissible">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-ban"></i>Peringatan!</h4>
									<?php echo $this->session->flashdata('error'); ?>
								</div>
							<?php } else if ($this->session->flashdata('success')) { ?>
								<div class="alert alert-success alert-dismissible">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-check"></i>Berhasil!</h4>
									<?php echo $this->session->flashdata('success'); ?>
								</div>
							<?php } ?>

							<form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>pelaporan/add">
								<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
								<table class="table table-bordered" style="margin-bottom: 0">
									<tr>
										<th colspan="2" style="text-align: center; background-color: #0D340D; color: #ffffff;"><h4 class="text-bold">Formulir Pelaporan PKKPR</h4></th>
									</tr>
									<tr>
										<td width="50%">
											<label>Jenis Dokumen</label>
											<select class="form-control" name="jenisdok" required>
												<option value="" disabled selected>Pilih Jenis Dokumen</option>
												<?php foreach ($jenisdok as $i) { ?>
													<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
												<?php } ?>
											</select>
											<input type="hidden" name="nomor" value="<?= $kkpr[0]->nomor ?>">
											<input type="hidden" name="idpemohon" value="<?= $kkpr[0]->idpemohon ?>">
										</td>
										<td width="50%">
											<label>Hasil Scan Dokumen</label>
											<input type="file" id="exampleInputFile" name="filepelaporan" required>
										</td>
									</tr>
									<tr>
										<td>
											<label>Nomor Dokumen</label>
											<input type="text" class="form-control" name="nomordok" required>
										</td>
										<td>
											<label>Tanggal Dokumen</label>
											<input type="date" class="form-control" name="tgldok" required>
										</td>
									</tr>
									<tr>
										<td>
											<label>Luas Tanah m2 (sesuai dokumen)</label>
											<input type="number" class="form-control" name="luasrealisasi" max="<?= $kkpr[0]->luasdisetujui ?>" required>
										</td>
										<td>
											<label>Nama Pejabat (sesuai dokumen)</label>
											<input type="text" class="form-control" name="pejabat" required>
										</td>
									</tr>
									</tr>
									<tr>
										<td>
											<label>Catatan Pelaporan PKKPR</label>
											<textarea id="editor1" name="catatan" required></textarea>
										</td>
										<td>
											<label>Sketsa Lokasi</label>
											<textarea required name="SHAPE" id="SHAPE" class="form-control" rows="4" style="resize: none" placeholder="Format untuk Polygon: Polygon((Longitude(x) Latitude(y), Longitude(x) Latitude(y), dan seterusnya))"></textarea>
											<br>
											<div id="map" style="padding: 0; height: 325px; width: 100%; border: 2px solid #C2C2C2; border-radius: 5px; margin: 0 auto"> <!-- ini id="map" bisa di ganti dengan nama yang di inginkan -->
												<?php $legend=''; foreach ($rtrw_kabbekasi_pr_ar as $field) { ?>
													<?php $legend.= "<div><div class='boxlegend' style='background-color: rgb(".$field->r.",".$field->g.",".$field->b.")'></div><span style='font-size:12px;'>".$field->namobj."</span></div><br style='display: block; content: ''; margin-bottom: 0em;'>"; ?>
												<?php } ?>
												<script>
													var geojsonFeatures = <?php echo json_encode($geojson, JSON_NUMERIC_CHECK); ?>;

													var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
														osmAttrib = '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors',
														osm = L.tileLayer(osmUrl, {maxZoom: 20, attribution: osmAttrib}),
														map = new L.Map('map', {attributionControl: false, center: new L.LatLng(<?= $lat ?>, <?= $lng ?>), zoom: 15}),
														drawnPkkpr = L.featureGroup().addTo(map),
														drawnItems = L.featureGroup().addTo(map),
														peta = new L.LayerGroup();

													var items = [];

													// MENAMPILKAN SKALA
													L.control.scale({imperial: false}).addTo(map);
													// ------------------- VECTOR ----------------------------

													var rtrw_kabbekasi_pr_ar = new L.GeoJSON.AJAX("<?php echo base_url(); ?>assets/map/layer/rtrw_kabbekasi_pr_ar.php", {
														style: function (feature) {
															var fillColor;
															fillColor = 'rgb('+feature.properties.r+','+feature.properties.g+','+feature.properties.b+')';
															return {
																color: fillColor,
																dashArray: '1',
																weight: 1,
																fillColor: fillColor,
																fillOpacity: 0.6
															}; // Berikan efek trasparan pada bagian "fillOpacity" agar basemap dapat terlihat
														},
														onEachFeature: function (feature, layer) {
															items.push(layer); // ini dibuat untuk menghubungkan variabel items ke dalam layer, ini berfungsi untuk menjalankan tool pencarian
															/*layer.bindTooltip("<center>" + feature.properties.namobj + "</center>"),
																that = this;*/
															var customPopup =
																"<table id='tabletip'>" +
																"<tr><td>Kawasan</td>" +
																"<td>" + feature.properties.namobj + "</td></tr>" +
																"</table>";
															// specify popup options
															var customOptions =
																{
																	'maxWidth': '500',
																	'className' : 'custom5'
																};
															layer.bindPopup(customPopup,customOptions), // popup yang akan ditampilkan diambil dari filed nama
																that = this; // perintah agar menghasilkan efek hover pada objek layer

															layer.on('mouseover', function (e) {
																if (!L.Browser.ie && !L.Browser.opera) {
																	layer.bringToBack();
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
													}).addTo(peta); // layer peta rtrw_kabbekasi_pr_ar ini ditmbahkan ke dalam variabel 'peta'

													var batas_kecamatan_ar = new L.GeoJSON.AJAX("<?php echo base_url(); ?>assets/map/layer/batas_kecamatan_ar.php", {
														style: function (feature) {
															var linecolor, weight, opacity;
															linecolor = '#000000';
															weight = 1;
															opacity = 0;
															return {color: linecolor, weight: weight, dashArray: '3 4 4', fillOpacity: opacity}; // Berikan efek trasparan pada bagian "fillOpacity" agar basemap dapat terlihat
														},
														onEachFeature: function (feature, layer) {
															var linecolor, weight;
															linecolor = '#000000';
															weight = 2;
															items.push(layer); // ini dibuat untuk menghubungkan variabel items ke dalam layer, ini berfungsi untuk menjalankan tool pencarian
															//items.push(layer); // ini dibuat untuk menghubungkan variabel items ke dalam layer, ini berfungsi untuk menjalankan tool pencarian
															/*layer.bindTooltip("<center>" + feature.properties.namobj + "</center>"),
																that = this;*/

															layer.on('mouseover', function (e) {
																this.setStyle({
																	color: linecolor, weight: weight
																});

																if (!L.Browser.ie && !L.Browser.opera) {
																	layer.bringToBack();
																}

																info.update(layer.feature.properties);
															});
															layer.on('mouseout', function (e) {
																batas_kecamatan_ar.resetStyle(e.target);
																info.update();
															});
														}
													}).addTo(peta); // layer peta batas_kecamatan_ar ini ditambahkan ke dalam variabel 'peta'

													var kkpr_pelaporan = new L.GeoJSON.AJAX("<?php echo base_url(); ?>assets/map/layer/kkpr_pelaporan.php", {
														style: function (feature) {
															var nomor = feature.properties.nomor;
															var statuslaporan = feature.properties.statuslaporan;
															var fillcolor;
															if (nomor == <?= $kkpr[0]->nomor; ?> && (statuslaporan == 'MENUNGGU VERIFIKASI' || statuslaporan == 'PELAPORAN DITERIMA')) {
																if (statuslaporan == 'PELAPORAN DITERIMA') {
																	fillcolor = '#00A300';
																} else {
																	fillcolor = '#D10000';
																}
																return {
																	color: '#000000',
																	dashArray: '1',
																	weight: 1,
																	fillColor: fillcolor,
																	fillOpacity: 0.6
																}; // Berikan efek trasparan pada bagian "fillOpacity" agar basemap dapat terlihat
															}
														},
														onEachFeature: function (feature, layer) {
															items.push(layer); // ini dibuat untuk menghubungkan variabel items ke dalam layer, ini berfungsi untuk menjalankan tool pencarian
															/*layer.bindTooltip("<center>" + feature.properties.namobj + "</center>"),
																that = this;*/
															var customPopup =
																"<table id='tabletip'>" +
																"<tr><td>Nomor PKKPR</td>" +
																"<td>" + feature.properties.nomor + "</td></tr>" +
																"<tr><td>Jenis Dokumen</td>" +
																"<td>" + feature.properties.jenisdok + "</td></tr>" +
																"<tr><td>Nomor Dokumen</td>" +
																"<td>" + feature.properties.nomordok + "</td></tr>" +
																"<tr><td>Tanggal Dokumen</td>" +
																"<td>" + feature.properties.tgldok + "</td></tr>" +
																"<tr><td>Luas Tanah</td>" +
																"<td>" + feature.properties.luasrealisasi + "</td></tr>" +
																"<tr><td>Pejabat Pengesahan</td>" +
																"<td>" + feature.properties.pejabat + "</td></tr>" +
																"<tr><td>Status Laporan</td>" +
																"<td>" + feature.properties.statuslaporan + "</td></tr>" +
																"<tr><td>Tanggal Laporan</td>" +
																"<td>" + feature.properties.tglpelaporan + "</td></tr>" +
																"</table>";
															// specify popup options
															var customOptions =
																{
																	'maxWidth': '500',
																	'className' : 'custom5'
																};
															layer.bindPopup(customPopup,customOptions), // popup yang akan ditampilkan diambil dari filed nama
																that = this; // perintah agar menghasilkan efek hover pada objek layer

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
													}).addTo(peta); // layer peta kkpr_pelaporan ini ditmbahkan ke dalam variabel 'peta'

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
														"Google Street": googleStreets,
														"Google Satellite": googleSat,
														"Google Hybrid": googleHybrid.addTo(map),
														"Google Terrain": googleTerrain
													};

													// membuat pilihan untuk menampilkan layer
													var overlays = {
														"<span style='color: #3C8DBC; font-size: 14px'>PELAPORAN KKPR</span>": {
															"Sketsa Lokasi Pelaporan<br><div><div class='boxlegend' style='background-color: #D10000'></div><span style='font-size:12px;'>BELUM VERIFIKASI</span></div><br><div><div class='boxlegend' style='background-color: #00A300'></div><span style='font-size:12px;'>LAPORAN DITERIMA</span></div>": kkpr_pelaporan.addTo(map),
														},
														"<span style='color: #3C8DBC; font-size: 14px'>BATAS ADMINISTRASI</span>": {
															"<img src='<?= base_url() ?>assets/map/legend/kec.png' width='103' style='margin-bottom:3px'><br><span style='margin-left: 18px'>Batas Administrasi Kecamatan</span>": batas_kecamatan_ar,
														},
														"<span style='color: #3C8DBC; font-size: 14px'>RENCANA TATA RUANG WILAYAH</span>": {
															"Pola Ruang<br><?= $legend; ?>": rtrw_kabbekasi_pr_ar,
														}
													};
													var options = {
														exclusiveGroups: [""], //checkbox
														//exclusiveGroups: ["KOTA BANDUNG"] //for radio
														//position:'topleft'
													};

													// MENAMPILKAN TOOLS UNTUK MEMILIH BASEMAP
													L.control.groupedLayers(baseLayers, overlays, options).addTo(map);

													map.addControl(new L.Control.Fullscreen());map.addControl(new L.Control.Draw({
														edit: {
															featureGroup: drawnItems,
															poly: {
																allowIntersection: true
															}
														},
														draw: {
															rectangle: false,
															circle: false,
															circlemarker: false,
															marker: false,
															polyline: false,
															polygon: {
																allowIntersection: false,
																showArea: true
															}
														}
													}));

													var optionColorSelected = '#000'

													map.on(L.Draw.Event.CREATED, function (event) {
														/*var layer = event.layer;
														drawnItems.addLayer(layer);*/
														event.layer.options.color = optionColorSelected;

														var types = event.layerType;
														var layer = event.layer;

														drawnItems.addLayer(layer);

														var shape = layer.toGeoJSON();
														var shape_for_db = JSON.stringify(shape);
														var type = JSON.stringify(shape.geometry.type);
														var coordinates = JSON.stringify(shape.geometry.coordinates);
														var remove_sb = coordinates.replace(/[\[\]']+/g, '');
														var remove_co = remove_sb.replace(/,/g, " ");
														if (types == 'marker') {
															var remove_sp = remove_co.replace(/ 10/g, " 10");
															document.getElementById("SHAPE").value = type.replace(/['"]+/g, '') + "(" + remove_sp + ")";
															var xlng = coordinates.substring(
																coordinates.lastIndexOf("[") + 1,
																coordinates.lastIndexOf(",")
															);
															//document.getElementById("lng").value = xlng;
															var ylat = coordinates.substring(
																coordinates.lastIndexOf(",") + 1,
																coordinates.lastIndexOf("]")
															);
															//document.getElementById("lat").value = ylat;
														} else if (types == 'polygon') {
															var remove_sp = remove_co.replace(/ 10/g, ", 10");
															document.getElementById("SHAPE").value = type.replace(/['"]+/g, '') + "((" + remove_sp + "))";
															var xlng = coordinates.substring(
																coordinates.lastIndexOf("[") + 1,
																coordinates.lastIndexOf(",")
															);
															//document.getElementById("lng").value = xlng;
															var ylat = coordinates.substring(
																coordinates.lastIndexOf(",") + 1,
																coordinates.lastIndexOf("]]]")
															);
															//document.getElementById("lat").value = ylat;
														}

													});

													map.on(L.Draw.Event.DELETED, function (event) {
														document.getElementById("SHAPE").value = "";
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
																document.getElementById("SHAPE").innerHTML = type.replace(/['"]+/g, '') + "(" + remove_sp + ")";

																var xlng = coordinates.substring(
																	coordinates.lastIndexOf("[") + 1,
																	coordinates.lastIndexOf(",")
																);
																//document.getElementById("lng").value = xlng;
																var ylat = coordinates.substring(
																	coordinates.lastIndexOf(",") + 1,
																	coordinates.lastIndexOf("]")
																);
																//document.getElementById("lat").value = ylat;
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
																//document.getElementById("lng").value = xlng;
																var ylat = coordinates.substring(
																	coordinates.lastIndexOf(",") + 1,
																	coordinates.lastIndexOf("]]]")
																);
																//document.getElementById("lat").value = ylat;
															}
														});
													});

													L.geoJson(geojsonFeatures, {
														onEachFeature: onEachFeature
													});

													function onEachFeature(feature, layer) {
														drawnPkkpr.addLayer(layer);
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
																this._div.innerHTML = '<h4 style="font-style: italic; text-align: center; margin-bottom: 10px">Batas Administrasi Kecamatan</h4>' + (props ?
																	'<table class="table table-bordered" style="text-align: justify; margin: 0;">' +
																	'<tr><th style="padding: 2px 0">Kawasan</th><td style="padding: 2px">:</td><td style="padding: 2px">' + props.namobj + '</td></tr>' +
																	'</table>'
																	: '');
															} else if (props.idkec != undefined) {
																this._div.innerHTML = '<h4 style="font-style: italic; text-align: center; margin-bottom: 10px">Pola Ruang Kab. Bekasi</h4>' + (props ?
																	'<table class="table table-bordered" style="text-align: justify; margin: 0;">' +
																	'<tr><th style="padding: 2px 0">Kecamatan</th><td style="padding: 2px">:</td><td style="padding: 2px">' + props.kecamatan + '</td></tr>' +
																	'</table>'
																	: '');
															} else if (props.OGR_FID != undefined) {
																this._div.innerHTML = '<h4 style="font-style: italic; text-align: center; margin-bottom: 10px">PKKPR</h4>' + (props ?
																	'<table class="table table-bordered" style="text-align: justify; margin: 0;">' +
																	'<tr><th style="padding: 2px 0">Tahun</th><td style="padding: 2px">:</td><td style="padding: 2px">' + props.tahun + '</td></tr>' +
																	'<tr><th style="padding: 2px 0">Pemohon</th><td style="padding: 2px">:</td><td style="padding: 2px">' + props.pemohon + '</td></tr>' +
																	'<tr><th style="padding: 2px 0">Penggunaan Tanah</th><td style="padding: 2px">:</td><td style="padding: 2px">' + props.pgt + '</td></tr>' +
																	'<tr><th style="padding: 2px 0">Jenis Peruntukan</th><td style="padding: 2px">:</td><td style="padding: 2px">' + props.rencana + '</td></tr>' +
																	'<tr><th style="padding: 2px 0">Nomenklatur</th><td style="padding: 2px">:</td><td style="padding: 2px">' + props.nomenklatu + '</td></tr>' +
																	'<tr><th style="padding: 2px 0">Luas</th><td style="padding: 2px">:</td><td style="padding: 2px">' + props.luas + '</td></tr>' +
																	'</table>'
																	: '');
															} else {
																this._div.innerHTML = '<h4 style="font-style: italic; text-align: center; margin-bottom: 10px">Informasi Peta</h4>' + (props ?
																	'<b>' + props.namobj + '</b>'
																	: '');
															}
														} else {
															this._div.innerHTML = '<h4 style="font-style: italic; text-align: center">Arahkan Kursor Pada Peta</h4>';
														}
													};
													info.addTo(map);
												</script>
											</div>
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

							<table class="table table-bordered" style="text-align: justify; margin-bottom: 0">
								<tr>
									<th colspan="4" style="text-align: center; background-color: #0D340D; color: #ffffff;"><h4 class="text-bold">Data PKKPR</h4></th>
								</tr>
								<tr>
									<td style="width: 25%"><label>Nomor PKKPR</label></td>
									<td class="text-bold" style="width: 25%" colspan="3"><?= $kkpr[0]->nomor ?></td>
								</tr>
								<tr>
									<td><label>Tanggal Terbit</label></td>
									<td><?= onlydate($kkpr[0]->tglterbit) ?></td>
									<td style="width: 25%"><label>Nama Pelaku Usaha</label></td>
									<td style="width: 25%"><?= $kkpr[0]->namapelaku ?></td>
								</tr>
								<tr>
									<td><label>NPWP</label></td>
									<td><?= $kkpr[0]->npwp ?></td>
									<td><label>Telepon Kantor</label></td>
									<td><?= $kkpr[0]->tlppelaku ?></td>
								</tr>
								<tr>
									<td><label>Email Kantor</label></td>
									<td><?= $kkpr[0]->emailpelaku ?></td>
									<td><label>Skala Usaha</label></td>
									<td><?= $kkpr[0]->skalausaha ?></td>
								</tr>
								<tr>
									<td><label>Alamat Kantor</label></td>
									<td colspan="3"><?= $kkpr[0]->alamatpelaku ?></td>
								</tr>
								<tr>
									<td><label>Luas Tanah yang Dimohon</label></td>
									<td><?= number_format($kkpr[0]->luasdimohon, 2, '.', ',') ?></td>
									<td><label>Status Penanaman Modal</label></td>
									<td><?= $kkpr[0]->spm ?></td>
								</tr>
								<tr>
									<td><label>Kecamatan Lokasi</label></td>
									<td><?= read($kkpr[0]->id_kec,'kecamatan','id_kec')[0]->nama_kec; ?></td>
									<td><label>Kelurahan Lokasi</label></td>
									<td><?= read($kkpr[0]->id_kel,'kelurahan','id_kel')[0]->nama; ?></td>
								</tr>
								<tr>
									<td><label>Luas Tanah yang disetujui</label></td>
									<td><?= number_format($kkpr[0]->luasdisetujui, 2, '.', ',') ?></td>
									<td><label>Peruntukan Pemanfaatan Ruang</label></td>
									<td><?= $kkpr[0]->pr ?></td>
								</tr>
								<tr>
									<td><label>Kode KBLI</label></td>
									<td><?= $kkpr[0]->kodekbli ?></td>
									<td><label>Judul KBLI</label></td>
									<td><?= $kkpr[0]->judulkbli ?></td>
								</tr>
								<tr>
									<td><label>Koefisien Dasar Bangunan maksimum</label></td>
									<td><?= $kkpr[0]->kdbmak ?></td>
									<td><label>Koefisien Lantai Bangunan maksimum</label></td>
									<td><?= $kkpr[0]->klbmak ?></td>
								</tr>
								<tr>
									<td><label>Indikasi Program Pemanfaatan Ruang</label></td>
									<td><?= $kkpr[0]->ippr ?></td>
									<td><label>Persyaratan Pelaksanaan Kegiatan Pemanfaatan Ruang</label></td>
									<td><?= $kkpr[0]->ppkpr ?></td>
								</tr>
								<tr>
									<td><label>Garis Sempadan Bangunan minimum</label></td>
									<td><?= $kkpr[0]->gsbmin ?></td>
									<td><label>Jarak Bebas Bangunan minimum</label></td>
									<td><?= $kkpr[0]->jbbmin ?></td>
								</tr>
								<tr>
									<td><label>Koefisien Dasar Hijau minimum</label></td>
									<td><?= $kkpr[0]->kdhmin ?></td>
									<td><label>Koefisien Tapak Basement minimum</label></td>
									<td><?= $kkpr[0]->ktbmin ?></td>
								</tr>
								<tr>
									<td><label>Jaringan Utilitas Kota</label></td>
									<td><?= $kkpr[0]->juk ?></td>
									<td><label>Status Input Data</label></td>
									<td class="text-bold"><?= $kkpr[0]->statuskkpr ?></td>
								</tr>
								<?php if (!empty($kelengkapan)) { ?>
									<tr>
										<td colspan="4">
											<object width="100%" height="500" type="application/pdf" data="<?php echo base_url(); ?>assets/file/kkpr/kelengkapan/<?= $kelengkapan[0]->filekelengkapan ?>?#zoom=100&scrollbar=0&toolbar=0&navpanes=0">
												<embed src="<?php echo base_url(); ?>assets/file/kkpr/kelengkapan/<?= $kelengkapan[0]->filekelengkapan ?>" type="application/pdf">
												<p>This browser does not support PDFs. Please download the PDF to view it: <a href="<?php echo base_url(); ?>assets/file/kkpr/kelengkapan/<?= $kelengkapan[0]->filekelengkapan ?>">Download PDF</a>.</p>
												</embed>
											</object>
										</td>
									</tr>
								<?php } ?>
							</table>
						</div>
					</div>
					<!-- /.box-body -->
				</div>
	</section><div style="clear:both;"></div>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url(); ?>assets/lte/plugins/jQuery/jquery-2.2.3.min.js"></script>
