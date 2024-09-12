$(document).ready(function () {
  // $('#new_company').on('click', function () {
  //   $(this).css('display', 'none');
  //   $('#company_list').css('display', 'none');
  //   $('#company_name').css('display', 'block');
  // });

  // $('#dest_new_company').on('click', function () {
  //   $(this).css('display', 'none');
  //   $('#dest_company_list').css('display', 'none');
  //   $('#dest_company_name').css('display', 'block');
  // });

  $('#save').on('click', function () {
    var flag = 0;

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

    // if ($('#company_list').css('display') == 'none') {
    //   if ($('#company_name').val() == '') {
    //     $('#company_name').css('border', '1px solid red');
    //     flag = 1;
    //   }
    // } else {
    //   if ($('#company_list').val() == '') {
    //     $('#company_list').css('border', '1px solid red');
    //     flag = 1;
    //   }
    // }

    if ($('#dest_city').val() == '') {
      $('#dest_city').css('border', '1px solid red');
      flag = 1;
    }

    if ($('#dest_state').val() == '') {
      $('#dest_state').css('border', '1px solid red');
      flag = 1;
    }

    if ($('#dest_zip_code').val() == '') {
      $('#dest_zip_code').css('border', '1px solid red');
      flag = 1;
    }

    if ($('#weight').val() == '') {
      $('#weight').css('border', '1px solid red');
      flag = 1;
    }

    if (flag == 1) {
      return;
    }

    $('#droba-loader').removeClass('loaded');

    // var company_name;
    // if ($('#company_name').css('display') == 'none') {
    //   company_name = $('#company_list').val();
    // } else {
    //   company_name = $('#company_name').val();
    //   $.ajax({
    //     url: '/beta.freightquote/index.php/quote/save_company',
    //     type: 'POST',
    //     data: {
    //       name: company_name,
    //       city: $('#city').val(),
    //       state: $('#state').val(),
    //       zip_code: $('#zip_code').val(),
    //     },
    //     async: false,
    //     dataType: 'JSON',
    //     success: function (res) {},
    //   });
    // }

    // if ($('#dest_company_name').css('display') == 'none') {
    //   var dest_company_name = $('#dest_company_list').val();
    // } else {
    //   var dest_company_name = $('#dest_company_name').val();
    // }
    
    $('#save').prop('disabled', true);
        
    // Step -> 1
    $.ajax({
      url: '/beta.freightquote/index.php/quote/save_employee',
      type: 'POST',
      data: {
        // orgin_company: company_name,
        orgin_city: $('#city').val(),
        orgin_state: $('#state').val(),
        orgin_country: $('#country').val(),
        orgin_zip_code: $('#zip_code').val(),
        // dest_company: dest_company_name,
        dest_city: $('#dest_city').val(),
        dest_state: $('#dest_state').val(),
        dest_country: $('#dest_country').val(),
        dest_zip_code: $('#dest_zip_code').val(),
        van_dump: $('#van_dump').val(),
        pallet: $('#pallet').val(),
        weight: $('#weight').val().replace(/,/g, ''),
        commodity: $('#commodity').val(),
        interco_facility: $('#interco_facility').val(),  // Add this line
      },
      dataType: 'JSON',
      success: function (res) {
        // document.location.reload();
        // $("#success_modal").modal("show");
        $('#droba-loader').addClass('loaded');
        $('.main_div').css('display', 'none');
        $('.after_div').html('<h4>Your freight quote has been submitted.</h4>');
      },
    });
  });
});
