<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Grafik Permohonan
			<small><?= webname() ?></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>pengaduan-adm"><i class="fa fa-file-text-o"></i>Permohonan</li></a></li>
			<li class="active"><i class="fa fa-bar-chart"></i> Grafik</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">

		<?php
		if ($pengaduan1 > 0) {
			$p1 = $pengaduan1 / $pengaduan * 100;
		} else {
			$p1 = 0;
		}
		if ($pengaduan2 > 0) {
			$p2 = $pengaduan2 / $pengaduan * 100;
		} else {
			$p2 = 0;
		}
		if ($pengaduan3 > 0) {
			$p3 = $pengaduan3 / $pengaduan * 100;
		} else {
			$p3 = 0;
		}
		if ($pengaduan4 > 0) {
			$p4 = $pengaduan4 / $pengaduan * 100;
		} else {
			$p4 = 0;
		}
		if ($pengaduan5 > 0) {
			$p5 = $pengaduan5 / $pengaduan * 100;
		} else {
			$p5 = 0;
		}
		if ($pengaduan6 > 0) {
			$p6 = $pengaduan6 / $pengaduan * 100;
		} else {
			$p6 = 0;
		}
		if ($pengaduan7 > 0) {
			$p7 = $pengaduan7 / $pengaduan * 100;
		} else {
			$p7 = 0;
		}
		if ($pengaduan8 > 0) {
			$p8 = $pengaduan8 / $pengaduan * 100;
		} else {
			$p8 = 0;
		}
		?>

		<div class="box box-success">
			<div class="box-header with-border">
				<select class="form-control select2" name="" id="iddi" style="width: auto" onchange="javascript:location.href = this.value;">
					<option disabled>Pilih Tahun Permohonan</option>
					<option selected>Semua Tahun</option>
					<?php foreach ($tahun as $field) { ?>
					<option value="<?php echo base_url(); ?>pengaduan-adm/grafik-pertahun/<?= $field->year; ?>"><?= $field->year; ?></option>
					<?php } ?>
				</select>
				<a href="<?php echo base_url(); ?>pengaduan">
					<button type="button" class="btn btn-flat pull-right">
						<?= $pengaduan ?> PERMOHONAN
					</button>
				</a>
			</div>
			<div class="box-body">
				<div class="col-sm-6" style="padding: 0;">
					<table class="table table-bordered" style="margin-bottom: 0">
						<tr>
							<th style="width: 10px">#</th>
							<th>STATUS PERMOHONAN</th>
							<th style="width: 100px">JUMLAH</th>
							<th style="width: 100px">PROSENTASE</th>
						</tr>
						<tr>
							<td>1.</td>
							<td>PERSYARATAN BELUM LENGKAP</td>
							<td><span class="badge bg-gray"><?= $pengaduan1 ?></span></td>
							<td><span class="badge bg-gray"><?= number_format($p1,2) ?>%</span></td>
						</tr>
						<tr>
							<td>2.</td>
							<td>MENUNGGU VERIFIKASI PERSYARATAN</td>
							<td><span class="badge bg-black"><?= $pengaduan2 ?></span></td>
							<td><span class="badge bg-black"><?= number_format($p2,2) ?>%</span></td>
						</tr>
						<tr>
							<td>3.</td>
							<td>PERSYARATAN DITOLAK</td>
							<td><span class="badge bg-fuchsia"><?= $pengaduan3 ?></span></td>
							<td><span class="badge bg-fuchsia"><?= number_format($p3,2) ?>%</span></td>
						</tr>
						<tr>
							<td>4.</td>
							<td>PERSYARATAN DISETUJUI</td>
							<td><span class="badge bg-yellow"><?= $pengaduan4 ?></span></td>
							<td><span class="badge bg-yellow"><?= number_format($p4,2) ?>%</span></td>
						</tr>
						<tr>
							<td>5.</td>
							<td>SURVEI LAPANGAN</td>
							<td><span class="badge bg-aqua"><?= $pengaduan5 ?></span></td>
							<td><span class="badge bg-aqua"><?= number_format($p5,2) ?>%</span></td>
						</tr>
						<tr>
							<td>6.</td>
							<td>PENGKAJIAN TEKNIS</td>
							<td><span class="badge bg-blue"><?= $pengaduan6 ?></span></td>
							<td><span class="badge bg-blue"><?= number_format($p6,2) ?>%</span></td>
						</tr>
						<tr>
							<td>7.</td>
							<td>DRAFT SURAT</td>
							<td><span class="badge bg-purple"><?= $pengaduan7 ?></span></td>
							<td><span class="badge bg-purple"><?= number_format($p7,2) ?>%</span></td>
						</tr>
						<tr>
							<td>8.</td>
							<td>PENOMORAN SURAT</td>
							<td><span class="badge bg-green"><?= $pengaduan8 ?></span></td>
							<td><span class="badge bg-green"><?= number_format($p8,2) ?>%</span></td>
						</tr>
					</table>
				</div>
				<div class="col-sm-6" style="padding: 0; text-align: center">
					<canvas id="pieChart" style="height:250px; margin-top: 50px"></canvas>
					<div class="btn-group" style="margin-top: 10px">
						<button type="button" class="btn btn-default btn-xs btn-flat bg-gray" title="PERSYARATAN BELUM LENGKAP">1</button>
						<button type="button" class="btn btn-default btn-xs btn-flat bg-black" title="MENUNGGU VERIFIKASI PERSYARATAN">2</button>
						<button type="button" class="btn btn-default btn-xs btn-flat bg-fuchsia" title="PERSYARATAN DITOLAK">3</button>
						<button type="button" class="btn btn-default btn-xs btn-flat bg-yellow" title="PERSYARATAN DISETUJUI">4</button>
						<button type="button" class="btn btn-default btn-xs btn-flat bg-aqua" title="PROSES PENCERMATAN">5</button>
						<button type="button" class="btn btn-default btn-xs btn-flat bg-blue" title="RAPAT PEMBAHASAN">6</button>
						<button type="button" class="btn btn-default btn-xs btn-flat bg-purple" title="PROSES TINDAK LANJUT">7</button>
						<button type="button" class="btn btn-default btn-xs btn-flat bg-green" title="SELESAI TINDAK LANJUT">8</button>
					</div>
				</div>
			</div>
			<!-- /.box-body -->
		</div>

		<div class="box box-success">
			<div class="box-header with-border">
				<a href="<?php echo base_url(); ?>pengaduan">
					<button type="button" class="btn btn-flat pull-left">
						<?= $pengaduan ?> PERMOHONAN
					</button>
				</a>
			</div>
			<div class="box-body">
				<div id="bar-chart" style="height: 300px"></div>
			</div>
			<!-- /.box-body -->
		</div>

		</section>
	<div style="clear:both;"></div>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url(); ?>assets/lte/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Page script -->
