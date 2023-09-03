<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content" style="height: 100%; padding: 0 10px;">
		<div class="row">
			<div class="col-md-12" style="padding: 0;height: 615px;">

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

							var layer_pengaduan = new L.GeoJSON.AJAX("<?php echo base_url(); ?>assets/map/layer/pengaduan_layer.php", { // layer geologi berada di dalam variabel layer_geologi
								style: function (feature) {
									return {
										iconSize: [20, 20]
									}; // Berikan efek trasparan pada bagian "fillOpacity" agar basemap dapat terlihat
								},
								onEachFeature: function (feature, layer) {
									var statuspengaduan = feature.properties.statuspengaduan;
									if (statuspengaduan == 'PERSYARATAN BELUM LENGKAP') {
										var bangunanIcon = L.icon({
											iconUrl: '<?= base_url() ?>assets/map/legend/a.png',
											iconSize: [20, 20]
										});
									} else if (statuspengaduan == 'MENUNGGU VERIFIKASI PERSYARATAN') {
										var bangunanIcon = L.icon({
											iconUrl: '<?= base_url() ?>assets/map/legend/b.png',
											iconSize: [20, 20]
										});
									} else if (statuspengaduan == 'PERSYARATAN DITOLAK') {
										var bangunanIcon = L.icon({
											iconUrl: '<?= base_url() ?>assets/map/legend/c.png',
											iconSize: [20, 20]
										});
									} else if (statuspengaduan == 'PERSYARATAN DISETUJUI') {
										var bangunanIcon = L.icon({
											iconUrl: '<?= base_url() ?>assets/map/legend/d.png',
											iconSize: [20, 20]
										});
									} else if (statuspengaduan == 'PROSES PENCERMATAN') {
										var bangunanIcon = L.icon({
											iconUrl: '<?= base_url() ?>assets/map/legend/e.png',
											iconSize: [20, 20]
										});
									} else if (statuspengaduan == 'RAPAT PEMBAHASAN') {
										var bangunanIcon = L.icon({
											iconUrl: '<?= base_url() ?>assets/map/legend/f.png',
											iconSize: [20, 20]
										});
									} else if (statuspengaduan == 'PROSES TINDAK LANJUT') {
										var bangunanIcon = L.icon({
											iconUrl: '<?= base_url() ?>assets/map/legend/j.png',
											iconSize: [20, 20]
										});
									} else if (statuspengaduan == 'SELESAI TINDAK LANJUT') {
										var bangunanIcon = L.icon({
											iconUrl: '<?= base_url() ?>assets/map/legend/h.png',
											iconSize: [20, 20]
										});
									} else if (statuspengaduan == 'SELESAI TINDAK LANJUT BERSYARAT') {
										var bangunanIcon = L.icon({
											iconUrl: '<?= base_url() ?>assets/map/legend/i.png',
											iconSize: [20, 20]
										});
									} else if (statuspengaduan == 'REKOMENDASI DITUNDA') {
										var bangunanIcon = L.icon({
											iconUrl: '<?= base_url() ?>assets/map/legend/j.png',
											iconSize: [20, 20]
										});
									}
									layer.setIcon(bangunanIcon);
									items.push(layer); // ini dibuat untuk menghubungkan variabel items ke dalam layer, ini berfungsi untuk menjalankan tool pencarian
									layer.bindTooltip("<center>" + feature.properties.nama + "</center>"),
											that = this;

									layer.on('mouseover', function (e) {
										var statuspengaduan = feature.properties.statuspengaduan;
										if (statuspengaduan == 'PERSYARATAN BELUM LENGKAP') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/a.png',
												iconSize: [25, 25]
											});
										} else if (statuspengaduan == 'MENUNGGU VERIFIKASI PERSYARATAN') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/b.png',
												iconSize: [25, 25]
											});
										} else if (statuspengaduan == 'PERSYARATAN DITOLAK') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/c.png',
												iconSize: [25, 25]
											});
										} else if (statuspengaduan == 'PERSYARATAN DISETUJUI') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/d.png',
												iconSize: [25, 25]
											});
										} else if (statuspengaduan == 'PROSES PENCERMATAN') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/e.png',
												iconSize: [25, 25]
											});
										} else if (statuspengaduan == 'RAPAT PEMBAHASAN') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/f.png',
												iconSize: [25, 25]
											});
										} else if (statuspengaduan == 'PROSES TINDAK LANJUT') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/j.png',
												iconSize: [25, 25]
											});
										} else if (statuspengaduan == 'SELESAI TINDAK LANJUT') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/h.png',
												iconSize: [25, 25]
											});
										} else if (statuspengaduan == 'SELESAI TINDAK LANJUT BERSYARAT') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/i.png',
												iconSize: [25, 25]
											});
										} else if (statuspengaduan == 'REKOMENDASI DITUNDA') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/j.png',
												iconSize: [25, 25]
											});
										}
										layer.setIcon(bangunanIcon);
										info.update(layer.feature.properties);
									});
									layer.on('mouseout', function (e) {
										var statuspengaduan = feature.properties.statuspengaduan;
										if (statuspengaduan == 'PERSYARATAN BELUM LENGKAP') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/a.png',
												iconSize: [20, 20]
											});
										} else if (statuspengaduan == 'MENUNGGU VERIFIKASI PERSYARATAN') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/b.png',
												iconSize: [20, 20]
											});
										} else if (statuspengaduan == 'PERSYARATAN DITOLAK') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/c.png',
												iconSize: [20, 20]
											});
										} else if (statuspengaduan == 'PERSYARATAN DISETUJUI') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/d.png',
												iconSize: [20, 20]
											});
										} else if (statuspengaduan == 'PROSES PENCERMATAN') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/e.png',
												iconSize: [20, 20]
											});
										} else if (statuspengaduan == 'RAPAT PEMBAHASAN') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/f.png',
												iconSize: [20, 20]
											});
										} else if (statuspengaduan == 'PROSES TINDAK LANJUT') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/j.png',
												iconSize: [20, 20]
											});
										} else if (statuspengaduan == 'SELESAI TINDAK LANJUT') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/h.png',
												iconSize: [20, 20]
											});
										} else if (statuspengaduan == 'SELESAI TINDAK LANJUT BERSYARAT') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/i.png',
												iconSize: [20, 20]
											});
										} else if (statuspengaduan == 'REKOMENDASI DITUNDA') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/j.png',
												iconSize: [20, 20]
											});
										}
										layer.setIcon(bangunanIcon);
										info.update();
									});
									layer.on('click', function (e) {
										$("#myModalPermohonan").modal('show');
										$.get('<?php echo base_url(); ?>sipetarung/pengaduan',
												{id: feature.properties.nopengaduan},
												function (html) {
													$(".modal-body").html(html);
												}
										);
									});
								}
							}).addTo(peta); // layer peta pengaduan ini ditambahkan ke dalam variabel 'peta'

							var layer_polygon = new L.GeoJSON.AJAX("<?php echo base_url(); ?>assets/map/layer/pengaduan_layer.php", {
								style: function (feature) {
									var fillColor, statuspengaduan = feature.properties.statuspengaduan;
									if (statuspengaduan == 'PERSYARATAN BELUM LENGKAP') {
										fillColor = '#d2d6de';
									} else if (statuspengaduan == 'MENUNGGU VERIFIKASI PERSYARATAN') {
										fillColor = '#111111';
									} else if (statuspengaduan == 'PERSYARATAN DITOLAK') {
										fillColor = '#f012be';
									} else if (statuspengaduan == 'PERSYARATAN DISETUJUI') {
										fillColor = '#f39c12';
									} else if (statuspengaduan == 'PROSES PENCERMATAN') {
										fillColor = '#00c0ef';
									} else if (statuspengaduan == 'RAPAT PEMBAHASAN') {
										fillColor = '#0073b7';
									} else if (statuspengaduan == 'PROSES TINDAK LANJUT') {
										fillColor = '#605ca8';
									} else if (statuspengaduan == 'SELESAI TINDAK LANJUT') {
										fillColor = '#00a65a';
									} else if (statuspengaduan == 'SELESAI TINDAK LANJUT BERSYARAT') {
										fillColor = '#01ff70';
									} else if (statuspengaduan == 'REKOMENDASI DITUNDA') {
										fillColor = '#605ca8';
									}
									return {
										color: "#000000",
										dashArray: '1',
										weight: 1,
										fillColor: fillColor,
										fillOpacity: 0.5
									}; // Berikan efek trasparan pada bagian "fillOpacity" agar basemap dapat terlihat
								},
								onEachFeature: function (feature, layer) {
									items.push(layer); // ini dibuat untuk menghubungkan variabel items ke dalam layer, ini berfungsi untuk menjalankan tool pencarian
									layer.bindTooltip("<center>" + feature.properties.nama + "</center>"),
											that = this;
									var customPopup =
											"<table class='table table-bordered'>" +
											"<tr><td>No Permohonan</td>" +
											"<td>" + feature.properties.nama + "</td></tr>" +
											"<tr><td>Kategori</td>" +
											"<td>" + feature.properties.kategori + "</td></tr>" +
											"<tr><td>Kepemilikan</td>" +
											"<td>" + feature.properties.kepemilikan + "</td></tr>" +
											"<tr><td>Kebutuhan</td>" +
											"<td>" + feature.properties.kebutuhan + "</td></tr>" +
											"<tr><td>Status</td>" +
											"<td>" + feature.properties.statuspengaduan + "</td></tr>" +
											"<tr><td colspan='2'><a href='<?php echo base_url(); ?>pengaduan-adm/detil/"+feature.properties.nopengaduan+"' target='_blank'>"+
												"<button type='button' class='btn bg-yellow btn-flat margin pull-right' style='margin: 0'>"+
													"<span class='fa fa-file-text-o' style='margin-right: 5px'></span>"+
													"Detil"+
												"</button>"+
											"</a></td></tr>" +
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
										$.get('<?php echo base_url(); ?>map/polaruang',
												{id: feature.properties.idpr},
												function (html) {
													$(".modal-body").html(html);
												}
										);
									});*/
								}
							}).addTo(peta); // layer peta polaruang ini ditmbahkan ke dalam variabel 'peta'

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
								"<span style='color: #3C8DBC; font-size: 14px'>LOKASI PERMOHONAN IZIN</span>": {
									"Status Permohonan (Point)<br><span style='font-size:12px'><img src='<?= base_url() ?>assets/map/legend/a.png' width='18' style='margin-left: 15px;'> PERSYARATAN BELUM LENGKAP<br><img src='<?= base_url() ?>assets/map/legend/b.png' width='18' style='margin-left: 15px;'> MENUNGGU VERIFIKASI PERSYARATAN<br><img src='<?= base_url() ?>assets/map/legend/c.png' width='18' style='margin-left: 15px;'> PERSYARATAN DITOLAK<br><img src='<?= base_url() ?>assets/map/legend/d.png' width='18' style='margin-left: 15px;'> PERSYARATAN DISETUJUI<br><img src='<?= base_url() ?>assets/map/legend/e.png' width='18' style='margin-left: 15px;'> PROSES PENCERMATAN</span><br><img src='<?= base_url() ?>assets/map/legend/f.png' width='18' style='margin-left: 15px;'> RAPAT PEMBAHASAN</span><br><img src='<?= base_url() ?>assets/map/legend/j.png' width='18' style='margin-left: 15px;'> PROSES TINDAK LANJUT</span><br><img src='<?= base_url() ?>assets/map/legend/h.png' width='18' style='margin-left: 15px;'> SELESAI TINDAK LANJUT</span>": layer_pengaduan.addTo(map),
									"Status Permohonan (Polygon)<br><span style='font-size:12px'><img src='<?= base_url() ?>assets/map/legend/aa.png' width='18' style='margin-left: 15px;'> PERSYARATAN BELUM LENGKAP<br><img src='<?= base_url() ?>assets/map/legend/bb.png' width='18' style='margin-left: 15px;'> MENUNGGU VERIFIKASI PERSYARATAN<br><img src='<?= base_url() ?>assets/map/legend/cc.png' width='18' style='margin-left: 15px;'> PERSYARATAN DITOLAK<br><img src='<?= base_url() ?>assets/map/legend/dd.png' width='18' style='margin-left: 15px;'> PERSYARATAN DISETUJUI<br><img src='<?= base_url() ?>assets/map/legend/ee.png' width='18' style='margin-left: 15px;'> PROSES PENCERMATAN</span><br><img src='<?= base_url() ?>assets/map/legend/ff.png' width='18' style='margin-left: 15px;'> RAPAT PEMBAHASAN</span><br><img src='<?= base_url() ?>assets/map/legend/jj.png' width='18' style='margin-left: 15px;'> PROSES TINDAK LANJUT</span><br><img src='<?= base_url() ?>assets/map/legend/hh.png' width='18' style='margin-left: 15px;'> SELESAI TINDAK LANJUT</span>": layer_polygon.addTo(map)
								},
								"<span style='color: #3C8DBC; font-size: 14px'>RENCANA TATA RUANG WILAYAH</span>": {
									"Pola Ruang<br><span style='font-size:12px'><img src='<?= base_url() ?>assets/map/legend/cagaralam.png' width='16' style='margin-left: 15px;'> Cagar Alam<br><img src='<?= base_url() ?>assets/map/legend/hl.png' width='16' style='margin-left: 15px;'> Hutan Lindung<br><img src='<?= base_url() ?>assets/map/legend/hpt.png' width='16' style='margin-left: 15px;'> Hutan Produksi Terbatas<br><img src='<?= base_url() ?>assets/map/legend/hp.png' width='16' style='margin-left: 15px;'> Hutan Produksi Tetap<br><img src='<?= base_url() ?>assets/map/legend/hankam.png' width='16' style='margin-left: 15px;'> Kawasan Hankam<br><img src='<?= base_url() ?>assets/map/legend/bakau.png' width='16' style='margin-left: 15px;'> Kawasan Pantai Berhutan Bakau<br><img src='<?= base_url() ?>assets/map/legend/perikanan.png' width='16' style='margin-left: 15px;'> Kawasan Perikanan Budidaya<br><img src='<?= base_url() ?>assets/map/legend/perkebunan.png' width='16' style='margin-left: 15px;'> Kawasan Perkebunan<br><img src='<?= base_url() ?>assets/map/legend/permukiman_desa.png' width='16' style='margin-left: 15px;'> Kawasan Permukiman Perdesaan<br><img src='<?= base_url() ?>assets/map/legend/permukiman_kota.png' width='16' style='margin-left: 15px;'> Kawasan Permukiman Perkotaan<br><img src='<?= base_url() ?>assets/map/legend/pertanian_basah.png' width='16' style='margin-left: 15px;'> Kawasan Pertanian Lahan Basah<br><img src='<?= base_url() ?>assets/map/legend/pertanian_kering.png' width='16' style='margin-left: 15px;'> Kawasan Pertanian Lahan Kering<br><img src='<?= base_url() ?>assets/map/legend/industri.png' width='16' style='margin-left: 15px;'> Kawasan Peruntukkan Industri<br><img src='<?= base_url() ?>assets/map/legend/tambang.png' width='16' style='margin-left: 15px;'> Kawasan Peruntukkan Pertambangan<br><img src='<?= base_url() ?>assets/map/legend/waduk.png' width='16' style='margin-left: 15px;'> Kawasan Tangkapan Air Waduk<br><img src='<?= base_url() ?>assets/map/legend/pariwisata.png' width='16' style='margin-left: 15px;'> Kawasan Wisata<br><img src='<?= base_url() ?>assets/map/legend/danau.png' width='16' style='margin-left: 15px;'> Danau<br><img src='<?= base_url() ?>assets/map/legend/wisata-alam.png' width='16' style='margin-left: 15px;'> Taman Wisata Alam</span>": polaruang.addTo(map),
								}
							};
							var options = {
								exclusiveGroups: [""], //checkbox
								//exclusiveGroups: ["KOTA BANDUNG"] //for radio
								position:'topright'
							};

							// MENAMPILKAN TOOLS UNTUK MEMILIH BASEMAP
							L.control.groupedLayers(baseLayers, overlays, options).addTo(map);

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
						<div class="leaflet-bottom leaflet-left" style="margin-bottom: 15px">
							<input type="button" id="Btn3" class="btnStyle span3 leaflet-control"/>
						</div>
					</a>
				</div>
			</div>
		</div>
		<div id="collapseTwo" class="panel-collapse collapse" style="padding: 10px">
			<div class="box box-success" style="margin-bottom: 0">
				<!-- /.box-header -->
				<div class="box-body">
					<div class="col-sm-12" style="padding: 0; overflow-x: scroll; overflow-y: hidden;">
						<table id="example1" class="table table-bordered table-striped" style="width: 1800px">
							<thead>
							<tr>
								<th style="width: 10px">#</th>
								<th width="9%"><span class="fa fa-gear"></span></th>
								<th>Nomor</th>
								<th>Status</th>
								<th>Tanggal</th>
								<th>KTP</th>
								<th>Pemohon</th>
								<th>Lokasi</th>
								<th>Kecamatan</th>
								<th>Kelurahan</th>
							</tr>
							</thead>
							<tbody>
							<?php $n=1; foreach ($pengaduan as $field) { ?>
								<tr>
									<td><?php echo $n++; ?></td>
									<td>
										<?php if (substr($field->polyline,0,3) == 'POL') {
											$center = $field->center;
											$lat = substr($center, strpos($center, "(") + 1,11);
											$lng = substr_replace(substr($center, strpos($center, " ") + 1,11),"", -1);
											?>
											<a href="#" class="zoom-map" data-id="<?= $lng; ?>" data-id2="<?= $lat; ?>" data-id3="<?= $field->nopengaduan; ?>">
												<button type="button" class="btn bg-aqua-gradient btn-flat margin" title="Zoom Peta" style="margin: 0; min-width: 40px">
													<span class="fa fa-search"></span>
												</button>
											</a>
										<?php } else { ?>
											<a href="#" class="zoom-map" data-id="<?= $field->lata; ?>" data-id2="<?= $field->lnga; ?>" data-id3="<?= $field->nopengaduan; ?>">
												<button type="button" class="btn bg-aqua-gradient btn-flat margin" title="Zoom Peta" style="margin: 0; min-width: 40px">
													<span class="fa fa-search"></span>
												</button>
											</a>
										<?php } ?>
									</td>
									<td><?php echo $field->nopengaduan; ?></td>
									<td class="text-bold"><?php echo $field->statuspengaduan; ?></td>
									<td><?php echo onlydate($field->tgl); ?></td>
									<td><?php echo $field->noktp; ?></td>
									<td><?php echo $field->namapemohon; ?></td>
									<td><?php echo $field->lokasi; ?></td>
									<td><?php echo $field->nama_kec; ?></td>
									<td><?php echo $field->nama_kel; ?></td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
	<div style="clear:both;"></div>
</div>
<!-- /.content-wrapper -->
<div style="clear:both;"></div>

<div id="myModalPermohonan" class="modal fade modal-success" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="icon fa fa-file-text-o"></i> Data Permohonan</h4>
			</div>
			<div class="modal-body">
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

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
        $(document).on('click', '.zoom-map', function (e) {
            e.preventDefault();
            /*var latlngs = [
                [9.102097,-10.564344],
				[24.527135,23.198966]
            ]; // Tinggal ambil kordinat polyline tapi kalau langsung dari mysql kebalik lat dan lng
            var polyline = L.polyline(latlngs, {color: 'red'}).addTo(map);
            map.fitBounds(polyline.getBounds());*/

            var marker = L.marker([$(this).attr('data-id'),$(this).attr('data-id2')]).addTo(map);
            marker.bindPopup("<b>No Reg: "+$(this).attr('data-id3')+"</b>").openPopup();
            map.flyTo([$(this).attr('data-id'),$(this).attr('data-id2')], 15);

            //alert("ID Jalan: "+$(this).attr('data-id'));
        });
    });
</script>