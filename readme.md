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

Autoload Telerivet API in `composer.json`:
```json
autoload: {
	classmap: [
		database,
		vendor/telerivet/telerivet-php-client/telerivet.php
	],
	...
```
```bash 
composer dumpautoload -o
```

Publish original simple sms config:
```bash 
php artisan vendor:publish
```

Set up sms drivers in `config/sms.php` file:
```php
'telerivet' => [
    'api_key'    => env('TELERIVET_API_KEY'),
    'project_id' => env('TELERIVET_PROJECT_ID')
],
'sun' => [
    'user' => env('SUN_USER'),
    'pass' => env('SUN_PASS'),
    'mask' => env('SUN_MASK'),
    'login_url' => 'http://mcpro.sun-solutions.ph/emcpro/login.aspx'
],
```

## Usage
See [original documentation](https://github.com/SimpleSoftwareIO/simple-sms/blob/master/README.md#usage)

