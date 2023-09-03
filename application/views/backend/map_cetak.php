<style>
	/* style sheet for "A4" printing */
	@media print and (width: 21cm) and (height: 29.7cm) {
		@page {
			margin: 1cm;
		}
	}

	/* style sheet for "letter" printing */
	@media print and (width: 8.5in) and (height: 11in) {
		@page {
			margin: 1in;
		}
	}

	/* A4 Landscape*/
	@page {
		size: A4 landscape;
		margin: 5%;
	}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<button type="button" onclick="printDiv('area')" class="btn bg-black btn-flat margin" title="Cetak"
					style="margin: 0;">
				<span class="fa fa-print" style="margin-right: 5px"></span> Cetak
			</button>
		</h1>
	</section>
	<section class="content" id="area">
		<table class="table table-cetak" style="text-align: justify; margin-bottom: 0; background-color: #FFFFFF">
			<tr>
				<td width="70%" rowspan="6" style="padding: 5px; height: 500px;">
					<div id="map">
						<!-- ini id="map" bisa di ganti dengan nama yang di inginkan -->
						<script>
							// MENGATUR TITIK KOORDINAT TITIK TENGAH & LEVEL ZOOM PADA BASEMAP
							var map = L.map('map', {attributionControl: false}).setView([0.1308394, 116.7012803], 7);
							var peta = new L.LayerGroup();
							var items = [];

							// MENAMPILKAN SKALA
							L.control.scale({imperial: false}).addTo(map);
							// ------------------- VECTOR ----------------------------

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
								scrollbars: true,
								collapsed: false,
								autoZIndex: true
							};

							// MENAMPILKAN TOOLS UNTUK MEMILIH BASEMAP
							//L.control.groupedLayers(baseLayers, overlays, options).addTo(map);

							var info = L.control();
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
				</td>
				<td colspan="4" style="padding: 5px; text-align: center">
					<img src="<?php echo base_url(); ?>assets/lte/img/iconmap.png" width="60"><br>
					<label style="font-size: 14px">PEMERINTAH KABUPATEN SUBANG</label>
					<br>
					<label style="font-size: 12px">DINAS PEKERJAAN UMUM DAN PENATAAN RUANG</label>
				</td>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center; padding: 5px;">
					<img src="<?php echo base_url(); ?>assets/lte/img/compas.png" width="30"><br>
					<span style="text-align: left; font-size: 10px;">
					Proyeksi: Geografi <br>
					Ellipsoid Referensi: WGS 84 <br>
					Sistem Grid: Grid Geografi
					</span>
				</td>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center"><label>SUMBER DATA</label></td>
			</tr>
			<tr style="height: 100%;">
				<td colspan="3">
					1. Pemerintah Kabupaten Subang<br>
					2. RTRW Kabupaten Subang
				</td>
			</tr>
		</table>
	</section>
</div>
<!-- /.content-wrapper -->
<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        setTimeout(function() {
            window.print();
        }, 250);

        document.body.innerHTML = originalContents;
    }
</script>
