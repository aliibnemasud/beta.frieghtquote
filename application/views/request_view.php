<?php $this->load->view("header"); ?>
<link rel="stylesheet" type="text/css" href="assets/css/wizard.css">
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
        <div class="row">
            <button class="btn btn-success" id="inbound" onclick="onClickInboundBtn();">Inbound</button>
            <button class="btn btn-default" id="outbound" onclick="onClickOutboundBtn();">Outbound</button>
        </div>
        <div class="row mt-5 main_div">
            <div class="col-md-3 d-none company-origin" style="text-align: center">
                <label for="company_name" style="float: left">Company Origin</label>
                <input type="text" id="company_name" class="form-control" placeholder="Company Name" style="display: none;">
                <input type="text" id="company_list" class="form-control" placeholder="Company Name">
                <button class="btn btn-info btn-sm" id="new_company" style="background-color: #17a2b800;border-color: #17a2b800;color: black">Add New</button>
            </div>
            <!-- offset-md-1 -->
            <div class="col-md-3 ">
                <label for="city">City Origin</label>
                <input type="text" id="city" class="form-control address" placeholder="City" onFocus="geolocate()">
            </div>
            <div class="col-md-2">
                <label for="state">State Origin</label>
                <select id="state" class="form-control address" placeholder="State">
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
                    <option value="IL" data-country="US" selected>IL</option>
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
            <div class="col-md-3">
                <label for="zip_code">Zip Code Origin</label>
                <input type="text" id="zip_code" class="form-control address" placeholder="Zip Code" maxlength="5">
            </div>
            <div class="col-md-2">
                <label for="country">Country Origin</label>
                <select id="country" class="form-control address" placeholder="Country" data-target="#state">
                    <option value="US" selected>USA</option>
                    <option value="CA">Canada</option>
                </select>
            </div>
        </div>
        <div id="2ndRow" class="d-none">
        <div class="row mt-3 main_div">
            <div class="col-md-3 d-none company-destination" style="text-align: center">
                <label for="dest_company_name" style="float:left">Company Destination</label>
                <input type="text" id="dest_company_name" class="form-control" placeholder="Company Name" style="display: none;">
                <input type="text" id="dest_company_list" class="form-control" placeholder="Company Name" value="Interco" readonly>
                <button class="btn btn-info btn-sm" id="dest_new_company" style="background-color: #17a2b800;border-color: #17a2b800;color: black">Add New</button>
            </div>
            <div class="col-md-3 offset-md-1">
                <label for="dest_city">City Destination</label>
                <input type="text" id="dest_city" class="form-control dest_address" placeholder="City" value="Madison" onFocus="geolocate_dest()">
            </div>
            <div class="col-md-2">
                <label for="dest_state">State Destination</label>
                <select id="dest_state" class="form-control dest_address" placeholder="State">
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
                    <option value="IL" data-country="US" selected>IL</option>
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
            <div class="col-md-3">
                <label for="dest_zip_code">Zip Code Destination</label>
                <input type="text" id="dest_zip_code" class="form-control dest_address" value="62060" placeholder="Zip Code" maxlength="5">
            </div>
            <div class="col-md-2">
                <label for="dest_country">Country Destination</label>
                <select id="dest_country" class="form-control dest_address" placeholder="Country" data-target="#dest_state">
                    <option value="US" selected>USA</option>
                    <option value="CA">Canada</option>
                </select>
            </div>
        </div>
        </div>
        <div class="row mt-3 main_div">
            <div id="intercoFacilityDiv" class="col-md-3">
                <label for="intercoFacility">Interco Facility</label>
                <select id="intercoFacility" class="form-control">
                    <option value="ITC -- Madison">ITC -- Madison</option>
                    <option value="ITC -- Edwardsville">ITC -- Edwardsville</option>
                    <option value="CMR -- Fredericktown">CMR -- Fredericktown</option>                   
                </select>
        </div>
            <div class="col-md-3 ">
                <label for="van_dump">Type</label>
                <select id="van_dump" class="form-control">
                    <option value="Van">Van</option>
                    <option value="Dump">Dump</option>
                    <option value="Flatbed">Flatbed</option>
                    <option value="LTL">LTL</option>
                </select>
            </div>
            <div class="col-md-2 pallet-input d-none">
                <label for="pallet">Pallet</label>
                <input type="text" id="pallet" class="form-control" placeholder="Pallet">
            </div>
            <div class="col-md-2">
                <label for="weight">Weight</label>
                <input type="text" id="weight" class="form-control" placeholder="Weight">
            </div>
            <div class="col-md-3">
                <label for="commodity">Commodity</label>
                <select id="commodity" class="form-control">
                    <option value="Mixed Load">Mixed Load</option>
                    <option value="Batteries">Batteries</option>
                    <option value="Electronics">Electronics</option>
                    <option value="NonFerrous">NonFerrous</option>
                    <option value="Steel">Steel</option>
                </select>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12 after_div" style="text-align: center">
                <button class="btn btn-success" id="save">Submit</button>
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
                        <h4>Your freight quote has been submitted</h4>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("footer"); ?>