<script>
	$(function () {
		/*
		 * BAR CHART
		 * ---------
		 */

		var bar_data = {
			data: [
				["PERSYARATAN BELUM LENGKAP (<?= $pengaduan1 ?>)", <?= $pengaduan1 ?>],
				["MENUNGGU VERIFIKASI PERSYARATAN (<?= $pengaduan2 ?>)", <?= $pengaduan2 ?>],
				["PERSYARATAN DITOLAK (<?= $pengaduan3 ?>)", <?= $pengaduan3 ?>],
				["PERSYARATAN DISETUJUI (<?= $pengaduan4 ?>)", <?= $pengaduan4 ?>],
				["PROSES PENCERMATAN (<?= $pengaduan5 ?>)", <?= $pengaduan5 ?>],
				["RAPAT PEMBAHASAN (<?= $pengaduan6 ?>)", <?= $pengaduan6 ?>],
				["PROSES TINDAK LANJUT (<?= $pengaduan7 ?>)", <?= $pengaduan7 ?>],
				["SELESAI TINDAK LANJUT (<?= $pengaduan8 ?>)", <?= $pengaduan8 ?>]
			],
			color: "#000000",
		};
		$.plot("#bar-chart", [bar_data], {
			grid: {
				borderWidth: 1,
				borderColor: "#d2d6de",
				tickColor: "#d2d6de"
			},
			series: {
				bars: {
					show: true,
					barWidth: 0.5,
					align: "center"
				}
			},
			xaxis: {
				mode: "categories",
				tickLength: 0
			}
		});
		/* END BAR CHART */

	});

	/*
	 * Custom Label formatter
	 * ----------------------
	 */
	function labelFormatter(label, series) {
		return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
				+ label
				+ "<br>"
				+ Math.round(series.percent) + "%</div>";
	}
