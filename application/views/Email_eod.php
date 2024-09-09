<!DOCTYPE html>
<html>

<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body style="background-color:white">
	<div class="container-fluid" style="background-color:white">
		<div class="row">
			<div class="col-md-12" style="text-align: left">
				<h3>Today's Freight Quotes</h3>
			</div>
		</div>
		<?php
		foreach ($result as $res) { ?>
			<div class="row" style="margin-top: 20px;background-color: white;background: white">
				<div class="col-md-12" style="text-align: left;margin-top: 3rem">
					<h4>Origin: <?= $res['origin_city'] . ", " . $res['origin_state'] . " " . $res['origin_zip_code'] ?></h4>
					<h4>Destination: <?= $res['dest_city'] . ", " . $res['dest_state'] . " " . $res['dest_zip_code'] ?></h4>
					<h4>Type: <?= $res['van_dump'] ?></h4>
					<h4>Freight Rate: $<?= number_format($res['rate']) ?></h4>
					<h4>Trader: <?= $res['trader'] ?></h4>
				</div>

			</div>
		<?php } ?>
		<div class="row">
			<div class="col-md-12" style="margin-top:30px;text-align: left">
				<p>Click on this <a href="https://docs.google.com/spreadsheets/d/1IY_Eodin52FTwZPlV-iOfZJuJ0EUp27Los6Ls3LpINc/edit#gid=0"> for the entire spreadsheet.</a></p>
			</div>
		</div>
	</div>
</body>

</html>
