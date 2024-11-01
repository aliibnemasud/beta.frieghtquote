$(document).ready(function () {
  $("#save_carrier").on("click", function () {
    $.ajax({
      url: "/beta.freightquote/index.php/quote_mcc/save_carrier",
      type: "POST",
      data: {
        carrier_name: $("#carrier_name").val(),
        carrier_phone: $("#company_phone").val(),
        carrier_city: $("#carrier_city").val(),
        carrier_state: $("#carrier_state").val(),
        carrier_country: $("#carrier_country").val(),
        carrier_zip_code: $("#carrier_zip_code").val(),
        contact_first: $("#contact_first").val(),
        contact_second: $("#contact_second").val(),
        contact_email: $("#contact_email").val(),
        contact_phone: $("#contact_phone").val(),
      },
      dataType: "JSON",
      success: function (res) {
        document.location.reload();
      },
    });
  });
  
  

 

  $("#save_trader").on("click", function () {
    var flag = 0;
    if ($("#carrier").val() == "") {
      $("#carrier").css("border", "1px solid red");
      flag = 1;
    }
    if ($("#rate").val() == "") {
      $("#rate").css("border", "1px solid red");
      flag = 1;
    }
    if (flag == 1) {
      return;
    }

    $("#droba-loader").removeClass("loaded");
    $("#save_trader").prop("disabled", true);
    $.ajax({
      url: "/beta.freightquote/index.php/quote_mcc/update_mcc",
      type: "POST",
      data: {
        carrier: $("#carrier").val(),
        rate: $("#rate").val().replace(/,/g, ""),
        note: $("#note").val(),
        hidden_id: $("#hidden_id").val(),
      },
      dataType: "JSON",
      success: function (res) {
          
        console.log($("#carrier").val());
        // Access token from response
        const accessToken = res.access_token;
        // console.log('Access Token:', accessToken);
        
        // Access Token Here
        const updateData = {};
        let rate = $("#rate").val().replace(/,/g, "");    
        // Check if rate is empty or not a number
        if (!rate || isNaN(rate)) {
          console.log("Rate is either empty or not a number");
          return;
        }
    
        rate = parseInt(rate);
    
        if ((van_dump_value === "Van" || van_dump_value === "Dump") && interco_facility !== "Other Destination") {
          // Check which values are present and add them to updateData
          if (van_dump_value === "Van") {
            updateData.new_vanrate = rate;
          }
          if (van_dump_value === "Dump") {
            updateData.new_dump = rate;
          }
          console.log(updateData, origin_city, origin_state, origin_zip_code);
          // Update Contact
          updateDynamics365(accessToken, updateData, origin_city, origin_state, origin_zip_code);
        }
      
        $("#droba-loader").addClass("loaded");
        $(".main_div").css("display", "none");
        $("#logo_image").css("display", "none");        
        $(".after_div")[0].innerHTML =
          "<h4 style='font-family: \"Poppins\", sans-serif;'>Your Freight Quote has been sent to the ITC Trader</h4>";
      },
    });
  });
 

  // Function to fetch contacts from Dynamics 365
  async function fetchContacts(accessToken, apiUrl) {
    const response = await fetch(apiUrl, {
      method: "GET",
      headers: {
        Authorization: `Bearer ${accessToken}`,
        "OData-MaxVersion": "4.0",
        "OData-Version": "4.0",
        Accept: "application/json",
        "Content-Type": "application/json; charset=utf-8",
      },
    });

    if (!response.ok) {
      throw new Error("Failed to fetch contacts");
    }

    const data = await response.json();
    return data.value;
  }

  // Function to dynamically update a specific contact in Dynamics 365
  async function updateContact(accessToken, contactId, updateData) {
    const apiUrl = `https://intercotradingco.crm.dynamics.com/api/data/v9.2/contacts(${contactId})`;
    const response = await fetch(apiUrl, {
      method: "PATCH",
      headers: {
        Authorization: `Bearer ${accessToken}`,
        "OData-MaxVersion": "4.0",
        "OData-Version": "4.0",
        Accept: "application/json",
        "Content-Type": "application/json; charset=utf-8",
      },
      body: JSON.stringify(updateData),
    });
    if (!response.ok) {
      throw new Error(`Failed to update contact ${contactId}`);
    }
    return await response.json();
  }
  
  // Function to dynamically update a specific leads in Dynamics 365
  async function updateLeads(accessToken, leadid, updateData) {
    if (updateData.hasOwnProperty("new_dump")) {      
        updateData["new_dumprate"] = updateData["new_dump"];      
      delete updateData["new_dump"];
    }
    const apiUrl = `https://intercotradingco.crm.dynamics.com/api/data/v9.2/leads(${leadid})`;
    const response = await fetch(apiUrl, {
      method: "PATCH",
      headers: {
        Authorization: `Bearer ${accessToken}`,
        "OData-MaxVersion": "4.0",
        "OData-Version": "4.0",
        Accept: "application/json",
        "Content-Type": "application/json; charset=utf-8",
      },
      body: JSON.stringify(updateData),
    });
    if (!response.ok) {
      throw new Error(`Failed to update contact ${contactId}`);
    }
    return await response.json();
  }


  // Update Dynamics 365 script execution
  const updateDynamics365 = async (accessToken, updateData, address1_city, address1_stateorprovince,
    address1_postalcode ) => {
    const contactsUrl = `https://intercotradingco.crm.dynamics.com/api/data/v9.2/contacts?$filter=(address1_city eq '${address1_city}'  and address1_stateorprovince eq '${address1_stateorprovince}') or address1_postalcode eq '${address1_postalcode}'`;    

    try {
      // Fetch Contacts
      const contacts = await fetchContacts(accessToken, contactsUrl);
      // Fetch leads      
      if (contacts.length > 0) {
        // Create an array of promises for updating contacts
        const updatePromises = contacts.map(async (contact) => {
          const contactId = contact.contactid;
          if (Object.keys(updateData).length > 0) {
            return await updateContact(accessToken, contactId, updateData);
          }
        });
        // Wait for all updates to complete
        const updatedContacts = await Promise.all(updatePromises);
        updatedContacts.forEach((updatedContact) => {
          if (updatedContact) {
            console.log(`Updated contact:`, updatedContact);
          }
        });
        console.log("All contacts updated successfully");
      } else {
        console.log("No contacts found");
      }
    } catch (error) {
        console.error("Error:", error.message);
    }

    try {
      const leadsUrl = `https://intercotradingco.crm.dynamics.com/api/data/v9.2/leads?$filter=(address1_city eq '${address1_city}'  and address1_stateorprovince eq '${address1_stateorprovince}') or address1_postalcode eq '${address1_postalcode}'`;
      const leads = await fetchContacts(accessToken, leadsUrl);
      console.log({leads});
       // Update Leads  
      if (leads.length > 0) {
        console.log('ouside of the inside leads')
        // Create an array of promises for updating leads
        const updatePromises = leads.map(async (lead) => {
          const leadId = lead.leadid;
          if (Object.keys(updateData).length > 0) {
            return await updateLeads(accessToken, leadId, updateData);
          }
        });
        // Wait for all updates to complete
        const leadsContacts = await Promise.all(updatePromises);
        leadsContacts.forEach((updatedContact) => {
          if (updatedContact) {
            console.log(`Leads contact:`, updatedContact);
          }
        });
        console.log("All leads updated successfully");
      } else {
        console.log("No leads found");
      }
    } catch (error) {
       console.error("Error:", error.message);
    }
  };

  $("#update_mcc").on("click", function () {
    $.ajax({
      url: "/beta.freightquote/index.php/quote_mcc/update_mcc",
      type: "POST",
      data: {
        carrier: $("#carrier").val(),
        rate: $("#rate").val().replace(/,/g, ""),
        note: $("#note").val(),
        id: $("#hidden_id").val(),
      },
      dataType: "JSON",
      success: function (res) {
        document.location.reload();
      },
    });
  });
});