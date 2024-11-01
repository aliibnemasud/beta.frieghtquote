<!DOCTYPE html>
<html>
<head>
    <title>Freight Quote</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <!-- Include the Aptos font -->
    <link rel="stylesheet" href="https://path-to-aptos-font/aptos-font.css">
    <style>
        body {
            background-color: white;
            font-family: 'Aptos', sans-serif;
        }
        .fw-bold {
            font-weight: bold;
        }
          .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-3" style="text-align: left">
                <p> <span class="fw-bold">Origin:</span> <?= $origin_city . ", " . $origin_state . " " . $origin_zip_code . " " . $origin_country ?></p>
            </div>
            <div class="col-md-12 mt-3" style="text-align: left">
                <?php if ($interco_facility === 'Other Destination'): ?>
                    <p> <span class="fw-bold">Destination:</span> <?= $dest_city . ", " . $dest_state . " " . $dest_zip_code . " " . $dest_country ?></p>
                <?php else: ?>
                    <p><span class="fw-bold">Destination:</span> <?= $interco_facility ?></p>
                <?php endif; ?>
            </div>
            <div class="col-md-12 mt-3" style="text-align: left">
                <p> <span class="fw-bold">Commodity:</span> <?= $commodity ?></p>
            </div>
            
            <div class="col-md-12 mt-3" style="text-align: left">
                <p> <span class="fw-bold">Type:</span> <?= $van_dump ?></h4>
            </div>
            
            <div class="col-md-12 mt-3" style="text-align: left">
                <p> <span class="fw-bold">Weight:</span> <?= number_format($weight) ?> lbs.</p>
            </div>
            
            <div class="col-md-12 mt-3" style="text-align: left">
                <?php if ($interco_facility === 'Other Destination'): ?>
                    <!--<p><span class="fw-bold">Facility:</span> <?= $interco_facility ?></p>-->
                    <!--<p><span class="fw-bold">Other Destination: </span><?= $dest_city . ", " . $dest_state . " " . $dest_zip_code . " " . $dest_country ?></p>-->
                <?php else: ?>
                    <!--<p><span class="fw-bold">Facility:</span> <?= $interco_facility ?></p>-->
                <?php endif; ?>
            </div>
            
            <!-- Pallet data section -->
            <?php if (!empty($pallets)): ?>
                <div class="col-md-12 mt-3" style="text-align: left">
                    <p><span class="fw-bold">Number of Pallets:</span> <?= count($pallets) ?></p>
                    <ul>
                        <?php foreach ($pallets as $pallet): ?>
                            <li>
                                <span class="fw-bold">Weight:</span> <?= number_format($pallet['weight']) ?> lbs,
                                <span class="fw-bold">Length:</span> <?= number_format($pallet['length']) ?> in,
                                <span class="fw-bold">Width:</span> <?= number_format($pallet['width']) ?> in,
                                <span class="fw-bold">Height:</span> <?= number_format($pallet['height']) ?> in
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            
            <div class="col-md-12 mt-3" style="text-align: left">
				<p style="font-weight: normal"><span class="fw-bold"> Note:</span> <?= preg_replace("/[\n\r]+/", "<br/>", $note) ?></p>
			</div>
            
            
            <div class="col-md-12 mt-3" style="text-align: left">
                <p> <span class="fw-bold">Trader:</span> <?= $user_name ?></p>
            </div>
            <div class="col-md-12 mt-3" style="text-align: left">
                <p>Click <a href="https://itcep.intercotradingco.com/beta.freightquote/quote_mcc?id=<?= base64_encode($sender) ?>">link</a> to process freight quote.</p>
            </div>
        </div>
    </div>
</body>
</html>