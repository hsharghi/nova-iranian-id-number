## Iranian ID Number validation field for Laravel Nova

Iranian national ID number validation field for Laravel Nova,
Just for the frontend it will not prevent from submitting the form.

## Installation

You can install the package in to a Laravel app that uses Nova via composer:

```bash
composer require hsharghi/iranian_id_number
```

## Usage:
Add the below to Nova/User.php resource:

```php

IranianIdNumber::make('id_number')
                ->rules('min:10', 'max:10'),

```


## Support:
https://github.com/hsharghi/nova-iranian-id-number/issues


## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
