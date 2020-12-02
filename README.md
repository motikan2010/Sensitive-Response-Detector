# Sensitive-Response-Detector for Laravel

If contain sensitive data in response, block the response.

[Demo Site](https://response-detector-demo.herokuapp.com/)

## Getting Started

### 1. Install 

```
$ composer require motikan2010/sensitive-response-detector
```

### 2. Publish

```
$ php artisan vendor:publish --tag=detector
```

## Usage

```php
Route::group(['middleware' => 'sensitive.detector'], function () {
    Route::get('/', function () {
        return view('welcome');
    });
});
```
