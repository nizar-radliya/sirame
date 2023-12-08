<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content" style="height: 100%; padding: 0 10px;">
		<div class="row">
			<div class="col-md-12" style="padding: 0;height: 615px;">

				<?php $legend=''; foreach ($rdtr_rencana_polaruang as $field) { ?>
					<?php $legend.= "<div><div class='boxlegend' style='background-color: rgb(".$field->rgb.")'></div> <span style='font-size:12px'>".$field->nama."</span></div>"; ?>
				<?php } ?>

				<div id="map"> <!-- ini id="map" bisa di ganti dengan nama yang di inginkan -->
					<a data-toggle="collapse" href="#collapseTwo" title="Data Atribut Peta">
						<script>
							// MENGATUR TITIK KOORDINAT TITIK TENGAH & LEVEL ZOOM PADA BASEMAP
							var map = L.map('map', {attributionControl: false}).setView([-4.31591,104.3588713], 13);
							var peta = new L.LayerGroup();
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

							var rdtr_rencana_polaruang = new L.GeoJSON.AJAX("<?php echo base_url(); ?>assets/map/layer/rdtr_rencana_polaruang.php", {
								style: function (feature) {
									var fillColor;
									fillColor = 'rgb('+feature.properties.rgb+')';
									return {
										color: "#000000",
										dashArray: '1',
										weight: 1,
										fillColor: fillColor,
										fillOpacity: 1
									}; // Berikan efek trasparan pada bagian "fillOpacity" agar basemap dapat terlihat
								},
								onEachFeature: function (feature, layer) {
									items.push(layer); // ini dibuat untuk menghubungkan variabel items ke dalam layer, ini berfungsi untuk menjalankan tool pencarian
									layer.bindTooltip("<center>" + feature.properties.nama + "</center>"),
										that = this;
									var customPopup =
										"<table class='table table-bordered'>" +
										"<tr><td>Nama Objek</td>" +
										"<td>" + feature.properties.nama + "</td></tr>" +
										"<tr><td>Orde 1</td>" +
										"<td>" + feature.properties.d_orde01 + "</td></tr>" +
										"<tr><td>Orde 2</td>" +
										"<td>" + feature.properties.d_orde02 + "</td></tr>" +
										"<tr><td>Orde 3</td>" +
										"<td>" + feature.properties.d_orde03 + "</td></tr>" +
										"<tr><td>Orde 4</td>" +
										"<td>" + feature.properties.d_orde04 + "</td></tr>" +
										"<tr><td>Fungsi</td>" +
										"<td>" + feature.properties.d_jnsrpr + "</td></tr>" +
										"</table>";
									// specify popup options
									var customOptions =
										{
											'maxWidth': '500',
											'className' : 'custom'
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
							}).addTo(peta); // layer peta polaruang ini ditmbahkan ke dalam variabel 'peta'

							var rdtr_dasar_batasadm = new L.GeoJSON.AJAX("<?php echo base_url(); ?>assets/map/layer/rdtr_dasar_batasadm.php", {
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
										rdtr_dasar_batasadm.resetStyle(e.target);
										info.update();
									});
								}
							}).addTo(peta); // layer peta batas administrasi ini ditambahkan ke dalam variabel 'peta'

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
									"<img src='<?= base_url() ?>assets/map/legend/kec.png' width='103' style='margin-bottom:3px'><br><span style='margin-left: 18px'>Batas Administrasi</span>": rdtr_dasar_batasadm,
								},
								"<span style='color: #3C8DBC; font-size: 14px'>RTRW OKUT</span>": {
									"Pola Ruang<br><?= $legend; ?>": rdtr_rencana_polaruang.addTo(map),
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

							// MENAMPILKAN TOOLS UNTUK MEMILIH BASEMAP
							// L.control.groupedLayers(baseLayers, overlays, options).addTo(map);

							// Create the control and add it to the map;
							var control = L.control.groupedLayers(baseLayers, overlays, options).addTo(map);
							control.addTo(map);

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

							var info = L.control({position:'bottomright'});
							info.onAdd = function (map) {
								this._div = L.DomUtil.create('div', 'div-info');
								this.update();
								return this._div;
							};
							info.update = function (props) {
								if (props != undefined) {
									if (props.idperkotaan != undefined) {
										this._div.innerHTML = '<h4 style="font-style: italic; text-align: center; margin-bottom: 10px">Sistem Perkotaan</h4>' + (props ?
											'<table class="table table-bordered" style="text-align: justify; margin: 0;">' +
											'<tr><th style="padding: 2px 0">Sistem Perkotaan</th><td style="padding: 2px">:</td><td style="padding: 2px">' + props.pst_kgt + '</td></tr>' +
											'<tr><th style="padding: 2px 0">Lokasi</th><td style="padding: 2px">:</td><td style="padding: 2px">' + props.lokasi + '</td></tr>' +
											'</table>'
											: '');
									} else if (props.idjalan != undefined) {
										this._div.innerHTML = '<h4 style="font-style: italic; text-align: center; margin-bottom: 10px">Sistem Jaringan Transportasi: Jalan</h4>' + (props ?
											'<table class="table table-bordered" style="text-align: justify; margin: 0;">' +
											'<tr><th style="padding: 2px 0">Fungsi Jalan</th><td style="padding: 2px">:</td><td style="padding: 2px">' + props.fungsi + '</td></tr>' +
											'<tr><th style="padding: 2px 0">Nama Jalan</th><td style="padding: 2px">:</td><td style="padding: 2px">' + props.nama + '</td></tr>' +
											'</table>'
											: '');
									} else if (props.idtransportasisarana != undefined) {
										this._div.innerHTML = '<h4 style="font-style: italic; text-align: center; margin-bottom: 10px">Sistem Jaringan Transportasi: Sarana</h4>' + (props ?
											'<table class="table table-bordered" style="text-align: justify; margin: 0;">' +
											'<tr><th style="padding: 2px 0">Nama Sarana Transportasi</th><td style="padding: 2px">:</td><td style="padding: 2px">' + props.nama + '</td></tr>' +
											'</table>'
											: '');
									} else if (props.idpembangkit != undefined) {
										this._div.innerHTML = '<h4 style="font-style: italic; text-align: center; margin-bottom: 10px">Sistem Jaringan Energi: Pembangkit</h4>' + (props ?
											'<table class="table table-bordered" style="text-align: justify; margin: 0;">' +
											'<tr><th style="padding: 2px 0">Pembangkit Listrik</th><td style="padding: 2px">:</td><td style="padding: 2px">' + props.nama + '</td></tr>' +
											'<tr><th style="padding: 2px 0">Status</th><td style="padding: 2px">:</td><td style="padding: 2px">' + props.status + '</td></tr>' +
											'<tr><th style="padding: 2px 0">Lokasi</th><td style="padding: 2px">:</td><td style="padding: 2px">' + props.lokasi + '</td></tr>' +
											'<tr><th style="padding: 2px 0">Keterangan</th><td style="padding: 2px">:</td><td style="padding: 2px">' + props.keterangan + '</td></tr>' +
											'</table>'
											: '');
									} else if (props.idsda != undefined) {
										this._div.innerHTML = '<h4 style="font-style: italic; text-align: center; margin-bottom: 10px">Sistem Jaringan Sumber Daya Air</h4>' + (props ?
											'<table class="table table-bordered" style="text-align: justify; margin: 0;">' +
											'<tr><th style="padding: 2px 0">Jaringan SDA</th><td style="padding: 2px">:</td><td style="padding: 2px">' + props.nama + '</td></tr>' +
											'<tr><th style="padding: 2px 0">Lokasi</th><td style="padding: 2px">:</td><td style="padding: 2px">' + props.lokasi + '</td></tr>' +
											'</table>'
											: '');
									} else if (props.idpr != undefined) {
										this._div.innerHTML = '<h4 style="font-style: italic; text-align: center; margin-bottom: 10px">Pola Ruang</h4>' + (props ?
											'<table class="table table-bordered" style="text-align: justify; margin: 0;">' +
											'<tr><th style="padding: 2px 0">Sub Zona</th><td style="padding: 2px">:</td><td style="padding: 2px">' + props.fungsi + '</td></tr>' +
											'<tr><th style="padding: 2px 0">Pulau</th><td style="padding: 2px">:</td><td style="padding: 2px">' + props.pulau + '</td></tr>' +
											'<tr><th style="padding: 2px 0">Kecamatan</th><td style="padding: 2px">:</td><td style="padding: 2px">' + props.kec + '</td></tr>' +
											'</table>'
											: '');
									} else if (props.idstrategis != undefined) {
										this._div.innerHTML = '<h4 style="font-style: italic; text-align: center; margin-bottom: 10px">Kawasan Strategis</h4>' + (props ?
											'<table class="table table-bordered" style="text-align: justify; margin: 0;">' +
											'<tr><th style="padding: 2px 0">Nama Kawasan</th><td style="padding: 2px">:</td><td style="padding: 2px">' + props.nama + '</td></tr>' +
											'<tr><th style="padding: 2px 0">Kecamatan</th><td style="padding: 2px">:</td><td style="padding: 2px">' + props.kecamatan + '</td></tr>' +
											'<tr><th style="padding: 2px 0">Kabupaten/Kota</th><td style="padding: 2px">:</td><td style="padding: 2px">' + props.kab_kota + '</td></tr>' +
											'</table>'
											: '');
									} else if (props.idkabkota != undefined) {
										this._div.innerHTML = '<h4 style="font-style: italic; text-align: center; margin-bottom: 10px">Batas Administrasi</h4>' + (props ?
											'<table class="table table-bordered" style="text-align: justify; margin: 0;">' +
											'<tr><th style="padding: 2px 0">Kabupaten/Kota</th><td style="padding: 2px">' + props.nama + '</td></tr>' +
											'<tr><th style="padding: 2px 0">Luas (ha)</th><td style="padding: 2px">' + props.luasan_ha + '</td></tr>' +
											'<tr><th style="padding: 2px 0">Penduduk</th><td style="padding: 2px">' + '-' + '</td></tr>' +
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
						<!--<div class="leaflet-bottom leaflet-right" style="margin-bottom: 0">
							<input type="button" id="Btn3" class="btnStyle span3 leaflet-control"/>
						</div>-->
						<a href="<?= base_url() ?>map/cetak/" target="_blank">
							<div class="leaflet-bottom leaflet-left" style="margin-bottom: 20px">
								<input type="button" id="Btn3" class="btnPrint span3 leaflet-control" />
							</div>
						</a>
					</a>
				</div>
			</div>
		</div>
		<div id="collapseTwo" class="panel-collapse collapse" style="padding: 10px">
			<div class="box box-info" style="margin-bottom: 0">
				<!-- /.box-header -->
				<div class="box-body">
					<div class="col-sm-12" style="padding: 0; overflow: scroll;">
						// Data Tabular
					</div>
				</div>
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
