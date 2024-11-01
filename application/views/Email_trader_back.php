<!DOCTYPE html>
<html>

<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
	<style>
        body {
            background-color: white;
            font-family: 'Aptos', sans-serif;
        }
        .fw-bold {
            font-weight: bold;
        }
    </style>
</head>

<body style="background-color:white">
	<div class="container" style="background-color:white">
		<div class="row">
			<div class="col-md-12 mt-3" style="text-align: left">
				<p style="font-weight: normal"><span class="fw-bold">Origin: </span> <?= $origin_city . ", " . $origin_state . " " . $origin_zip_code . " " . $origin_country ?></p>
			</div>
			<div class="col-md-12 mt-3" style="text-align: left">
				<!--<p style="font-weight: normal"><span class="fw-bold"> Destination:</span> <?= $dest_city . ", " . $dest_state . " " . $dest_zip_code . " " . $dest_country ?></p>-->
                <?php if ($interco_facility === 'Other Destination'): ?>
                    <p> <span class="fw-bold">Destination:</span> <?= $dest_city . ", " . $dest_state . " " . $dest_zip_code . " " . $dest_country ?></p>
                <?php else: ?>
                    <p><span class="fw-bold">Destination:</span> <?= $interco_facility ?></p>
                <?php endif; ?>
			</div>
			<div class="col-md-12 mt-3" style="text-align: left">
				<p style="font-weight: normal"><span class="fw-bold"> Commodity:</span> <?= $commodity ?></p>
			</div>
			<div class="col-md-12 mt-3" style="text-align: left">
				<p style="font-weight: normal"><span class="fw-bold"> Weight:</span> <?= number_format($weight) ?> lbs.</p>
			</div>
			<div class="col-md-12 mt-3" style="text-align: left">
				<p style="font-weight: normal"><span class="fw-bold"> Type:</span> <?= $van_dump ?></h4>
			</div>
			<div class="col-md-12 mt-3" style="text-align: left">
				<p style="font-weight: normal"><span class="fw-bold"> Carrier Name:</span> <?= $carrier_name ?></p>
			</div>
			<div class="col-md-12 mt-3" style="text-align: left">
				<p style="font-weight: normal"><span class="fw-bold"> Rate:</span> $<?= number_format($rate) ?></p>
			</div>
			<div class="col-md-12 mt-3" style="text-align: left">
				<p style="font-weight: normal"><span class="fw-bold"> Note:</span> <?= preg_replace("/[\n\r]+/", "<br/>", $note) ?></p>
			</div>
			<div class="col-md-12 mt-3" style="text-align: left">
			    <h4 style="font-weight: normal"><span class="fw-bold"> Quoted by:</span> <?= $mcc_user ?></p>
			</div>
		</div>
	</div>
</body>

</html>