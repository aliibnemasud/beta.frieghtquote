# Freight Quote

This project is to request and reply the data of the freight quote.

## Project Location

- Product: `/home/intercotrading/public_html/itcep/freightquote`
- Staging: `/home/intercotrading/public_html/itcep/beta.freightquote`

## Default Controller

This controller will display the page to request the data of the freight.

- Location: `/application/controllers/Quote.php`
- Method: `index`

## Request Freight Quote

It inserts the data on the database and sends Email to [freightrate@intercotradingco.com](mailto: freightrate@intercotradingco.com).

It uses the WordPress logged-in user as the trader and uses the `wp_get_current_user` function to get. It uses the PHP `mail` function to send and reply.

The `save_fright_quote` function processes a freight quote request submitted through a form. It collects the submitted data, saves it into the database, and sends a notification email containing the details of the request. If the request `van_dump` type is `LTL`, it also processes and saves number `pallets` data associated with the freight.

### Process Pallet Data (if LTL)

* Checks if the `van_dump` field indicates "LTL".
* If true, retrieves and decodes the pallet_data from the form.
* Iterates over each pallet and saves its data into the `tbl_freight_ltl_pallets` table using the `save_pallet` method of the `General_m` model.

- Controller
  - Location: `/application/controllers/Quote.php`
  - Method: `save_fright_quote` , `save_pallet`
- Model
  - Location: `/application/models/General_m.php`
  - Query: `save_freight_quote($data)`
- View
  - Location: `/application/views/request_view.php`  
- Email Template
  - Location: `/application/views/Email.php`
  - Send To: `freightrate@intercotradingco.com`

## Reply Freight Quote

It updates the freight quote data and sends Email to the `trader` also `freightrate@intercotradingco.com` this email to get record. Also update the data to the `dynamics365` on contracts which match with the `location` by using the the dynamic integration. Method `update_mcc` first portion it's generating a token and sending to the response and then it's updating on Microsoft Dynamics 360. 

And here, can register a new carrier.

- Controller
  - Location: `/application/controllers/Quote_mcc.php`
  - Method: `update_mcc`
- Model
  - Location: `/application/models/General_m.php`
- View
  - Location: `/application/views/mmc_view.php`
- Email Template
  - Location: `/application/views/Email_trader_back.php`
  - Send To: `{trader_email}`

### Register Carrier

- Controller
  - Method: `save_carrier`


## Freight History Feature

The Freight History feature allows users to view a history of freight records filtered by the `origin city` and `state`. This feature includes an HTML section to display the history, a PHP controller for handling filter requests, a database query `get_filtered_freight($origin_city, $origin_state)` to fetch filtered freight records, and a JavaScript implementation to handle user interactions and update the UI dynamically.

- Controller
  - Location: `/application/controllers/Quote.php`
  - Method: `filter`
- Model
  - Location: `/application/models/General_m.php`
  - Query: `get_filtered_freight($origin_city, $origin_state)`
- View
  - Location: `/application/views/request_view.php`
  - Methods: `fetchFreights()` && `updateDestinationText()`

The JavaScript code handles user interactions, updates the destination text dynamically, and fetches the filtered freight data via AJAX. It also updates the DOM with the retrieved data.

Also, this feature only visible for `allowedEmails` checking the the user email form `userData` in the view. This allowed email coming from `https://graph.microsoft.com/v1.0/groups/2711c863-bf93-49ab-8069-d7f06835fa43/members` This group members.


## CSS & JavaScript libraries

- Bootstrap
- jQuery

## Structure

```pre
/application
├── /config
├── /controllers
├── /language
├── /models
├── /vendors
└── /views
/assets
/system
/composer.json
/credentials.json
/index.php
```

## /application/config

Holds all the configuration files, such as database settings, routes, and constants.

## /application/controllers

Controllers act as an intermediary between models and views.
They process incoming requests, interact with the model to retrieve or manipulate data, and then load the appropriate view to display the result.

## /application/models

Models are responsible for handling the data logic of the application.
They interact with the database, fetch data, and return it to the controller.

## /application/vendors

This directory is typically used by Composer to store dependencies, although CodeIgniter doesn't require Composer by default.

## /application/views

Views are responsible for the user interface.
They present the data provided by the controller in a format that is understandable to the user, typically as HTML pages.

## /assets

This directory contains the image, css, and javascript files.

## /system

This directory contains the core CodeIgniter framework code.
You generally don't need to modify anything in this directory.

## /index.php

This is the front controller of the application.
It initializes CodeIgniter and routes all requests through the framework.
It's the entry point to the application.
