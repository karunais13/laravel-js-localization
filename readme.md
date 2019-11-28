# Simple JS Localization
###### NOTE: Support laravel 5.0 and above. 
[Laravel](http://laravel.com/) has some pretty sweet functions for translation, but the function only limited to blade or php file only.
Thus, This package convert all your localization messages from your Laravel app to JavaScript with a simple logic to interact with those messages following a very similar syntax you are familiar with.

## Installation

Install the usual [composer](https://getcomposer.org/) way.

###### Run this command at root directory of your project
```json
"composer require karu/simple-js-localization"
```

#### For Laravel 5.5 and below add provider in config file like below : 
###### app/config/app.php 
```php
	...
	
	'providers' => array(
		...
		Karu\SimpleJsLocalization\SimpleJsLocalizationProvider::class,
	]
```



## Usage

The `Simple JS Localization ` package provides a command that generate the JavaScript version of all your messages found at: `resources/lang` (Laravel 5) directory. The resulting JavaScript file will contain all your messages plus a simple logic to use on javascript.

### Generating JS messages

```shell
php artisan localization:generate-js
```

### Compressing the JS file (minified)

```shell
php artisan localization:generate-js -c
```

With the default configuration, this will create a public/js/simple-js-localise.js file to include in your page, or build.
```html
<script src="{{ asset('js/simple-js-localise.js') }}"></script>
```
**Note: You'll have to run localization:generate-js if you change your localization files.**


### Set Locale
```js
window.lang.setLocale("{{ app()->getLocale() }}");
```
### Get Message
```js
window.lang.get("Hello");
//> "Hello";
// If locale set to `es`
//> "Hola" (based on localization from lang folder in resources) 
```


## Licence

[View the licence in this repo.](https://github.com/karunais13/laravel-simple-js-localization/blob/master/LICENSE)
