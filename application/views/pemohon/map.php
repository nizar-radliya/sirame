<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content" style="height: 100%; padding: 0 10px;">
		<div class="row">
			<div class="col-md-12" style="padding: 0;height: 615px;">

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
							<table class="table table-bordered" style="margin-bottom: 10px">
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
									<td colspan="2">
										<a href="#" class="zoom-map" data-id="-4.037013" data-id2="104.696632">
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
							</table>
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

				<div id="map"> <!-- ini id="map" bisa di ganti dengan nama yang di inginkan -->
					<a data-toggle="collapse" href="#collapseTwo" title="Data Atribut Peta">

						<script>
							// MENGATUR TITIK KOORDINAT TITIK TENGAH & LEVEL ZOOM PADA BASEMAP
							var map = L.map('map', {attributionControl: false}).setView([-6.502976, 107.744584], 10);
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
										fillOpacity: 1
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

							map.addControl(new L.Control.Fullscreen());

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

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url(); ?>assets/lte/plugins/jQuery/jquery-2.2.3.min.js"></script>

<!-- page script -->
<script>
	$(function () {
		$("#example1").DataTable();
	});
</script>

<script>
	$(function () {
		var csfrData = {};
		$.ajaxSetup({
			data: csfrData
		});
		$(document).on('click', '.edit-record', function (e) {
			e.preventDefault();
			/*var latlngs = [
				[9.102097,-10.564344],
				[24.527135,23.198966]
			]; // Tinggal ambil kordinat polyline tapi kalau langsung dari mysql kebalik lat dan lng
			var polyline = L.polyline(latlngs, {color: 'red'}).addTo(map);
			map.fitBounds(polyline.getBounds());*/

			var marker = L.marker([$(this).attr('data-id'),$(this).attr('data-id2')]).addTo(map);
			marker.bindPopup("<b>"+$(this).attr('data-id3')+"</b>").openPopup();
			map.flyTo([$(this).attr('data-id'),$(this).attr('data-id2')], 15);

			//alert("ID Jalan: "+$(this).attr('data-id'));
		});
	});
</script>
