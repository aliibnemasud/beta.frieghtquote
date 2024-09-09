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

It inserts the data on the database and sends Email to [bobs2itcscrap.com](mailto:bobs2itcscrap.com).

It uses the WordPress logged-in user as the trader and uses the `wp_get_current_user` function to get.

It uses the PHP `mail` function to send and reply.

- Controller
  - Location: `/application/controllers/Quote.php`
  - Method: `save_employee`
- Model
  - Location: `/application/models/General_m.php`
- View
  - Location: `/application/views/request_view.php`
- Email Template
  - Location: `/application/views/Email.php`
  - Send To: `bobs@itcscrap.com`

## Reply Freight Quote

It updates the freight quote data and sends Email to the trader.

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
