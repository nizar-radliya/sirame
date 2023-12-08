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
			<li><a href="<?php echo base_url(); ?>pelaporan-adm"><i class="fa fa-calendar-check-o"></i>Pelaporan PKKPR</li></a></li>
			<li class="active"><i class="fa fa-binoculars"></i> Detil Pelaporan</li>
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
									<option value="<?php echo base_url(); ?>pelaporan-adm/detil/<?= $field->nomor; ?>" selected><?= $field->nomor; ?></option>
								<?php } else { ?>
									<option value="<?php echo base_url(); ?>pelaporan-adm/detil/<?= $field->nomor; ?>"><?= $field->nomor; ?></option>
								<?php } } ?>
						</select>

						<a href="<?php echo base_url(); ?>pelaporan-adm/form-add/<?= $kkpr[0]->nomor; ?>">
							<button type="button" class="btn bg-yellow btn-flat margin pull-right"
									style="margin: 0 5px 0 0">
								<span class="fa fa-plus" style="margin-right: 5px"></span>
								Tambah Data Pelaporan
							</button>
						</a>

						<table class="table table-bordered" style="text-align: justify; margin-top: 10px; margin-bottom: 0">
							<tr>
								<th style="width: 25%">Luas Tanah PKKPR</th>
								<td><?= number_format($kkpr[0]->luasdisetujui, 2, '.', ',') ?></td>
							</tr>
							<tr>
								<th style="width: 25%">Luas Tanah Sudah Dilaporkan</th>
								<td><?= number_format($luaspelaporan, 2, '.', ',') ?></td>
							</tr>
							<tr>
								<th style="width: 25%">Sisa Luas Tanah Belum Dilaporkan</th>
								<td><?= number_format($kkpr[0]->luasdisetujui-$luaspelaporan, 2, '.', ',') ?></td>
							</tr>
						</table>

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

							<table id="example1" class="table table-bordered table-striped" style="width: 100%">
								<thead>
								<tr>
									<th style="width: 10px">#</th>
									<th><span class="fa fa-gear"></span></th>
									<th>Tgl Pelaporan</th>
									<th>Luas Realisasi</th>
									<th>Tgl Verifikasi</th>
									<th>Status Pelaporan</th>
									<th>Catatan</th>
								</tr>
								</thead>
								<tbody>
								<?php $n=1; foreach ($pelaporan as $field) { ?>
									<tr>
										<td><?php echo $n++; ?></td>
										<td>
											<?php if ($field->filepelaporan != '') { ?>
											<a href="<?php echo base_url(); ?>pelaporan-adm/unduh/?file=<?= $field->filepelaporan; ?>" target="_blank">
												<button type="button" class="btn bg-purple-gradient btn-flat margin" title="Unduh" style="margin: 0; min-width: 40px">
													<span class="fa fa-download"></span>
												</button>
											</a>
											<?php } ?>
											<?php if ($field->statuslaporan != 'PELAPORAN DITERIMA') { ?>
												<a href="<?php echo base_url(); ?>pelaporan-adm/form-edit/<?= $field->idpelaporan; ?>/<?= $kkpr[0]->nomor; ?>">
													<button type="button" class="btn bg-blue-gradient btn-flat margin" title="Ubah Data" style="margin: 0; min-width: 40px">
														<span class="fa fa-edit"></span>
													</button>
												</a>
											<?php } ?>
											<?php if ($field->statuslaporan != 'PELAPORAN DITERIMA') { ?>
												<a href="#" class="edit-record" data-id="<?= $field->idpelaporan; ?>">
													<button type="button" class="btn bg-red-gradient btn-flat margin" title="Hapus Data" style="margin: 0; min-width: 40px">
														<span class="fa fa-remove"></span>
													</button>
												</a>
											<?php } ?>
										</td>
										<td><?php echo onlydate($field->tglpelaporan); ?></td>
										<td><?php echo $field->luasrealisasi; ?></td>
										<td><?php if ($field->tglverifikasi!=null) echo onlydate($field->tglverifikasi); ?></td>
										<td class="text-bold"><?php echo $field->statuslaporan; ?></td>
										<td>
											<a href="#" class="ket" data-id="<?php echo $field->idpelaporan; ?>">
												<button type="button" class="btn bg-gray-active btn-flat margin" title="Keterangan" style="margin: 0; min-width: 40px">
													<span class="fa fa-file-text-o"></span>
												</button>
											</a>
										</td>
									</tr>
								<?php } ?>
								</tbody>
							</table>

							<table class="table table-bordered" style="text-align: justify; margin-bottom: 0">
								<tr>
									<th colspan="4" style="text-align: center; background-color: #0D340D; color: #ffffff;"><h4 class="text-bold">Data PKKPR</h4></th>
								</tr>
								<tr>
									<td style="width: 25%"><label>Nomor PKKPR</label></td>
									<td class="text-bold" style="width: 25%"><?= $kkpr[0]->nomor ?></td>
									<td rowspan="7" colspan="2">
										<div id="map" style="padding: 0; height: 285px; width: 100%; border: 2px solid #C2C2C2; border-radius: 5px; margin: 0 auto"> <!-- ini id="map" bisa di ganti dengan nama yang di inginkan -->
											<?php $legend=''; foreach ($rtrw_kabbekasi_pr_ar as $field) { ?>
												<?php $legend.= "<div><div class='boxlegend' style='background-color: rgb(".$field->r.",".$field->g.",".$field->b.")'></div><span style='font-size:12px;'>".$field->namobj."</span></div><br style='display: block; content: ''; margin-bottom: 0em;'>"; ?>
											<?php } ?>
											<script>
												var geojsonFeatures = <?php echo json_encode($geojson, JSON_NUMERIC_CHECK); ?>;

												var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
													osmAttrib = '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors',
													osm = L.tileLayer(osmUrl, {maxZoom: 20, attribution: osmAttrib}),
													map = new L.Map('map', {attributionControl: false, center: new L.LatLng(<?= $lat ?>, <?= $lng ?>), zoom: 15}),
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

												map.addControl(new L.Control.Fullscreen());

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
									<td style="width: 25%"><label>Tanggal Terbit</label></td>
									<td style="width: 25%"><?= onlydate($kkpr[0]->tglterbit) ?></td>
								</tr>
								<tr>
									<td><label>Nama Pelaku Usaha</label></td>
									<td><?= $kkpr[0]->namapelaku ?></td>
								</tr>
								<tr>
									<td><label>NPWP</label></td>
									<td><?= $kkpr[0]->npwp ?></td>
								</tr>
								<tr>
									<td><label>Telepon Kantor</label></td>
									<td><?= $kkpr[0]->tlppelaku ?></td>
								</tr>
								<tr>
									<td><label>Email Kantor</label></td>
									<td><?= $kkpr[0]->emailpelaku ?></td>
								</tr>
								<td><label>Skala Usaha</label></td>
								<td><?= $kkpr[0]->skalausaha ?></td>
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
								<tr>
									<th colspan="4" style="text-align: center; background-color: #0D340D; color: #ffffff"><h4 class="text-bold">Data Pengguna</h4></th>
								</tr>
								<tr>
									<td><label>Nomor KTP</label></td>
									<td><?= $kkpr[0]->noktp ?></td>
									<td><label>Nama Lengkap</label></td>
									<td><?= $kkpr[0]->namapemohon ?></td>
								</tr>
								<tr>
									<td><label>Email</label></td>
									<td><?= $kkpr[0]->email ?></td>
									<td><label>Nomor Handphone</label></td>
									<td><?= $kkpr[0]->hp ?></td>
								</tr>
								<tr>
									<td><label>Pekerjaan</label></td>
									<td><?= $kkpr[0]->pekerjaan ?></td>
									<td><label>Kewarganegaraan</label></td>
									<td><?= $kkpr[0]->wn ?></td>
								</tr>
								<tr>
									<td><label>Provinsi</label></td>
									<td><?= read($kkpr[0]->id_prov,'provinsi','id_prov')[0]->nama_prov; ?></td>
									<td><label>Kabupaten/Kota</label></td>
									<td><?= read($kkpr[0]->kotapemohon,'kota','id_kota')[0]->nama_kota; ?></td>
								</tr>
								<tr>
									<td><label>Kecamatan</label></td>
									<td><?= read($kkpr[0]->kecpemohon,'kecamatan','id_kec')[0]->nama_kec; ?></td>
									<td><label>Kode Pos</label></td>
									<td><?= $kkpr[0]->kodepos ?></td>
								</tr>
								<tr>
									<td><label>Alamat</label></td>
									<td colspan="3"><?= $kkpr[0]->alamat ?></td>
								</tr>
							</table>

							<table class="table table-bordered table-striped" style="width: 100%; margin-bottom: 5px">
								<tr>
									<th colspan="4" style="text-align: center; background-color: #0D340D; color: #ffffff"><h4 class="text-bold">Data Kelengkapan</h4></th>
								</tr>
							</table>
							<table id="example1" class="table table-bordered table-striped">
								<thead>
								<tr>
									<th style="width: 10px">#</th>
									<th><span class="fa fa-gear"></span></th>
									<th>Jenis Kelengkapan</th>
									<th>Status</th>
									<th>Tgl Unggah</th>
									<th>Tgl Verifikasi</th>
								</tr>
								</thead>
								<tbody>
								<?php $n=1; foreach ($jeniskelengkapan as $field) {
											$kkpr_kelengkapan = readkelengkapan($kkpr[0]->nomor,$field->idjenis);
											?>
											<tr>
												<td><?php echo $n++; ?></td>
												<td style="width: auto">
														<?php if (!empty($kkpr_kelengkapan)) { ?>
															<a href="<?php echo base_url(); ?>kelengkapan/unduh/?file=<?= $kkpr_kelengkapan[0]->filekelengkapan ?>" target="_blank">
																<button type="button" class="btn bg-purple-gradient btn-flat margin" title="Unduh" style="margin: 0; min-width: 40px">
																	<span class="fa fa-download"></span>
																</button>
															</a>
														<?php } ?>
												</td>
												<td><?php echo $field->jeniskelengkapan; ?></td>
												<?php if (!empty($kkpr_kelengkapan)) { ?>
													<th>
														<?php if ($kkpr_kelengkapan[0]->statuskelengkapan == 'MENUNGGU VERIFIKASI') { ?>
															<button type="button" style="width: 100%" class="btn bg-yellow btn-flat"><?= $kkpr_kelengkapan[0]->statuskelengkapan; ?></button>
														<?php } else if ($kkpr_kelengkapan[0]->statuskelengkapan == 'KELENGKAPAN DITOLAK') { ?>
															<button type="button" style="width: 100%" class="btn bg-maroon btn-flat"><?= $kkpr_kelengkapan[0]->statuskelengkapan; ?></button>
														<?php } else if ($kkpr_kelengkapan[0]->statuskelengkapan == 'KELENGKAPAN DITERIMA') { ?>
															<button type="button" style="width: 100%" class="btn bg-green btn-flat"><?= $kkpr_kelengkapan[0]->statuskelengkapan; ?></button>
														<?php } ?>
													</th>
													<td><?php echo onlydate($kkpr_kelengkapan[0]->tglupload); ?></td>
													<td><?php echo onlydate($kkpr_kelengkapan[0]->tglverifikasi); ?></td>
												<?php } else { ?>
													<td>-</td>
													<td>-</td>
													<td>-</td>
													<td>-</td>
												<?php } ?>
											</tr>
										<?php } ?>
								</tbody>
							</table>

						</div>
					</div>
					<!-- /.box-body -->
				</div>
	</section><div style="clear:both;"></div>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!--Modal Kelengkapan-->