<script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>
<script src="assets/js/wizard.js"></script>
<script src="assets/js/employee.js?ver=1.3"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4pvNQmbADDWIXTrZPthdRduyLQWO17zg&libraries=places&callback=initAutocomplete" async defer></script>

<script>
    var placeSearch, autocomplete, autocomplete_dest;

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
            document.getElementById('city'), {
                types: ['geocode']
            }
        );
        autocomplete.setFields(['address_component']);
        autocomplete.addListener('place_changed', fillInAddress_origin);

        autocomplete_dest = new google.maps.places.Autocomplete(
            document.getElementById('dest_city'), {
                types: ['geocode']
            }
        );
        autocomplete_dest.setFields(['address_component']);
        autocomplete_dest.addListener('place_changed', fillInAddress_dest);
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

    function fillInAddress_origin() {
        fillInAddress(autocomplete, {
            locality: '#city',
            administrative_area_level_1: '#state',
            country: '#country',
            postal_code: '#zip_code'
        });
    }

    function fillInAddress_dest() {
        fillInAddress(autocomplete_dest, {
            locality: '#dest_city',
            administrative_area_level_1: '#dest_state',
            country: '#dest_country',
            postal_code: '#dest_zip_code'
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

    function onClickInboundBtn() {
        $("#company_list").val("").prop("readonly", false);
        $("#city").val("");
        $("#state").val("");
        $("#country").val("US").trigger('change');
        $("#zip_code").val("");
        $("#inbound").removeClass();
        $("#inbound").addClass("btn btn-success");
        
        $("#2ndRow").removeClass();
        $("#2ndRow").addClass("d-none");
        $("#intercoFacilityDiv").removeClass();
        $("#intercoFacilityDiv").addClass("d-block");

        $('#dest_company_list').val("Interco").prop("readonly", true);
        $("#dest_city").val("Madison");
        $("#dest_state").val("IL");
        $("#dest_country").val("US").trigger('change');
        $("#dest_zip_code").val("62060");
        $("#outbound").removeClass();
        $("#outbound").addClass("btn btn-default");
    }

    function onClickOutboundBtn() {
        // Create a new option element
        $('#company_list').val("Interco").prop("readonly", true);
        $("#city").val("Madison");
        $("#state").val("IL");
        $("#country").val("US").trigger('change');
        $("#zip_code").val("62060");
        $("#inbound").removeClass();
        $("#inbound").addClass("btn btn-default");
        
        $("#2ndRow").addClass("d-block");
        $("#intercoFacilityDiv").removeClass();
        $("#intercoFacilityDiv").addClass("d-none");

        $('#dest_company_list').val("").prop("readonly", false);
        $("#dest_city").val("");
        $("#dest_state").val("");
        $("#dest_country").val("US").trigger('change');
        $("#dest_zip_code").val("");
        $("#outbound").removeClass();
        $("#outbound").addClass("btn btn-success");
    }

    function geolocate_dest() {
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
                autocomplete_dest.setBounds(circle.getBounds());
            });
        }
    }

    jQuery(function($) {
        $('#country, #dest_country').on('change', function(evt) {
            var $this = $(this);
            var $target = $($this.data('target'));
            var val = $target.val();
            $target.children().css('display', 'none').prop('selected', false)
                .filter('[data-country=' + $this.val() + '], [data-common=true]').css('display', 'block')
                .filter('[value="' + val + '"]').prop('selected', true);
        });
        $('#weight').on('change', function(evt) {
            $(this).val(parseFloat($(this).val().replace(/,/g, '')).toLocaleString());
        });
        $('#dest_zip_code, #zip_code').on('keydown', function(evt) {
            var key = evt.which || evt.keyCode;
            if ((48 <= key && key <= 57) || (96 <= key && key <= 105) || [8, 37, 38, 39, 40, 46].includes(key)) {
                return;
            }
            evt.preventDefault();
            evt.stopPropagation();
        });
        $('select#van_dump').on('change', function(evt) {
            var $pallet = $('.pallet-input').val('');
            if ($(this).val() == 'LTL') {
                $pallet.removeClass('d-none');
            } else {
                $pallet.addClass('d-none');
            }
        });
        $('input#company_list').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "/beta.freightquote/index.php/quote/get_company",
                    dataType: "json",
                    data: {
                        q: request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 2,
            select: function(event, ui) {
                $('#city').val(ui.item.city);
                $('#state').val(ui.item.state);
                $('#zip_code').val(ui.item.zip_code);
            }
        });
        $('input#dest_company_list').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "/beta.freightquote/index.php/quote/get_company",
                    dataType: "json",
                    data: {
                        q: request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 2,
            select: function(event, ui) {
                $('#dest_city').val(ui.item.city);
                $('#dest_state').val(ui.item.state);
                $('#dest_zip_code').val(ui.item.zip_code);
            }
        });
    });
</script>