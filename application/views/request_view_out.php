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
            <a class="btn btn-default" href="/" id="inbound">Inbound</a>
            <a class="btn btn-success" href="/outbound" id="outbound">Outbound</a>
        </div>
        <div class="row mt-5 main_div">
            <div class="col-md-3" style="text-align: center">
                <label for="company_name" style="float: left">Company-Origin</label>
                <input type="text" id="company_name" class="form-control" placeholder="Company Name" style="display: none;">
                <select id="company_list" class="form-control">
                    <option value="Interco">Interco</option>
                </select>
                <button class="btn btn-info btn-sm" id="new_company" style="background-color: #17a2b800;border-color: #17a2b800;color: black">Add New</button>
            </div>
            <div class="col-md-3">
                <label for="city">City-Origin</label>
                <input type="text" id="city" class="form-control dest_address" placeholder="City" value="Madison" onFocus="geolocate_dest()">
            </div>
            <div class="col-md-3">
                <label for="state">State-Origin</label>
                <input type="text" id="state" class="form-control dest_address" value="IL" placeholder="State">
            </div>
            <div class="col-md-3">
                <label for="zip_code">Zip Code-Origin</label>
                <input type="text" id="zip_code" class="form-control dest_address" value="62060" placeholder="Zip Code">
            </div>

        </div>
        <div class="row mt-3 main_div">
            <div class="col-md-3" style="text-align: center">
                <label for="city" style="float:left">Company-Destination</label>
                <input type="text" id="dest_company_name" class="form-control" placeholder="Company Name" style="display: none;">
                <select id="dest_company_list" class="form-control">
                    <?php foreach ($company as $com) { ?>
                        <option value="<?= $com['name'] ?>" data-city="<?= $com['city'] ?>" data-state="<?= $com['state'] ?>" data-zip="<?= $com['zip_code'] ?>"><?= $com['name'] ?></option>
                    <?php } ?>
                </select>
                <button class="btn btn-info btn-sm" id="dest_new_company" style="background-color: #17a2b800;border-color: #17a2b800;color: black">Add New</button>
            </div>
            <div class="col-md-3">
                <label for="trailer">City-Destination</label>
                <input type="text" id="dest_city" class="form-control address" placeholder="City" onFocus="geolocate()">
            </div>
            <div class="col-md-3">
                <label for="state">State-Destination</label>
                <input type="text" id="dest_state" class="form-control address" placeholder="State">
            </div>
            <div class="col-md-3">
                <label for="zip_code">Zip Code-Destination</label>
                <input type="text" id="dest_zip_code" class="form-control address" placeholder="Zip Code">
            </div>

        </div>
        <div class="row mt-3 main_div">
            <div class="col-md-3">
                <label for="van">Type</label>
                <select id="van_dump" class="form-control">
                    <option value="Van">Van</option>
                    <option value="Dump">Dump</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="weight">Weight</label>
                <input type="text" id="weight" class="form-control" placeholder="Approximate Weight">
            </div>
            <div class="col-md-3">
                <label for="Commodity">Commodity</label>
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
                        <h4>Your freight quote has been submitted.</h4>
                        <!-- <h4>You should receive a response shortly.</h4> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("footer"); ?>
<script src="assets/js/wizard.js"></script>
<script src="assets/js/employee.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4pvNQmbADDWIXTrZPthdRduyLQWO17zg&libraries=places&callback=initAutocomplete" async defer></script>

<script>
    var placeSearch, autocomplete;

    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
    };

    function initAutocomplete() {

        autocomplete = new google.maps.places.Autocomplete(
            document.getElementById('city'), {
                types: ['geocode']
            });

        autocomplete.setFields(['address_component']);

        autocomplete.addListener('place_changed', fillInAddress);
    }

    function fillInAddress() {

        var place = autocomplete.getPlace();
        for (var component in componentForm) {
            $(".address").val("");
        }
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];

            if (place.address_components[i].types == "locality" || place.address_components[i].types[0] == "locality") {
                var city_select = place.address_components[i][componentForm[addressType]];
                $("#city").val(city_select);
            }
            if (place.address_components[i].types == "administrative_area_level_1" || place.address_components[i].types[0] == "administrative_area_level_1") {
                $("#state").val(place.address_components[i][componentForm[addressType]])
            };

            if (place.address_components[i].types == "postal_code") {
                $("#zip_code").val(place.address_components[i][componentForm[addressType]])
            };
        }
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






    // function initAutocomplete() {

    //   autocomplete = new google.maps.places.Autocomplete(
    //       document.getElementById('dest_city'), {types: ['geocode']});

    //   autocomplete.setFields(['address_component']);

    //   autocomplete.addListener('place_changed', fillInAddress);
    // }

    // function fillInAddress() {

    //   var place = autocomplete.getPlace();
    //   for (var component in componentForm) {
    //     $(".dest_address").val("");
    //   }
    //   for (var i = 0; i < place.address_components.length; i++) {
    //     var addressType = place.address_components[i].types[0];

    //     if(place.address_components[i].types == "locality" || place.address_components[i].types[0] == "locality"){
    //         var city_select = place.address_components[i][componentForm[addressType]];
    //         $("#dest_city").val(city_select);
    //     }
    //     if(place.address_components[i].types == "administrative_area_level_1" || place.address_components[i].types[0] == "administrative_area_level_1"){$("#dest_state").val(place.address_components[i][componentForm[addressType]])};

    //     if(place.address_components[i].types == "postal_code"){$("#dest_zip_code").val(place.address_components[i][componentForm[addressType]])};
    //   }
    // }

    // function geolocate_dest() {
    //   if (navigator.geolocation) {
    //     navigator.geolocation.getCurrentPosition(function(position) {
    //       var geolocation = {
    //         lat: position.coords.latitude,
    //         lng: position.coords.longitude
    //       };
    //       var circle = new google.maps.Circle(
    //           {center: geolocation, radius: position.coords.accuracy});
    //       autocomplete.setBounds(circle.getBounds());
    //     });
    //   }
    // }
</script>