<div id="modalAdd" class="modal fade modal-primary" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="icon fa fa-file-o"></i> Unggah Kelengkapan</h4>
			</div>
			<div class="modal-body">
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div id="modalDel" class="modal fade modal-danger" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="icon fa fa-warning"></i> Hapus Kelengkapan</h4>
			</div>
			<div class="modal-footer">
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div id="modalCek" class="modal fade modal-success" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="icon fa fa-file-o"></i> Verifikasi Kelengkapan</h4>
			</div>
			<div class="modal-body">
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!--Modal Kelengkapan-->

<div id="myModal" class="modal fade modal-danger" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="icon fa fa-warning"></i> Konfirmasi</h4>
			</div>
			<div class="modal-body">
				<p>Yakin akan menghapus data ini? Data kkpr tidak dapat dihapus apabila sudah berhasil verifikasi kelengkapan.</p>
			</div>
			<div class="modal-footer">
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div id="myModalSkip" class="modal fade modal-warning" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="icon fa fa-forward"></i> Lewati Tahap Pelaporan PKKPR</h4>
			</div>
			<div class="modal-body">
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div id="myModalRapat" class="modal fade modal-success" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="icon fa fa-forward"></i> Tahap Rapat Pembahasan</h4>
			</div>
			<div class="modal-body">
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div id="myModalKet" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="icon fa fa-file-text-o"></i> Catatan Pelaporan PKKPR</h4>
			</div>
			<div class="modal-body">
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div id="myModalDel" class="modal fade modal-danger" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="icon fa fa-trash-o"></i> Hapus Form/Dokumentasi Pelaporan PKKPR</h4>
			</div>
			<div class="modal-body">
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url(); ?>assets/lte/plugins/jQuery/jquery-2.2.3.min.js"></script>