</script>

<!-- ChartJS 1.0.1 -->
<script src="<?php echo base_url(); ?>assets/lte/plugins/chartjs/Chart.min.js"></script>
<script>
	$(function () {
		/* ChartJS
		 * -------
		 * Here we will create a few charts using ChartJS
		 */
		//-------------
		//- PIE CHART -
		//-------------
		// Get context with jQuery - using jQuery's .get() method.
		var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
		var pieChart = new Chart(pieChartCanvas);
		var PieData = [
			{
				value: <?php echo number_format($p1, 2); ?>,
				color: "#d2d6de",
				highlight: "#d2d6de",
				label: "PERSYARATAN BELUM LENGKAP (%)"
			},
			{
				value: <?php echo number_format($p2, 2); ?>,
				color: "#111111",
				highlight: "#111111",
				label: "MENUNGGU VERIFIKASI PERSYARATAN (%)"
			},
			{
				value: <?php echo number_format($p3, 2); ?>,
				color: "#f012be",
				highlight: "#f012be",
				label: "PERSYARATAN DITOLAK (%)"
			},
			{
				value: <?php echo number_format($p4, 2); ?>,
				color: "#f39c12",
				highlight: "#f39c12",
				label: "PERSYARATAN DISETUJUI (%)"
			},
			{
				value: <?php echo number_format($p5, 2); ?>,
				color: "#00c0ef",
				highlight: "#00c0ef",
				label: "PROSES PENCERMATAN (%)"
			},
			{
				value: <?php echo number_format($p6, 2); ?>,
				color: "#0073b7",
				highlight: "#0073b7",
				label: "RAPAT PEMBAHASAN (%)"
			},
			{
				value: <?php echo number_format($p7, 2); ?>,
				color: "#605CA8",
				highlight: "#605CA8",
				label: "PROSES TINDAK LANJUT (%)"
			},
			{
				value: <?php echo number_format($p8, 2); ?>,
				color: "#00a65a",
				highlight: "#00a65a",
				label: "SELESAI TINDAK LANJUT (%)"
			}
		];
		var pieOptions = {
			//Boolean - Whether we should show a stroke on each segment
			segmentShowStroke: true,
			//String - The colour of each segment stroke
			segmentStrokeColor: "#fff",
			//Number - The width of each segment stroke
			segmentStrokeWidth: 2,
			//Number - The percentage of the chart that we cut out of the middle
			percentageInnerCutout: 50, // This is 0 for Pie charts
			//Number - Amount of animation steps
			animationSteps: 200,
			//String - Animation easing effect
			animationEasing: "easeOutBounce",
			//Boolean - Whether we animate the rotation of the Doughnut
			animateRotate: true,
			//Boolean - Whether we animate scaling the Doughnut from the centre
			animateScale: false,
			//Boolean - whether to make the chart responsive to window resizing
			responsive: true,
			// Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
			maintainAspectRatio: true,
			//String - A legend template
			legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
		};
		//Create pie or douhnut chart
		// You can switch between pie and douhnut using the method below.
		pieChart.Doughnut(PieData, pieOptions);

	});
</script>
