<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content" style="height: 100%; padding: 0 10px;">
		<div class="row">
			<div class="col-md-12" style="padding: 0;height: 525px;">

				<div id="map"> <!-- ini id="map" bisa di ganti dengan nama yang di inginkan -->
					<a data-toggle="collapse" href="#collapseTwo" title="Data Atribut Peta">

						<script>
							// MENGATUR TITIK KOORDINAT TITIK TENGAH & LEVEL ZOOM PADA BASEMAP
							var map = L.map('map', {attributionControl: false}).setView([-0.122872, 104.584387], 9);
							var peta = new L.LayerGroup();
							var items = [];

							// MENAMPILKAN SKALA
							L.control.scale({imperial: false}).addTo(map);
							// ------------------- VECTOR ----------------------------

							var layer_permohonan = new L.GeoJSON.AJAX("<?php echo base_url(); ?>assets/map/layer/permohonan_layer.php", { // layer geologi berada di dalam variabel layer_geologi
								style: function (feature) {
									return {
										iconSize: [20, 20]
									}; // Berikan efek trasparan pada bagian "fillOpacity" agar basemap dapat terlihat
								},
								onEachFeature: function (feature, layer) {
									var statuspermohonan = feature.properties.statuspermohonan;
									if (statuspermohonan == 'PERSYARATAN BELUM LENGKAP') {
										var bangunanIcon = L.icon({
											iconUrl: '<?= base_url() ?>assets/map/legend/a.png',
											iconSize: [20, 20]
										});
									} else if (statuspermohonan == 'MENUNGGU VERIFIKASI PERSYARATAN') {
										var bangunanIcon = L.icon({
											iconUrl: '<?= base_url() ?>assets/map/legend/b.png',
											iconSize: [20, 20]
										});
									} else if (statuspermohonan == 'PERSYARATAN DITOLAK') {
										var bangunanIcon = L.icon({
											iconUrl: '<?= base_url() ?>assets/map/legend/c.png',
											iconSize: [20, 20]
										});
									} else if (statuspermohonan == 'PERSYARATAN DISETUJUI') {
										var bangunanIcon = L.icon({
											iconUrl: '<?= base_url() ?>assets/map/legend/d.png',
											iconSize: [20, 20]
										});
									} else if (statuspermohonan == 'PROSES SURVEY') {
										var bangunanIcon = L.icon({
											iconUrl: '<?= base_url() ?>assets/map/legend/e.png',
											iconSize: [20, 20]
										});
									} else if (statuspermohonan == 'RAPAT TKPRD') {
										var bangunanIcon = L.icon({
											iconUrl: '<?= base_url() ?>assets/map/legend/f.png',
											iconSize: [20, 20]
										});
									} else if (statuspermohonan == 'REKOMENDASI DITOLAK') {
										var bangunanIcon = L.icon({
											iconUrl: '<?= base_url() ?>assets/map/legend/g.png',
											iconSize: [20, 20]
										});
									} else if (statuspermohonan == 'REKOMENDASI DISETUJUI') {
										var bangunanIcon = L.icon({
											iconUrl: '<?= base_url() ?>assets/map/legend/h.png',
											iconSize: [20, 20]
										});
									} else if (statuspermohonan == 'REKOMENDASI DISETUJUI BERSYARAT') {
										var bangunanIcon = L.icon({
											iconUrl: '<?= base_url() ?>assets/map/legend/i.png',
											iconSize: [20, 20]
										});
									} else if (statuspermohonan == 'REKOMENDASI DITUNDA') {
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
										var statuspermohonan = feature.properties.statuspermohonan;
										if (statuspermohonan == 'PERSYARATAN BELUM LENGKAP') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/a.png',
												iconSize: [25, 25]
											});
										} else if (statuspermohonan == 'MENUNGGU VERIFIKASI PERSYARATAN') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/b.png',
												iconSize: [25, 25]
											});
										} else if (statuspermohonan == 'PERSYARATAN DITOLAK') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/c.png',
												iconSize: [25, 25]
											});
										} else if (statuspermohonan == 'PERSYARATAN DISETUJUI') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/d.png',
												iconSize: [25, 25]
											});
										} else if (statuspermohonan == 'PROSES SURVEY') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/e.png',
												iconSize: [25, 25]
											});
										} else if (statuspermohonan == 'RAPAT TKPRD') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/f.png',
												iconSize: [25, 25]
											});
										} else if (statuspermohonan == 'REKOMENDASI DITOLAK') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/g.png',
												iconSize: [25, 25]
											});
										} else if (statuspermohonan == 'REKOMENDASI DISETUJUI') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/h.png',
												iconSize: [25, 25]
											});
										} else if (statuspermohonan == 'REKOMENDASI DISETUJUI BERSYARAT') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/i.png',
												iconSize: [25, 25]
											});
										} else if (statuspermohonan == 'REKOMENDASI DITUNDA') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/j.png',
												iconSize: [25, 25]
											});
										}
										layer.setIcon(bangunanIcon);
										info.update(layer.feature.properties);
									});
									layer.on('mouseout', function (e) {
										var statuspermohonan = feature.properties.statuspermohonan;
										if (statuspermohonan == 'PERSYARATAN BELUM LENGKAP') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/a.png',
												iconSize: [20, 20]
											});
										} else if (statuspermohonan == 'MENUNGGU VERIFIKASI PERSYARATAN') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/b.png',
												iconSize: [20, 20]
											});
										} else if (statuspermohonan == 'PERSYARATAN DITOLAK') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/c.png',
												iconSize: [20, 20]
											});
										} else if (statuspermohonan == 'PERSYARATAN DISETUJUI') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/d.png',
												iconSize: [20, 20]
											});
										} else if (statuspermohonan == 'PROSES SURVEY') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/e.png',
												iconSize: [20, 20]
											});
										} else if (statuspermohonan == 'RAPAT TKPRD') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/f.png',
												iconSize: [20, 20]
											});
										} else if (statuspermohonan == 'REKOMENDASI DITOLAK') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/g.png',
												iconSize: [20, 20]
											});
										} else if (statuspermohonan == 'REKOMENDASI DISETUJUI') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/h.png',
												iconSize: [20, 20]
											});
										} else if (statuspermohonan == 'REKOMENDASI DISETUJUI BERSYARAT') {
											var bangunanIcon = L.icon({
												iconUrl: '<?= base_url() ?>assets/map/legend/i.png',
												iconSize: [20, 20]
											});
										} else if (statuspermohonan == 'REKOMENDASI DITUNDA') {
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
										$.get('<?php echo base_url(); ?>sipetarung/permohonan',
												{id: feature.properties.nopermohonan},
												function (html) {
													$(".modal-body").html(html);
												}
										);
									});
								}
							}).addTo(peta); // layer peta permohonan ini ditambahkan ke dalam variabel 'peta'

							var layer_hutan = new L.GeoJSON.AJAX("<?php echo base_url(); ?>assets/map/layer/hutan.php", {
								style: function (feature) {
									var fillColor;
									fillColor = '#99ffb3';
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
										"<tr><td>Kode Area</td>" +
										"<td>" + feature.properties.nama + "</td></tr>" +
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

							var layer_polygon = new L.GeoJSON.AJAX("<?php echo base_url(); ?>assets/map/layer/permohonan_layer.php", {
								style: function (feature) {
									var fillColor, statuspermohonan = feature.properties.statuspermohonan;
									if (statuspermohonan == 'PERSYARATAN BELUM LENGKAP') {
										fillColor = '#d2d6de';
									} else if (statuspermohonan == 'MENUNGGU VERIFIKASI PERSYARATAN') {
										fillColor = '#111111';
									} else if (statuspermohonan == 'PERSYARATAN DITOLAK') {
										fillColor = '#f012be';
									} else if (statuspermohonan == 'PERSYARATAN DISETUJUI') {
										fillColor = '#f39c12';
									} else if (statuspermohonan == 'PROSES SURVEY') {
										fillColor = '#00c0ef';
									} else if (statuspermohonan == 'RAPAT TKPRD') {
										fillColor = '#0073b7';
									} else if (statuspermohonan == 'REKOMENDASI DITOLAK') {
										fillColor = '#d81b60';
									} else if (statuspermohonan == 'REKOMENDASI DISETUJUI') {
										fillColor = '#00a65a';
									} else if (statuspermohonan == 'REKOMENDASI DISETUJUI BERSYARAT') {
										fillColor = '#01ff70';
									} else if (statuspermohonan == 'REKOMENDASI DITUNDA') {
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
											"<td>" + feature.properties.statuspermohonan + "</td></tr>" +
											"<tr><td colspan='2'><a href='<?php echo base_url(); ?>permohonan-adm/detil/"+feature.properties.nopermohonan+"' target='_blank'>"+
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

							var layer_polaruang = new L.GeoJSON.AJAX("<?php echo base_url(); ?>assets/map/layer/pola_ruang.php", {
								style: function (feature) {
									var fillColor, fungsi = feature.properties.fungsi;
									if (fungsi == 'Holtikultura') {
										fillColor = '#e6ffe6';
									} else if (fungsi == 'Hutan Lindung') {
										fillColor = '#e0ffe6';
									} else if (fungsi == 'Hutan Kota') {
										fillColor = '#dbffd6';
									} else if (fungsi == 'Hutan Produksi Konversi') {
										fillColor = '#99ffb3';
									} else if (fungsi == 'Hutan Produksi Terbatas') {
										fillColor = '#b3e6e6';
									} else if (fungsi == 'Hutan Tanaman Rakyat') {
										fillColor = '#99f2cc';
									} else if (fungsi == 'Industri') {
										fillColor = '#e6e6b3';
									} else if (fungsi == 'Kawasan Lindung Pulau Kecil') {
										fillColor = '#f5ffe6';
									} else if (fungsi == 'Pariwisata') {
										fillColor = '#ffe6ff';
									} else if (fungsi == 'Perikanan') {
										fillColor = '#73b2ff';
									} else if (fungsi == 'Perkebunan') {
										fillColor = '#ccff80';
									} else if (fungsi == 'Permukiman Pedesaan') {
										fillColor = '#ffcc4c';
									} else if (fungsi == 'Permukiman Perkotaan') {
										fillColor = '#ffb340';
									} else if (fungsi == 'Peternakan') {
										fillColor = '#f2fff2';
									} else if (fungsi == 'Pusat Pemerintahan') {
										fillColor = '#ff00ff';
									} else if (fungsi == 'Resapan Air') {
										fillColor = '#e8ffe0';
									} else if (fungsi == 'Sungai') {
										fillColor = '#005ce6';
									} else if (fungsi == 'Tanaman Pangan') {
										fillColor = '#f2f7f7';
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
									var customPopup =
										"<table class='table' style='color: #ffffff'>" +
										"<tr><th>Sub Zona</th>" +
										"<td>" + feature.properties.fungsi + "</td></tr>" +
										"<tr><th>Pulau</th>" +
										"<td>" + feature.properties.pulau + "</td></tr>" +
										"<tr><th>Kecamatan</th>" +
										"<td>" + feature.properties.kec + "</td></tr>" +
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

							var layer_adm = new L.GeoJSON.AJAX("<?php echo base_url(); ?>assets/map/layer/adm_layer.php", {
								style: function (feature) {
									var linecolor, weight;
									linecolor = '#000000';
									weight = 1;
									return {color: linecolor, weight: weight, dashArray: '3 4 4'}; // Berikan efek trasparan pada bagian "fillOpacity" agar basemap dapat terlihat
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
										layer_adm.resetStyle(e.target);
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
									"<img src='<?= base_url() ?>assets/map/legend/kec.png' width='103' style='margin-bottom:3px'><br><span style='margin-left: 18px'>Batas Administrasi</span>": layer_adm.addTo(map),
								},
								"<span style='color: #3C8DBC; font-size: 14px'>LOKASI PERMOHONAN IZIN</span>": {
									"Status Permohonan (Point)<br><span style='font-size:12px'><img src='<?= base_url() ?>assets/map/legend/a.png' width='18' style='margin-left: 15px;'> PERSYARATAN BELUM LENGKAP<br><img src='<?= base_url() ?>assets/map/legend/b.png' width='18' style='margin-left: 15px;'> MENUNGGU VERIFIKASI PERSYARATAN<br><img src='<?= base_url() ?>assets/map/legend/c.png' width='18' style='margin-left: 15px;'> PERSYARATAN DITOLAK<br><img src='<?= base_url() ?>assets/map/legend/d.png' width='18' style='margin-left: 15px;'> PERSYARATAN DISETUJUI<br><img src='<?= base_url() ?>assets/map/legend/e.png' width='18' style='margin-left: 15px;'> PROSES SURVEY</span><br><img src='<?= base_url() ?>assets/map/legend/f.png' width='18' style='margin-left: 15px;'> RAPAT TKPRD</span><br><img src='<?= base_url() ?>assets/map/legend/g.png' width='18' style='margin-left: 15px;'> REKOMENDASI DITOLAK</span><br><img src='<?= base_url() ?>assets/map/legend/h.png' width='18' style='margin-left: 15px;'> REKOMENDASI DISETUJUI<br><img src='<?= base_url() ?>assets/map/legend/i.png' width='18' style='margin-left: 15px;'> REKOMENDASI DISETUJUI BERSYARAT<br><img src='<?= base_url() ?>assets/map/legend/j.png' width='18' style='margin-left: 15px;'> REKOMENDASI DITUNDA</span>": layer_permohonan.addTo(map),
									"Status Permohonan (Polygon)<br><span style='font-size:12px'><img src='<?= base_url() ?>assets/map/legend/aa.png' width='18' style='margin-left: 15px;'> PERSYARATAN BELUM LENGKAP<br><img src='<?= base_url() ?>assets/map/legend/bb.png' width='18' style='margin-left: 15px;'> MENUNGGU VERIFIKASI PERSYARATAN<br><img src='<?= base_url() ?>assets/map/legend/cc.png' width='18' style='margin-left: 15px;'> PERSYARATAN DITOLAK<br><img src='<?= base_url() ?>assets/map/legend/dd.png' width='18' style='margin-left: 15px;'> PERSYARATAN DISETUJUI<br><img src='<?= base_url() ?>assets/map/legend/ee.png' width='18' style='margin-left: 15px;'> PROSES SURVEY</span><br><img src='<?= base_url() ?>assets/map/legend/ff.png' width='18' style='margin-left: 15px;'> RAPAT TKPRD</span><br><img src='<?= base_url() ?>assets/map/legend/gg.png' width='18' style='margin-left: 15px;'> REKOMENDASI DITOLAK</span><br><img src='<?= base_url() ?>assets/map/legend/hh.png' width='18' style='margin-left: 15px;'> REKOMENDASI DISETUJUI<br><img src='<?= base_url() ?>assets/map/legend/ii.png' width='18' style='margin-left: 15px;'> REKOMENDASI DISETUJUI BERSYARAT<br><img src='<?= base_url() ?>assets/map/legend/jj.png' width='18' style='margin-left: 15px;'> REKOMENDASI DITUNDA</span>": layer_polygon.addTo(map)
								},
								"<span style='color: #3C8DBC; font-size: 14px'>POLA RUANG</span>": {
									"Pola Ruang<br><span style='font-size:12px'><img src='<?= base_url() ?>assets/map/legend/holti.png' width='16' style='margin-left: 15px;'> Holtikultura<br><img src='<?= base_url() ?>assets/map/legend/hl.png' width='16' style='margin-left: 15px;'> Hutan Lindung<br><img src='<?= base_url() ?>assets/map/legend/hk.png' width='16' style='margin-left: 15px;'> Hutan Kota<br><img src='<?= base_url() ?>assets/map/legend/hpk.png' width='16' style='margin-left: 15px;'> Hutan Produksi Konversi<br><img src='<?= base_url() ?>assets/map/legend/hpt.png' width='16' style='margin-left: 15px;'> Hutan Produksi Terbatas<br><img src='<?= base_url() ?>assets/map/legend/htr.png' width='16' style='margin-left: 15px;'> Hutan Tanaman Rakyat<br><img src='<?= base_url() ?>assets/map/legend/industri.png' width='16' style='margin-left: 15px;'> Industri<br><img src='<?= base_url() ?>assets/map/legend/pariwisata.png' width='16' style='margin-left: 15px;'> Pariwisata<br><img src='<?= base_url() ?>assets/map/legend/perikanan.png' width='16' style='margin-left: 15px;'> Perikanan<br><img src='<?= base_url() ?>assets/map/legend/perkebunan.png' width='16' style='margin-left: 15px;'> Perkebunan<br><img src='<?= base_url() ?>assets/map/legend/permukiman_desa.png' width='16' style='margin-left: 15px;'> Permukiman Pedesaan<br><img src='<?= base_url() ?>assets/map/legend/permukiman_kota.png' width='16' style='margin-left: 15px;'> Permukiman Perkotaan<br><img src='<?= base_url() ?>assets/map/legend/peternakan.png' width='16' style='margin-left: 15px;'> Peternakan<br><img src='<?= base_url() ?>assets/map/legend/pemerintah.png' width='16' style='margin-left: 15px;'> Pusat Pemerintah<br><img src='<?= base_url() ?>assets/map/legend/resapan.png' width='16' style='margin-left: 15px;'> Resapan Air<br><img src='<?= base_url() ?>assets/map/legend/sungai.png' width='16' style='margin-left: 15px;'> Sungai<br><img src='<?= base_url() ?>assets/map/legend/tanaman.png' width='16' style='margin-left: 15px;'> Tanaman Pangan</span>": layer_polaruang,
								},
								"<span style='color: #3C8DBC; font-size: 14px'>HUTAN</span>": {
									"<span style='font-size:12px'><img src='<?= base_url() ?>assets/map/legend/hpk.png' width='16'> Hutan</span>": layer_hutan.addTo(map),
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
									if (props.nopermohonan != undefined) {
										this._div.innerHTML = '<h4 style="font-style: italic; text-align: center; margin-bottom: 10px">Data Permohonan</h4>' + (props ?
												'<table class="table table-bordered" style="text-align: justify; margin: 0;">' +
												'<tr><th style="padding: 2px 0">Nomor Registrasi</th><td style="padding: 2px">:</td><td style="padding: 2px">' + props.nopermohonan + '</td></tr>' +
												'<tr><th style="padding: 2px 0">Kategori</th><td style="padding: 2px">:</td><td style="padding: 2px">' + props.kategori + '</td></tr>' +
												'<tr><th style="padding: 2px 0">Kepemilikan</th><td style="padding: 2px">:</td><td style="padding: 2px">' + props.kepemilikan + '</td></tr>' +
												'<tr><th style="padding: 2px 0">Status</th><td style="padding: 2px">:</td><td style="padding: 2px">' + props.statuspermohonan + '</td></tr>' +
												'</table>'
												: '');
									} else if (props.idperkotaan != undefined) {
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
								<th>No KTP</th>
								<th>Pemohon</th>
								<th>Kategori</th>
								<th>Kepemilikan</th>
								<th>Kebutuhan</th>
								<th>Nomor Surat</th>
								<th>Tanggal Surat</th>
								<th>Pemanfaatan</th>
								<th>Kecamatan</th>
								<th>Luas (m2)</th>
							</tr>
							</thead>
							<tbody>
							<?php $n=1; foreach ($permohonan as $field) { ?>
								<tr>
									<td><?php echo $n++; ?></td>
									<td>
										<?php if (substr($field->polyline,0,3) == 'POL') {
											$center = $field->center;
											$lat = substr($center, strpos($center, "(") + 1,11);
											$lng = substr_replace(substr($center, strpos($center, " ") + 1,11),"", -1);
											?>
											<a href="#" class="zoom-map" data-id="<?= $lng; ?>" data-id2="<?= $lat; ?>" data-id3="<?= $field->nopermohonan; ?>">
												<button type="button" class="btn bg-aqua-gradient btn-flat margin" title="Zoom Peta" style="margin: 0; min-width: 40px">
													<span class="fa fa-search"></span>
												</button>
											</a>
										<?php } else { ?>
											<a href="#" class="zoom-map" data-id="<?= $field->lata; ?>" data-id2="<?= $field->lnga; ?>" data-id3="<?= $field->nopermohonan; ?>">
												<button type="button" class="btn bg-aqua-gradient btn-flat margin" title="Zoom Peta" style="margin: 0; min-width: 40px">
													<span class="fa fa-search"></span>
												</button>
											</a>
										<?php } ?>
									</td>
									<td><?php echo $field->nopermohonan; ?></td>
									<td><?php echo $field->statuspermohonan; ?></td>
									<td><?php echo onlydate($field->tgl); ?></td>
									<td><?php echo $field->noktp; ?></td>
									<td><?php echo $field->namapemohon; ?></td>
									<td><?php echo $field->kategori; ?></td>
									<td><?php echo $field->kepemilikan; ?></td>
									<td><?php echo $field->kebutuhan; ?></td>
									<td><?php echo $field->nosurat; ?></td>
									<td><?php echo onlydate($field->tglsurat); ?></td>
									<td><?php echo $field->pemanfaatan; ?></td>
									<td><?php echo $field->nama_kec; ?></td>
									<td><?php echo $field->luas; ?></td>
								</tr>
							<?php } ?>
							</tbody>
							<tfoot>
							<tr>
								<th>#</th>
								<th><span class="fa fa-gear"></span></th>
								<th>Nomor</th>
								<th>Status</th>
								<th>Tanggal</th>
								<th>No KTP</th>
								<th>Pemohon</th>
								<th>Kategori</th>
								<th>Kepemilikan</th>
								<th>Kebutuhan</th>
								<th>Nomor Surat</th>
								<th>Tanggal Surat</th>
								<th>Pemanfaatan</th>
								<th>Kecamatan</th>
								<th>Luas (m2)</th>
							</tr>
							</tfoot>
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