<!-- page script -->
<script>
	$(function () {
		$("#example1").DataTable();
	});
</script>

<!--Modal Kelengkapan-->


<script>
	$(function(){
		var csfrData = {};
		csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
		$.ajaxSetup({
			data: csfrData
		});
		$(document).on('click','.kelengkapan-add',function(e){
			e.preventDefault();
			$("#modalAdd").modal('show');
			$.get('<?php echo base_url(); ?>kelengkapan/add',
				{id:$(this).attr('data-id'),id2:$(this).attr('data-id2'),data:csfrData},
				function(html){
					$(".modal-body").html(html);
				}
			);
		});
	});
</script>

<script>
	$(function(){
		var csfrData = {};
		csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
		$.ajaxSetup({
			data: csfrData
		});
		$(document).on('click','.kelengkapan-del',function(e){
			e.preventDefault();
			$("#modalDel").modal('show');
			$.get('<?php echo base_url(); ?>kelengkapan/kelengkapan-del',
				{id:$(this).attr('data-id'),id2:$(this).attr('data-id2'),data:csfrData},
				function(html){
					$(".modal-footer").html(html);
				}
			);
		});
	});
</script>

<script>
	$(function(){
		var csfrData = {};
		csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
		$.ajaxSetup({
			data: csfrData
		});
		$(document).on('click','.kelengkapan-cek',function(e){
			e.preventDefault();
			$("#modalCek").modal('show');
			$.get('<?php echo base_url(); ?>kelengkapan/kelengkapan-cek',
				{id:$(this).attr('data-id'),id2:$(this).attr('data-id2'),data:csfrData},
				function(html){
					$(".modal-body").html(html);
				}
			);
		});
	});
