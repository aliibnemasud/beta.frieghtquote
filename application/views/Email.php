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
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-3" style="text-align: left">
                <p> <span class="fw-bold">Origin:</span> <?= $origin_city . ", " . $origin_state . " " . $origin_zip_code . " " . $origin_country ?></p>
            </div>
            <div class="col-md-12 mt-3" style="text-align: left">
                <p> <span class="fw-bold">Destination:</span> <?= $dest_city . ", " . $dest_state . " " . $dest_zip_code . " " . $dest_country ?></p>
            </div>
            <div class="col-md-12 mt-3" style="text-align: left">
                <p> <span class="fw-bold">Commodity:</span> <?= $commodity ?></p>
            </div>
            <div class="col-md-12 mt-3" style="text-align: left">
                <p> <span class="fw-bold">Weight:</span> <?= number_format($weight) ?> lbs.</p>
            </div>
            <div class="col-md-12 mt-3" style="text-align: left">
                <p> <span class="fw-bold">Type:</span> <?= $van_dump ?></h4>
            </div>
            <div class="col-md-12 mt-3" style="text-align: left">
                <p> <span class="fw-bold">Interco Facility:</span> <?= $interco_facility ?></p> <!-- Added this line -->
            </div>
            <div class="col-md-12 mt-3" style="text-align: left">
                <p> <span class="fw-bold">Trader:</span> <?= $user_name ?></p>
            </div>
            <div class="col-md-12 mt-3" style="text-align: left">
                <p>Click <a href="https://itcep.intercotradingco.com/freightquote/quote_mcc?id=<?= base64_encode($sender) ?>">link</a> to process freight quote.</p>
            </div>
        </div>
    </div>
</body>
</html>
