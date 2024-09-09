<!DOCTYPE html>
<html>

<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
</head>

<body style="background-color:white">
	<div class="container" style="background-color:white">
		<div class="row">
			<div class="col-md-12 mt-3" style="text-align: left">
				<h4 style="font-weight: normal">Origin: <?= $origin_city . ", " . $origin_state . " " . $origin_zip_code . " " . $origin_country ?></h4>
			</div>
			<div class="col-md-12 mt-3" style="text-align: left">
				<h4 style="font-weight: normal">Destination: <?= $dest_city . ", " . $dest_state . " " . $dest_zip_code . " " . $dest_country ?></h4>
			</div>
			<div class="col-md-12 mt-3" style="text-align: left">
				<h4 style="font-weight: normal">Commodity: <?= $commodity ?></h4>
			</div>
			<div class="col-md-12 mt-3" style="text-align: left">
				<h4 style="font-weight: normal">Weight: <?= number_format($weight) ?> lbs.</h4>
			</div>
			<div class="col-md-12 mt-3" style="text-align: left">
				<h4 style="font-weight: normal">Type: <?= $van_dump ?></h4>
			</div>
			<div class="col-md-12 mt-3" style="text-align: left">
				<h4 style="font-weight: normal">Carrier Name: <?= $carrier_name ?></h4>
			</div>
			<div class="col-md-12 mt-3" style="text-align: left">
				<h4 style="font-weight: normal">Rate: $<?= number_format($rate) ?></h4>
			</div>
			<div class="col-md-12 mt-3" style="text-align: left">
				<h4 style="font-weight: normal">Note:</h4>
				<h4 style="font-weight: normal"><?= preg_replace("/[\n\r]+/", "<br/>", $note) ?></h4>
			</div>
			<div class="col-md-12 mt-3" style="text-align: left">
				<h4 style="font-weight: normal">Contact <?= $mcc_user ?> at <?= $mcc_email ?> with any questions.</h4>
			</div>
		</div>
	</div>
</body>

</html>