</script>
<!--Modal Kelengkapan-->

<script>
	$(function(){
		var csfrData = {};
		csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
		$.ajaxSetup({
			data: csfrData
		});
		$(document).on('click','.skip',function(e){
			e.preventDefault();
			$("#myModalSkip").modal('show');
			$.get('<?php echo base_url(); ?>pelaporan-adm/skip-pelaporan',
					{id:$(this).attr('data-id'),data:csfrData},
					function(html){
						$(".modal-body").html(html);
					}
			);
		});
	});
</script>

<script>
	$(function(){
		var csfrData = {};
		csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
		$.ajaxSetup({
			data: csfrData
		});
		$(document).on('click','.pengkajian',function(e){
			e.preventDefault();
			$("#myModalRapat").modal('show');
			$.get('<?php echo base_url(); ?>pelaporan-adm/pengkajian-teknis',
					{id:$(this).attr('data-id'),data:csfrData},
					function(html){
						$(".modal-body").html(html);
					}
			);
		});
	});
</script>

<script>
	$(function(){
		var csfrData = {};
		csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
		$.ajaxSetup({
			data: csfrData
		});
		$(document).on('click','.ket',function(e){
			e.preventDefault();
			$("#myModalKet").modal('show');
			$.get('<?php echo base_url(); ?>pelaporan-adm/catatan',
					{id:$(this).attr('data-id'),data:csfrData},
					function(html){
						$(".modal-body").html(html);
					}
			);
		});
	});
</script>

<script>
	$(function(){
		var csfrData = {};
		csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
		$.ajaxSetup({
			data: csfrData
		});
		$(document).on('click','.del',function(e){
			e.preventDefault();
			$("#myModalDel").modal('show');
			$.get('<?php echo base_url(); ?>pelaporan-adm/form-del',
					{id:$(this).attr('data-id'),id2:$(this).attr('data-id2'),data:csfrData},
					function(html){
						$(".modal-body").html(html);
					}
			);
		});
	});
</script>
