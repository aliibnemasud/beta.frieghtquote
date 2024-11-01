<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Interco</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/temp/img/favicon.png">
    <link rel="stylesheet" href="assets/temp/css/style.css?ver=1.3">
</head>

<?php
if ($status == 1) {
    $this->load->view("header");
}

// Decode the pallets JSON into an array
// $pallets = !empty($data[0]['pallets']) ? json_decode($data[0]['pallets'], true) : [];

?>

<body>

    <link rel="stylesheet" type="text/css" href="assets/css/wizard.css">
    <?php if ($status == 1) { ?>
        <div class="welcome-area four bg-white">
            <div class="anim-icons">
                <!-- <div class="icon icon-17"><img src="assets/temp/img/icon-img/shape.png" alt=""></div> -->
                <!-- <div class="icon icon-18"><img src="assets/temp/img/icon-img/shap-13.png" alt=""></div> -->
            </div>
            <div class="container h-100" style="margin-top: 5rem;">
                <div class="row">
                    <div class="col-md-12" style="text-align: center">
                        <h1>FREIGHT QUOTE</h1>
                    </div>
                </div>
                <!-- <form action="quote_mcc/update_mcc" method="POST"> -->
                <div class="row mt-2 main_div">
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-12 mt-3" style="text-align: left">
                                <h5>Trader: <?= $data[0]['display_name'] ?></h5>
                                <!--<h5><?= $data[0]['user_email'] ?></h5>-->
                            </div>
                            <div class="col-md-12 mt-3" style="text-align: left">
                                <h5>Type: <?= $data[0]['van_dump'] ?></h5>
                            </div>
                            
                            <?php if (!empty($pallets)): ?>
                                <div class="col-md-12 mt-3" style="text-align: left">
                                    <h5>Pallets (Total: <?= count($pallets) ?>):</h5>
                                    <ul>
                                        <?php foreach ($pallets as $pallet): ?>
                                            <li class="text-dark">
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
                                <h5>Commodity: <?= $data[0]['commodity'] ?></h5>
                            </div>
                            <div class="col-md-12 mt-3" style="text-align: left">
                                <h5>Weight: <?= number_format($data[0]['weight']); ?> lbs.</h5>
                            </div>
                            <div class="col-md-12 mt-3" style="text-align: left">
                                <h5>Origin: <?= $data[0]['origin_city'] . ", " . $data[0]['origin_state'] . " " . $data[0]['origin_zip_code'] . " " . $data[0]['origin_country'] ?></h5>
                            </div>
                            <div class="col-md-12 mt-3" style="text-align: left">
                                
                                
                                <?php if ($data[0]['interco_facility'] === 'Other Destination'): ?>
                                    <h5>Destination: <?= $data[0]['dest_city'] . ", " . $data[0]['dest_state'] . " " . $data[0]['dest_zip_code'] . " " . $data[0]['dest_country'] ?></h5>
                                <?php else: ?>
                                    <h5>Destination: <?= $data[0]['interco_facility'] ?></h5>
                                <?php endif; ?>
                                
                            </div>
                            <div class="col-md-12 mt-3">
                                <h5>Quoted By: <?= $username ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="row mt-5">
                            <div class="col-md-12" style="text-align: center">
                                <select class="form-control" id="carrier" name="carrier" style="font-size: 20px !important;">
                                    <?php foreach ($carrier as $car) { ?>
                                        <option value="<?= $car['id'] ?>"><?= $car['carrier_name'] ?></option>
                                    <?php } ?>
                                </select>
                                <button class="btn btn-primary mt-1" style="color: white;background-color: black;border-color:black" data-toggle="modal" data-target="#exampleModal">Add a Carrier</button>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="Trader">Rate</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="text" name="rate" required="true" id="rate" class="form-control" lang="it">
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <textarea class="form-control" name="note" id="note" placeholder="Note" style="min-height: 150px;"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" id="hidden_id" name="hidden_id" value="<?= $data[0]['id'] ?>">
                <div class="row mt-5">
                    <div class="col-md-12 after_div" style="text-align: center">
                        <button class="btn btn-danger" style="color: white;background-color: black;border-color:black" type="button" id="save_trader">Submit</button>
                    </div>
                </div>
                <!-- </form> -->
            </div>
        </div>
        <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background: #808080e0">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Carrier</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-7 offset-md-1 mt-2">
                                <label id="">Carrier Name</label> <!-- <span style="color: red">*</span>-->
                                <input type="text" id="carrier_name" name="carrier_name" required class="form-control">
                            </div>
                            <div class="col-md-3 mt-2">
                                <label id="">Company Phone</label>
                                <input type="text" id="company_phone" name="company_phone" required class="form-control">
                            </div>
                            <div class="col-md-4 offset-md-1 mt-2">
                                <label id="">City</label>
                                <input type="text" id="carrier_city" name="carrier_city" required class="form-control address" onFocus="geolocate()">
                            </div>
                            <div class="col-md-2 mt-2">
                                <label id="">State</label>
                                <select id="carrier_state" name="carrier_state" required class="form-control address" placeholder="State">
                                    <option data-common="true"></option>
                                    <option value="AL" data-country="US">AL</option>
                                    <option value="AK" data-country="US">AK</option>
                                    <option value="AZ" data-country="US">AZ</option>
                                    <option value="AR" data-country="US">AR</option>
                                    <option value="CA" data-country="US">CA</option>
                                    <option value="CO" data-country="US">CO</option>
                                    <option value="CT" data-country="US">CT</option>
                                    <option value="DE" data-country="US">DE</option>
                                    <option value="FL" data-country="US">FL</option>
                                    <option value="GA" data-country="US">GA</option>
                                    <option value="HI" data-country="US">HI</option>
                                    <option value="ID" data-country="US">ID</option>
                                    <option value="IL" data-country="US">IL</option>
                                    <option value="IN" data-country="US">IN</option>
                                    <option value="IA" data-country="US">IA</option>
                                    <option value="KS" data-country="US">KS</option>
                                    <option value="KY" data-country="US">KY</option>
                                    <option value="LA" data-country="US">LA</option>
                                    <option value="ME" data-country="US">ME</option>
                                    <option value="MD" data-country="US">MD</option>
                                    <option value="MA" data-country="US">MA</option>
                                    <option value="MI" data-country="US">MI</option>
                                    <option value="MN" data-country="US">MN</option>
                                    <option value="MS" data-country="US">MS</option>
                                    <option value="MO" data-country="US">MO</option>
                                    <option value="MT" data-country="US">MT</option>
                                    <option value="NE" data-country="US">NE</option>
                                    <option value="NV" data-country="US">NV</option>
                                    <option value="NH" data-country="US">NH</option>
                                    <option value="NJ" data-country="US">NJ</option>
                                    <option value="NM" data-country="US">NM</option>
                                    <option value="NY" data-country="US">NY</option>
                                    <option value="NC" data-country="US">NC</option>
                                    <option value="ND" data-country="US">ND</option>
                                    <option value="OH" data-country="US">OH</option>
                                    <option value="OK" data-country="US">OK</option>
                                    <option value="OR" data-country="US">OR</option>
                                    <option value="PA" data-country="US">PA</option>
                                    <option value="RI" data-country="US">RI</option>
                                    <option value="SC" data-country="US">SC</option>
                                    <option value="SD" data-country="US">SD</option>
                                    <option value="TN" data-country="US">TN</option>
                                    <option value="TX" data-country="US">TX</option>
                                    <option value="UT" data-country="US">UT</option>
                                    <option value="VT" data-country="US">VT</option>
                                    <option value="VA" data-country="US">VA</option>
                                    <option value="WA" data-country="US">WA</option>
                                    <option value="WV" data-country="US">WV</option>
                                    <option value="WI" data-country="US">WI</option>
                                    <option value="WY" data-country="US">WY</option>
                                    <option value="DC" data-country="US">DC</option>
                                    <option value="AB" data-country="CA" style="display: none">AB</option>
                                    <option value="BC" data-country="CA" style="display: none">BC</option>
                                    <option value="MB" data-country="CA" style="display: none">MB</option>
                                    <option value="NB" data-country="CA" style="display: none">NB</option>
                                    <option value="NL" data-country="CA" style="display: none">NL</option>
                                    <option value="NS" data-country="CA" style="display: none">NS</option>
                                    <option value="ON" data-country="CA" style="display: none">ON</option>
                                    <option value="PE" data-country="CA" style="display: none">PE</option>
                                    <option value="QC" data-country="CA" style="display: none">QC</option>
                                    <option value="SK" data-country="CA" style="display: none">SK</option>
                                    <option value="NT" data-country="CA" style="display: none">NT</option>
                                    <option value="NU" data-country="CA" style="display: none">NU</option>
                                    <option value="YT" data-country="CA" style="display: none">YT</option>
                                </select>
                            </div>
                            <div class="col-md-2 mt-2">
                                <label id="">Zip Code</label> <!--<span style="color: red">*</span>-->
                                <input type="text" id="carrier_zip_code" name="carrier_zip_code" required class="form-control address" maxlength="5">
                            </div>
                            <div class="col-md-2 mt-2">
                                <label for="carrier_country">Country</label>
                                <select id="carrier_country" class="form-control address" placeholder="Country" data-target="#carrier_state">
                                    <option value="US" selected>USA</option>
                                    <option value="CA">Canada</option>
                                </select>
                            </div>
                            <div class="col-md-5 offset-md-1 mt-2">
                                <label id="">Contact First Name</label>
                                <input type="text" id="contact_first" name="contact_first" class="form-control">
                            </div>
                            <div class="col-md-5 mt-2">
                                <label id="">Contact Last Name</label>
                                <input type="text" id="contact_second" name="contact_second" class="form-control">
                            </div>
                            <div class="col-md-6 offset-md-1 mt-2">
                                <label id="">Contact Email</label>
                                <input type="text" id="contact_email" name="contact_email" class="form-control">
                            </div>
                            <div class="col-md-4 mt-2">
                                <label id="">Contact Direct Phone</label>
                                <input type="text" id="contact_phone" name="contact_phone" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12" style="float: right;text-align: right">
                                <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                                <button type="button" id="save_carrier" class="btn btn-dark" style="color: white;background-color: black;border-color:black">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade bd-example-modal-lg" id="success_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background: #808080e0">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12" style="text-align: center">
                                <h4 style="font-family: 'Poppins', sans-serif;">Your Freight Quote has been sent to the ITC Traderr</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="welcome-area four bg-white">
            <div class="anim-icons">
                <!-- <div class="icon icon-17"><img src="assets/temp/img/icon-img/shape.png" alt=""></div> -->
            </div>
            <div class="container h-100" style="margin-top: 5rem;">
                <div class="row">
                    <!--<div class="col-12" style="text-align: center;">-->
                    <!--    <h4 style="font-family: "Poppins", sans-serif;">This quote was processed by <?= $mcc_name[0]['display_name'] ?> </h4>-->
                    <!--    <h4 style="font-family: "Poppins", sans-serif;">at <?= date("m/d/y H:i A", strtotime($data[0]['mcc_date'])) ?></h4>-->
                    <!--</div>-->
                    <div class="col-12" style="text-align: center;">
                        <h4 style="font-family: 'Poppins', sans-serif;">This quote was processed by <?= htmlspecialchars($mcc_name[0]['display_name'], ENT_QUOTES, 'UTF-8') ?> </h4>
                        <h4 style="font-family: 'Poppins', sans-serif;">at <?= htmlspecialchars(date("m/d/y H:i A", strtotime($data[0]['mcc_date'])), ENT_QUOTES, 'UTF-8') ?></h4>
                    </div>

                </div>
            </div>
        </div>
    <?php
    } ?>

    <?php $this->load->view("footer"); ?>
    
    <script type="text/javascript">
        // Pass PHP variable to JavaScript
        var van_dump_value = <?php echo json_encode($data[0]['van_dump']); ?>;
        var origin_city = <?php echo json_encode($data[0]['origin_city']); ?>;
        var origin_state = <?php echo json_encode($data[0]['origin_state']); ?>;
        var origin_zip_code = <?php echo json_encode($data[0]['origin_zip_code']); ?>;
        var interco_facility = <?php echo json_encode($data[0]['interco_facility']); ?>;
    </script>
    
    <script src="assets/js/mcc.js?ver=1.3"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4pvNQmbADDWIXTrZPthdRduyLQWO17zg&libraries=places&callback=initAutocomplete" async defer></script>

    <script>
        var placeSearch, autocomplete;

        var componentForm = {
            street_number: 'short_name',
            route: 'long_name',
            locality: 'long_name',
            administrative_area_level_1: 'short_name',
            country: 'short_name',
            postal_code: 'short_name'
        };

        function initAutocomplete() {
            autocomplete = new google.maps.places.Autocomplete(
                document.getElementById('carrier_city'), {
                    types: ['geocode']
                });

            autocomplete.setFields(['address_component']);
            autocomplete.addListener('place_changed', fillInAddress_carrier);
        }
        
        function fillInAddress(autocomplete, inputs) {
            var place = autocomplete.getPlace();
            $(Object.values(inputs).join(', ')).val("");
            for (var i = 0; i < place.address_components.length; i++) {
                var addressType = place.address_components[i].types[0];
                var input = inputs[addressType];
                if (!input) {
                    continue;
                }
                var value = place.address_components[i][componentForm[addressType]];
                $(input).val(value).trigger('change');
            }
        }

        function fillInAddress_carrier() {
            fillInAddress(autocomplete, {
                locality: '#carrier_city',
                administrative_area_level_1: '#carrier_state',
                country: '#carrier_country',
                postal_code: '#carrier_zip_code'
            });
        }

        function geolocate() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var geolocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    var circle = new google.maps.Circle({
                        center: geolocation,
                        radius: position.coords.accuracy
                    });
                    autocomplete.setBounds(circle.getBounds());
                });
            }
        }

        jQuery(function($) {
            $('#carrier_country').on('change', function(evt) {
                var $this = $(this);
                var $target = $($this.data('target'));
                var val = $target.val();
                $target.children().css('display', 'none').prop('selected', false)
                    .filter('[data-country=' + $this.val() + '], [data-common=true]').css('display', 'block')
                    .filter('[value="' + val + '"]').prop('selected', true);
            });
            $('#rate').on('change', function(evt) {
                $(this).val(parseFloat($(this).val().replace(/,/g, '')).toLocaleString());
            });
            $('#company_phone').on('change', function(evt) {
                var phoneNumber = $(this).val().replace(/\D/g, '');
                if (phoneNumber.length >= 10) {
                    var areaCode = phoneNumber.substring(0, 3);
                    var prefix = phoneNumber.substring(3, 6);
                    var lineNumber = phoneNumber.substring(6);
                    $(this).val("(" + areaCode + ") " + prefix + "-" + lineNumber);
                }
            });
            $('#contact_phone').on('change', function(evt) {
                var phoneNumber = $(this).val().replace(/\D/g, '')
                if (phoneNumber.length >= 10) {
                    var areaCode = phoneNumber.substring(0, 3);
                    var prefix = phoneNumber.substring(3, 6);
                    var lineNumber = phoneNumber.substring(6);
                    $(this).val("(" + areaCode + ") " + prefix + "-" + lineNumber);
                }
            });
            $('#carrier_zip_code').on('keydown', function(evt) {
                var key = evt.which || evt.keyCode;
                if ((48 <= key && key <= 57) || (96 <= key && key <= 105) || [8, 37, 38, 39, 40, 46].includes(key)) {
                    return;
                }
                evt.preventDefault();
                evt.stopPropagation();
            });
        });
    </script>
