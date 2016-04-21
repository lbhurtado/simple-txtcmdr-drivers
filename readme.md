# simple-txtcmdr-drivers
Additional providers for [Simple-SMS Laravel package](https://github.com/SimpleSoftwareIO/simple-sms)

## Installation
```bash 
composer require "lbhurtado/simple-txtcmdr-drivers: dev-master"
```

Instead of original simple sms service provider, set our:
```php
'providers' => [
  ...
  LBHurtado\SMS\SMSServiceProvider::class
]
```

Set original simple sms alias:
```php
'aliases' => [
  ...
  'SMS' => SimpleSoftwareIO\SMS\Facades\SMS::class
```

Autoload Telerivet API in composer.json (composer dumpautoload -o):
```php
autoload: {
	classmap: [
		database,
		vendor/telerivet/telerivet-php-client/telerivet.php
	],
	...
```


Publish original simple sms config:
```bash 
php artisan vendor:publish
```

Now you can set up addtition sms drivers in `config/sms.php` file:
```php
'telerivet' => [
    'api_key'    => env('TELERIVET_API_KEY'),
    'project_id' => env('TELERIVET_PROJECT_ID')
],
```

## Usage
See [original documentation](https://github.com/SimpleSoftwareIO/simple-sms/blob/master/README.md#usage)

