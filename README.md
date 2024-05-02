# Laravel Fakturoid

Simple wrapper for official php package https://github.com/fakturoid/fakturoid-php

### Docs

- [Installation](#installation)
- [Configuration](#configuration)
- [Examples](#examples)

## Installation

### Step 1: Install package

Add the package in your composer.json by executing the command.

```bash
composer require dystcz/laravel-fakturoid
```

This will both update composer.json and install the package into the vendor/ directory.

### Step 2: Configuration

First initialise the config file by running this command:

```bash
php artisan vendor:publish
```

With this command, initialize the configuration and modify the created file, located under `config/fakturoid.php`.

## Configuration

```php
return [
    'account_name' => env('FAKTUROID_NAME', 'XXX'),
    'account_email' => env('FAKTUROID_EMAIL', 'XXX'),
    'account_api_key' => env('FAKTUROID_API_KEY', 'XXX'),
    'app_contact' => env('FAKTUROID_APP_CONTACT', 'Application <your@email.cz>'),
];
```

## Examples

### Create Subject, Create Invoice, Send Invoice

```php

use Fakturoid;

try {
    // create subject
    $subject = Fakturoid::createSubject(array(
        'name' => 'Firma s.r.o.',
        'email' => 'aloha@pokus.cz'
    ));
    if ($subject->getBody()) {
        $subject = $subject->getBody();

        // create invoice with lines
        $lines = [
            [
                'name' => 'Big sale',
                'quantity' => 1,
                'unit_price' => 1000
            ],
        ];

        $invoice = Fakturoid::createInvoice(array('subject_id' => $subject->id, 'lines' => $lines));
        $invoice = $invoice->getBody();

        // send created invoice
        Fakturoid::fireInvoice($invoice->id, 'deliver');
    }
} catch (\Exception $e) {
    dd($e->getCode() . ": " . $e->getMessage());
}

```

## License

Copyright (c) 2019 - 2024 dyst digital s.r.o MIT Licensed.
