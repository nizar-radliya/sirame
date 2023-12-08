<style>
	#tabletip {
		font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		border-collapse: collapse;
		width: 100%;
	}

	#tabletip td, #tabletip th {
		border: 1px solid;
		padding: 8px;
		font-size: 12px;
	}

	#tabletip tr:nth-child(even){background-color: #4D5656;}

	#tabletip tr:hover {background-color: #4D5656;}

	#tabletip th {
		padding-top: 10px;
		padding-bottom: 10px;
		text-align: left;
	}
</style>

<?php $legend=''; foreach ($rtrw_kabbekasi_pr_ar as $field) { ?>
	<?php $legend.= "<div><div class='boxlegend' style='background-color: rgb(".$field->r.",".$field->g.",".$field->b.")'></div><span style='font-size:12px;'>".$field->namobj."</span></div><br style='display: block; content: ''; margin-bottom: 0em;'>"; ?>
<?php } ?>

<script>
	// MENGATUR TITIK KOORDINAT TITIK TENGAH & LEVEL ZOOM PADA BASEMAP
	var map = L.map('map', {attributionControl: false}).setView([-6.2591807, 107.1198117], 11);
	var peta = new L.LayerGroup();
	var items = [];

	// MENAMPILKAN SKALA
	L.control.scale({imperial: false}).addTo(map);
	// ------------------- VECTOR ----------------------------

	// menambahkan tools defautl extent
	L.control.defaultExtent().addTo(map);

	var measureControl = new L.Control.Measure({'position':'topleft'});
	measureControl.addTo(map);

	var toggle = L.easyButton({
		states: [{
			stateName: 'add-markers',
			icon: 'fa-street-view',
			title: 'Tampilan Jalan',
			onClick: function(control) {
				$('#modalSV').modal('show');
				map.on('click',
					function (e) {
						var coord = e.latlng.toString().split(',');
						var lat = coord[0].split('(');
						var lng = coord[1].split(')');
						console.log("You clicked the map at latitude: " + lat[1] + " and longitude:" + lng[0]);
						window.open('https://www.google.com/maps?layer=c&cbll=' + lat[1] + ',' + lng[0], '_blank');
					});
				control.state('remove-markers');
			}
		}, {
			icon: 'fa-undo',
			stateName: 'remove-markers',
			onClick: function(control) {
				map.on('click',
					function (e) {
						var coord = e.latlng.toString().split(',');
						var lat = coord[0].split('(');
						var lng = coord[1].split(')');
						console.log("You clicked the map at latitude: " + lat[1] + " and longitude:" + lng[0]);
					});
				control.state('add-markers');
				location.reload();
			},
			title: 'remove markers'
		}]
	});
	toggle.addTo(map);

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

	// my location
	lc = L.control.locate({
		strings: {
			title: "Lokasi Saya Saat Ini"
		},
		position: "topleft"
	}).addTo(map);

	// show coordinate
	L.control.mouseCoordinate({
		utm: true,
		utmref: true
	}).addTo(map);
	drawnItems = L.featureGroup().addTo(map);

	// better scale
	L.control.betterscale({
		metric: true,
		imperial: false
	}).addTo(map);

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

	var kkpr_ar = new L.GeoJSON.AJAX("<?php echo base_url(); ?>assets/map/layer/kkpr_ar.php", {
		style: function (feature) {
			return {
				color: '#000000',
				dashArray: '1',
				weight: 1,
				fillColor: '#FF0000',
				fillOpacity: 0.6
			}; // Berikan efek trasparan pada bagian "fillOpacity" agar basemap dapat terlihat
		},
		onEachFeature: function (feature, layer) {
			items.push(layer); // ini dibuat untuk menghubungkan variabel items ke dalam layer, ini berfungsi untuk menjalankan tool pencarian
			/*layer.bindTooltip("<center>" + feature.properties.namobj + "</center>"),
				that = this;*/
			var customPopup =
				"<table id='tabletip'>" +
				"<tr><td>Tahun</td>" +
				"<td>" + feature.properties.tahun + "</td></tr>" +
				"<tr><td>Pemohon</td>" +
				"<td>" + feature.properties.pemohon + "</td></tr>" +
				"<tr><td>Penggunaan Tanah</td>" +
				"<td>" + feature.properties.pgt + "</td></tr>" +
				"<tr><td>Jenis Peruntukan</td>" +
				"<td>" + feature.properties.rencana + "</td></tr>" +
				"<tr><td>Nomenklatur</td>" +
				"<td>" + feature.properties.nomenklatu + "</td></tr>" +
				"<tr><td>Luas</td>" +
				"<td>" + feature.properties.luas + "</td></tr>" +
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
	}).addTo(peta); // layer peta kkpr_ar ini ditmbahkan ke dalam variabel 'peta'

	// MENAMBAHKAN TOOL PENCARIAN
	function sortNama(a, b) {
		var _a = a.feature.properties.pemohon; // nama field yang akan dijadikan acuan di dalam tool pencarian

		var _b = b.feature.properties.pemohon; // nama field yang akan dijadikan acuan di dalam tool pencarian

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
		var _a = a.feature.properties.pemohon; // nama field yang akan dijadikan acuan di dalam tool pencarian

		var _b = b.feature.properties.pemohon; // nama field yang akan dijadikan acuan di dalam tool pencarian

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
			placeholder: ' Pencarian Objek Peta'
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
						if (x.feature.properties.pemohon != null) {
							return x.feature.properties.pemohon.toUpperCase().indexOf(value.toUpperCase()) > -1;
						}
					}).sort(sortNama), 10);
					_.map(results, function (x) {
						var a = L.DomUtil.create('a', 'list-group-item daftar');
						a.href = '';
						a.setAttribute('data-result-name', x.feature.properties.pemohon); // nama field yang akan dijadikan acuan di dalam tool pencarian

						a.innerHTML = x.feature.properties.pemohon; // nama field yang akan dijadikan acuan di dalam tool pencarian

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
				return x.feature.properties.pemohon === this.input.value; // nama field yang akan dijadikan acuan di dalam tool pencarian
			}, this);
			if (feature) {
				var geo = feature.toGeoJSON();
				var tipe = geo.geometry.type;
				//alert(tipe);
				if (tipe == 'Polygon' || tipe == 'MultiPolygon') {
					this._map.fitBounds(feature.getBounds());
					feature.bindTooltip(geo.properties.pemohon).openTooltip();
				} else if (tipe == 'LineString' || tipe == 'MultiLineString') {
					this._map.fitBounds(feature.getBounds());
					feature.bindTooltip(geo.properties.pemohon).openTooltip();
				} else if (tipe == 'Point') {
					this._map.flyTo(feature._latlng, 20);
					feature.bindTooltip(geo.properties.pemohon).openTooltip();
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

	const apiKey = "AAPK3abe08f0b93f4d47abd811e9083129f8r0vdhdwhQ0H5Le2P-7aOnguoOwEyt7APM_-OhkWGYIe9TijBNPLY0gNSNQor_iLQ";

	const basemapEnum = "ArcGIS:Navigation";

	const searchControl = L.esri.Geocoding.geosearch({
		position: "topleft",
		placeholder: "Pencarian Lokasi atau Alamat",
		useMapBounds: false,

		providers: [
			L.esri.Geocoding.arcgisOnlineProvider({
				apikey: apiKey,
				nearby: {
					lat: -6.8790467,
					lng: 107.5673461
				}
			})
		]

	}).addTo(map);

	const results = L.layerGroup().addTo(map);

	searchControl.on("results", (data) => {
		results.clearLayers();

		for (let i = data.results.length - 1; i >= 0; i--) {
			const marker = L.marker(data.results[i].latlng);

			const lngLatString = `${Math.round(data.results[i].latlng.lng * 100000) / 100000}, ${
				Math.round(data.results[i].latlng.lat * 100000) / 100000
			}`;
			marker.bindPopup(`<b>${lngLatString}</b><p>${data.results[i].properties.LongLabel}</p>`);

			results.addLayer(marker);

			marker.openPopup();

		}

	});

	var center = [40, 0];

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

	/*var rbi= L.esri.tiledMapLayer(
		{url: "https://portal.ina-sdi.or.id/arcgis/rest/services/RBI/Basemap/MapServer"}).addTo(map);*/

	var osm=L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png');

	//var imgesri=L.esri.basemapLayer("Imagery");
	var imgesri=L.esri.Vector.vectorBasemapLayer("ArcGIS:Imagery", {
		// provide either apikey or token
		apikey: apiKey
	});

	var options = {
		exclusiveGroups: [""],
		scrollbars: true,
		collapsed: false,
		autoZIndex: true
	};

	/*var baseTree = [
		{
			label: '<span style="font-weight: bold">BASE MAP</span>'
		},
		{
			label: '<span style="font-weight: bold">Pilihan Base Map</span>',
			children: [
				{
					label: ' Rupa Bumi Indonesia (RBI)',
					layer: rbi
				},
				{
					label: ' Open Street Map (OSM)',
					layer: osm
				},
				/!*{
					label: ' Image Esri',
					layer: imgesri
				},*!/
				{label: ' Google Street', layer: googleStreets},
				{label: ' Google Satellite', layer: googleSat.addTo(map)},
				{label: ' Google Hybrid', layer: googleHybrid},
				{label: ' Google Terrain', layer: googleTerrain},
			]
		},
	];*/

	/*{
		layer: rbi, //DEFAULT MAP
			icon: '<?php echo base_url(); ?>assets/map/basemaps/rbi.png',
		name: 'RBI'
	},*/

	var baseTree = [];

	var baseMap = new L.basemapsSwitcher([{
		layer: osm,
		icon: '<?php echo base_url(); ?>assets/map/basemaps/osm.png',
		name: 'OSM'
	}, {
		layer: googleStreets,
		icon: '<?php echo base_url(); ?>assets/map/basemaps/street.png',
		name: 'Street'
	}, {
		layer: googleSat.addTo(map),
		icon: '<?php echo base_url(); ?>assets/map/basemaps/satellite.png',
		name: 'Satellite'
	}, {
		layer: googleHybrid,
		icon: '<?php echo base_url(); ?>assets/map/basemaps/hybrid.png',
		name: 'Hybrid'
	}, {
		layer: googleTerrain,
		icon: '<?php echo base_url(); ?>assets/map/basemaps/terrain.png',
		name: 'Terrain'
	}, ], {
		position: 'bottomright'
	});
	baseMap.addTo(map);

	var overlaysTree = [
		{label: ' <div id="onlysel" style="margin-top: 0"><span style="font-weight: bold">PEMETAAN PKKPR</span></div>'},
		{label: " <span style='font-size:12px;'>PKKPR</span><br><div class='boxlegend' style='background-color: #FF0000'></div>", layer: kkpr_ar.addTo(map)},
		{label: ' <div id="onlysel" style="margin-top: 0"><span style="font-weight: bold">PETA DASAR</span></div>'},
		{label: " <img src='<?= base_url() ?>assets/map/legend/kec.png' width='103' style='margin-bottom:3px'><br><span style='margin-left: 18px'>Batas Kecamatan</span>", layer: batas_kecamatan_ar},
		{label: ' <div id="onlysel" style="margin-top: 0"><span style="font-weight: bold">RTRW KABUPATEN BEKASI</span></div>'},
		{label: " Pola Ruang<br><br><?= $legend; ?>", layer: rtrw_kabbekasi_pr_ar},
	]

	var lay = L.control.layers.tree(baseTree, overlaysTree,
		{
			namedToggle: true,
			selectorBack: false,
			collapsed: false,
		});

	lay.addTo(map).collapseTree().expandSelected().collapseTree(true);
	L.DomEvent.on(L.DomUtil.get('onlysel'), 'click', function() {
		lay.collapseTree(true).expandSelected(true);
	});

	// Call the getContainer routine.
	var htmlObject = lay.getContainer();
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

	map.addControl(new L.Control.Draw({
		edit: {
			featureGroup: drawnItems,
			marker: {
				allowIntersection: true
			},
			poly: {
				allowIntersection: true
			},
			rectangle: {
				allowIntersection: true
			}
		},
		draw: {
			rectangle: true,
			circle: true,
			circlemarker: false,
			marker: true,
			polyline: true,
			polygon: {
				allowIntersection: false,
				showArea: true
			}
		}
	}));

	map.on(L.Draw.Event.CREATED, function (event) {

		var types = event.layerType;
		var layer = event.layer;

		drawnItems.addLayer(layer);
		var shape = layer.toGeoJSON();
		var coordinates = JSON.stringify(shape.geometry.coordinates);
		if (types == 'marker') {
			var xlng = coordinates.substring(
				coordinates.lastIndexOf("[") + 1,
				coordinates.lastIndexOf(",")
			);
			var ylat = coordinates.substring(
				coordinates.lastIndexOf(",") + 1,
				coordinates.lastIndexOf("]")
			);
			layer.bindPopup('Koordinat : ' + xlng + ' , ' + ylat);
			event.layer.openPopup();
		} else if (types == 'polygon' || types == 'rectangle') {
			var area = L.GeometryUtil.geodesicArea(layer.getLatLngs()[0]);
			var readableArea = L.GeometryUtil.readableArea(area, true);

			layer.bindPopup('Luas : ' + readableArea);
			event.layer.openPopup();
		} else if (types == 'polyline') {
			// Calculating the distance of the polyline
			var tempLatLng = null;
			var totalDistance = 0.00000;
			$.each(event.layer._latlngs, function(i, latlng){
				if(tempLatLng == null){
					tempLatLng = latlng;
					return;
				}
				totalDistance += tempLatLng.distanceTo(latlng);
				tempLatLng = latlng;
			});
			layer.bindPopup('Panjang : ' + (totalDistance).toFixed(2) + ' m');
			event.layer.openPopup();
		}

	});

	map.on(L.Draw.Event.DELETED, function (event) {

	});

	map.on(L.Draw.Event.EDITED, function (e) {
		var layers = e.layers;

		layers.eachLayer(function (layer) {
			if (layer instanceof L.Marker) {
				var shape = layer.toGeoJSON();
				var coordinates = JSON.stringify(shape.geometry.coordinates);
				var xlng = coordinates.substring(
					coordinates.lastIndexOf("[") + 1,
					coordinates.lastIndexOf(",")
				);
				var ylat = coordinates.substring(
					coordinates.lastIndexOf(",") + 1,
					coordinates.lastIndexOf("]")
				);
				layer.bindPopup('Koordinat : ' + xlng + ' , ' + ylat);
				layer.openPopup();
			} else if (layer instanceof L.Polygon) {
				var area = L.GeometryUtil.geodesicArea(layer.getLatLngs()[0]);
				var readableArea = L.GeometryUtil.readableArea(area, true);

				layer.bindPopup('Luas : ' + readableArea);
				layer.openPopup();
			} else if (layer instanceof L.Polyline) {
				// Calculating the distance of the polyline
				var tempLatLng = null;
				var totalDistance = 0.00000;
				$.each(layer._latlngs, function(i, latlng){
					if(tempLatLng == null){
						tempLatLng = latlng;
						return;
					}
					totalDistance += tempLatLng.distanceTo(latlng);
					tempLatLng = latlng;
				});
				layer.bindPopup('Panjang : ' + (totalDistance).toFixed(2) + ' m');
				layer.openPopup();
			}
		});
	});

	var info = L.control({position:'topright'});
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
					'<tr><td style="padding: 2px">' + props.namobj + '</td></tr>' +
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
			this._div.innerHTML = '<h4 style="font-style: italic; text-align: center">Informasi Peta</h4>';
		}
	};
	info.addTo(map);
</script>
