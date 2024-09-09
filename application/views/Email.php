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
				<h4>Origin: <?= $origin_city . ", " . $origin_state . " " . $origin_zip_code . " " . $origin_country ?></h4>
			</div>
			<div class="col-md-12 mt-3" style="text-align: left">
				<h4>Destination: <?= $dest_city . ", " . $dest_state . " " . $dest_zip_code . " " . $dest_country ?></h4>
			</div>
			<div class="col-md-12 mt-3" style="text-align: left">
				<h4>Commodity: <?= $commodity ?></h4>
			</div>
			<div class="col-md-12 mt-3" style="text-align: left">
				<h4>Weight: <?= number_format($weight) ?> lbs.</h4>
			</div>
			<div class="col-md-12 mt-3" style="text-align: left">
				<h4>Type: <?= $van_dump ?></h4>
			</div>
			<div class="col-md-12 mt-3" style="text-align: left">
				<h4>Trader: <?= $user_name ?> <?= $user_email ?></h4>
			</div>
			<div class="col-md-12 mt-3" style="text-align: left">
				<p>Click <a href="https://itcep.intercotradingco.com/freightquote/quote_mcc?id=<?= base64_encode($sender) ?>">link</a> to process freight quote.</p>
			</div>
		</div>
	</div>
</body>

</html>
