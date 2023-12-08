<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Grafik Permohonan
			<small><?= webname() ?></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>kkpr-adm"><i class="fa fa-file-text-o"></i>Permohonan</li></a></li>
			<li class="active"><i class="fa fa-bar-chart"></i> Grafik</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">

		<?php
		if ($kkpr1 > 0) {
			$pm1 = $kkpr1 / $kkpr * 100;
		} else {
			$pm1 = 0;
		}
		if ($kkpr2 > 0) {
			$pm2 = $kkpr2 / $kkpr * 100;
		} else {
			$pm2 = 0;
		}
		if ($kkpr3 > 0) {
			$pm3 = $kkpr3 / $kkpr * 100;
		} else {
			$pm3 = 0;
		}
		if ($kkpr4 > 0) {
			$pm4 = $kkpr4 / $kkpr * 100;
		} else {
			$pm4 = 0;
		}
		?>

		<div class="box box-success">
			<div class="box-header with-border">
			<select class="form-control select2" name="" id="iddi" style="width: auto" onchange="javascript:location.href = this.value;">
				<option disabled>Pilih Tahun Permohonan</option>
				<option value="<?php echo base_url(); ?>kkpr-adm/grafik">Semua Tahun</option>
				<?php foreach ($tahun as $field) { ?>
					<?php if ($field->year == $year) { ?>
						<option value="<?php echo base_url(); ?>kkpr-adm/grafik-pertahun/<?= $field->year; ?>" selected><?= $field->year; ?></option>
					<?php } else { ?>
						<option value="<?php echo base_url(); ?>kkpr-adm/grafik-pertahun/<?= $field->year; ?>"><?= $field->year; ?></option>
					<?php } } ?>
			</select>
			<a href="<?php echo base_url(); ?>kkpr-adm">
				<button type="button" class="btn btn-flat pull-right">
					<?= $kkpr ?> PKKPR
				</button>
			</a>
		</div>

		<div class="box-body">
				<div class="col-sm-6" style="padding: 0;">
					<table class="table table-bordered" style="margin-bottom: 0">
						<tr>
							<th style="width: 10px">#</th>
							<th>STATUS PELAPORAN PKKPR</th>
							<th style="width: 100px">JUMLAH</th>
							<th style="width: 100px">PROSENTASE</th>
						</tr>
						<tr>
							<td>1.</td>
							<td>BELUM UPLOAD KELENGKAPAN</td>
							<td><span class="badge bg-gray"><?= $kkpr1 ?></span></td>
							<td><span class="badge bg-gray"><?= number_format($pm1,2) ?>%</span></td>
						</tr>
						<tr>
							<td>2.</td>
							<td>VERIFIKASI KELENGKAPAN</td>
							<td><span class="badge bg-yellow"><?= $kkpr2 ?></span></td>
							<td><span class="badge bg-yellow"><?= number_format($pm2,2) ?>%</span></td>
						</tr>
						<tr>
							<td>3.</td>
							<td>PKKPR VALID</td>
							<td><span class="badge bg-green"><?= $kkpr3 ?></span></td>
							<td><span class="badge bg-green"><?= number_format($pm3,2) ?>%</span></td>
						</tr>
						<tr>
							<td>4.</td>
							<td>PKKPR TIDAK VALID</td>
							<td><span class="badge bg-fuchsia"><?= $kkpr4 ?></span></td>
							<td><span class="badge bg-fuchsia"><?= number_format($pm4,2) ?>%</span></td>
						</tr>
					</table>
				</div>
				<div class="col-sm-6" style="padding: 0; text-align: center">
					<canvas id="pieChart" style="height:250px; margin-top: 50px"></canvas>
					<div class="btn-group" style="margin-top: 10px">
						<button type="button" class="btn btn-default btn-xs btn-flat bg-gray" title="BELUM UPLOAD KELENGKAPAN">1</button>
						<button type="button" class="btn btn-default btn-xs btn-flat bg-yellow" title="VERIFIKASI KELENGKAPAN">2</button>
						<button type="button" class="btn btn-default btn-xs btn-flat bg-green" title="PKKPR VALID">3</button>
						<button type="button" class="btn btn-default btn-xs btn-flat bg-fuchsia" title="PKKPR TIDAK VALID">4</button>
					</div>
				</div>
			</div>
			<!-- /.box-body -->
		</div>

		<div class="box box-success">
			<div class="box-header with-border">
				<a href="<?php echo base_url(); ?>kkpr-adm">
					<button type="button" class="btn btn-flat pull-left">
						<?= $kkpr ?> PKKPR
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
				["BELUM UPLOAD KELENGKAPAN (<?= $kkpr1 ?>)", <?= $kkpr1 ?>],
				["VERIFIKASI KELENGKAPAN (<?= $kkpr2 ?>)", <?= $kkpr2 ?>],
				["PKKPR VALID (<?= $kkpr3 ?>)", <?= $kkpr3 ?>],
				["PKKPR TIDAK VALID (<?= $kkpr4 ?>)", <?= $kkpr4 ?>],
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
				value: <?php echo number_format($pm1, 2); ?>,
				color: "#d2d6de",
				highlight: "#d2d6de",
				label: "BELUM UPLOAD KELENGKAPAN (%)"
			},
			{
				value: <?php echo number_format($pm2, 2); ?>,
				color: "#f39c12",
				highlight: "#f39c12",
				label: "VERIFIKASI KELENGKAPAN (%)"
			},
			{
				value: <?php echo number_format($pm3, 2); ?>,
				color: "#00a65a",
				highlight: "#00a65a",
				label: "PKKPR VALID (%)"
			},
			{
				value: <?php echo number_format($pm4, 2); ?>,
				color: "#f012be",
				highlight: "#f012be",
				label: "PKKPR TIDAK VALID (%)"
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
