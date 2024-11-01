$(document).ready(function () {
    // Set the maximum value for the weight input
    $('#weight').attr('max', 45000);

    $('#save').on('click', function () {
        var flag = 0;
        
        console.log("Clicked 0 -1")

        // Validate origin fields
        if ($('#city').val() == '') {
            $('#city').css('border', '1px solid red');
            flag = 1;
        }

        if ($('#state').val() == '') {
            $('#state').css('border', '1px solid red');
            flag = 1;
        }

        if ($('#zip_code').val() == '') {
            $('#zip_code').css('border', '1px solid red');
            flag = 1;
        }

        // Validate destination fields
        if ($('#dest_city').val() == '') {
            $('#dest_city').css('border', '1px solid red');
            flag = 1;
        }
        
        if ($('#van_dump').val() == 'LTL'){
            
            if ($('#pallet').val() == '' || $('#pallet').val() < 1 ) {
            $('#pallet').css('border', '1px solid red');
            flag = 1;
            }
        }

        
        
        if ($('#dest_state').val() == '') {
            $('#dest_state').css('border', '1px solid red');
            flag = 1;
        }


        if ($('#dest_zip_code').val() == '') {
            $('#dest_zip_code').css('border', '1px solid red');
            flag = 1;
        }

        // Validate weight field
        var weight = parseFloat($('#weight').val().replace(/,/g, ''));
        
        if ($('#weight').val() == '') {
            $('#weight').css('border', '1px solid red');
            flag = 1;
        }
        else if(weight > 45000){
              $('#weight-error').show();
              $('#weight').css('border', '1px solid red');
              flag = 1;
            }
        else {
            $('#weight').css('border', ''); // Reset border if valid
            $('#weight-error').hide();
        }

        // LTL Pallet Data Validation
        var palletData = [];
        $('.pallets_all_value').each(function(index) {
            var palletWeight = $(this).find('.weight').val();
            var palletLength = $(this).find('.length').val();
            var palletWidth = $(this).find('.width').val();
            var palletHeight = $(this).find('.height').val();
            
            // Validate each pallet field
            if (palletWeight == '' || palletLength == '' || palletWidth == '' || palletHeight == '') {
                flag = 1;
                if (palletWeight == '') $(this).find('.weight').css('border', '1px solid red');
                if (palletLength == '') $(this).find('.length').css('border', '1px solid red');
                if (palletWidth == '') $(this).find('.width').css('border', '1px solid red');
                if (palletHeight == '') $(this).find('.height').css('border', '1px solid red');
            } else {
                $(this).find('.weight').css('border', '');
                $(this).find('.length').css('border', '');
                $(this).find('.width').css('border', '');
                $(this).find('.height').css('border', '');
            }
            
            palletData.push({
                weight: palletWeight,
                length: palletLength,
                width: palletWidth,
                height: palletHeight
            });
        });

        if (flag == 1) {
            return;
        }

        $('#droba-loader').removeClass('loaded');
        $('#save').prop('disabled', true);

        $.ajax({
            url: '/beta.freightquote/index.php/quote/save_freight_quote',
            type: 'POST',
            data: {
                orgin_city: $('#city').val(),
                orgin_state: $('#state').val(),
                orgin_country: $('#country').val(),
                orgin_zip_code: $('#zip_code').val(),
                dest_city: $('#dest_city').val(),
                dest_state: $('#dest_state').val(),
                dest_country: $('#dest_country').val(),
                dest_zip_code: $('#dest_zip_code').val(),
                van_dump: $('#van_dump').val(),
                pallet: $('#pallet').val(),
                weight: $('#weight').val().replace(/,/g, ''),
                commodity: $('#commodity').val(),
                interco_facility: $('#interco_facility').val(),
                // LTL Pallet Data
                pallet_data: JSON.stringify(palletData),
                note: $('#note').val(),
            },
            dataType: 'JSON',
            success: function (res) {
                console.log(res);
                $('#droba-loader').addClass('loaded');
                $('.main_div').css('display', 'none');
                $("#logo_image").css("display","none");
                $('.after_div').html(`<h4>Your freight quote has been submitted.</h4>
                  <div class="row mt-5">
                    <div class="col-md-12 after_div" style="text-align: center">
                        <a href="https://itcep.intercotradingco.com/beta.freightquote/" class="btn btn-success">Request Another Quote</a>
                    </div>
                </div>`);
            },
        });
    });
});
