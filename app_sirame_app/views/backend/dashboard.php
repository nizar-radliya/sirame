<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
			<small><?= webname() ?></small>
        </h1>
        <ol class="breadcrumb">
            <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
	<section class="content" style="padding-top: 0">
		<div class="col-md-12" style="padding: 15px;">

			<?php if ($this->session->flashdata('error')) { ?>
				<div class="alert alert-info alert-dismissible" style="margin-bottom: 0">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
					</button>
					<h4><i class="icon fa fa-bullhorn"></i>Pemberitahuan:</h4>
					<?php echo $this->session->flashdata('error'); ?>
				</div>
			<?php } ?>

			<div class="row">
				<div class="col-md-4" style="padding: 0; padding-right: 5px">
					<a href="<?= base_url() ?>kkpr-adm" style="text-decoration: none; color: black">
						<div class="info-box">
							<span class="info-box-icon bg-gray-light"><i class="fa fa-database"></i></span>

							<div class="info-box-content">
								<span class="info-box-text">Pelaporan PKKPR</span>
								<span class="info-box-number"><?= $kkpr ?></span>
							</div>
							<!-- /.info-box-content -->
						</div>
					</a>
				</div>
				<div class="col-md-8" style="padding: 0; padding-right: 5px">
					<div class="info-box">
						<span class="info-box-icon bg-gray-light"><i class="fa fa-search-plus"></i></span>

						<div class="info-box-content" style="padding-top: 10px">
							<span class="info-box-text" style="margin-bottom: 5px; font-weight: bold">Penelusuran Pelaporan PKKPR</span>
							<select class="form-control select2" name="" style="width: 100%" onchange="javascript:location.href = this.value;">
								<option selected>Nomor PKKPR</option>
								<?php foreach ($nomor as $field) { ?>
									<option value="<?php echo base_url(); ?>kkpr-adm/detil/<?= $field->nomor; ?>"><?= $field->nomor; ?> - <?= $field->statuskkpr; ?></option>
								<?php } ?>
							</select>
						</div>
						<!-- /.info-box-content -->
					</div>
				</div>
			</div>

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
			<div class="row">
				<div class="col-sm-12" style="padding: 0; padding-right: 5px">
					<div class="box box-success">
						<div class="box-header with-border">
							<a href="<?php echo base_url(); ?>kkpr-adm">
								<button type="button" class="btn btn-flat pull-left">
									<?= $kkpr ?> Pelaporan PKKPR
								</button>
							</a>
						</div>
						<div class="box-body">
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
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-12" style="padding: 0; padding-right: 5px">
					<div class="box box-success">
						<div class="box-header with-border">
							<a href="<?php echo base_url(); ?>kkpr-adm">
								<button type="button" class="btn btn-flat pull-left">
									<?= $kkpr ?> Pelaporan PKKPR
								</button>
							</a>
						</div>
						<div class="box-body" style="text-align: center">
							<canvas id="pieChartPm" style="height:250px; margin-top: 16px"></canvas>
							<div class="btn-group" style="margin-top: 10px">
								<button type="button" class="btn btn-default btn-xs btn-flat bg-gray" title="BELUM UPLOAD KELENGKAPAN">1</button>
								<button type="button" class="btn btn-default btn-xs btn-flat bg-yellow" title="VERIFIKASI KELENGKAPAN">2</button>
								<button type="button" class="btn btn-default btn-xs btn-flat bg-green" title="PKKPR VALID">3</button>
								<button type="button" class="btn btn-default btn-xs btn-flat bg-fuchsia" title="PKKPR TIDAK VALID">4</button>
							</div>
						</div>
					</div>
				</div>
			</div>

	</section>
	<div style="clear:both;"></div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url(); ?>assets/lte/plugins/jQuery/jquery-2.2.3.min.js"></script>

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
		var pieChartCanvas = $("#pieChartPm").get(0).getContext("2d");
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
