# Sensitive-Response-Detector for Laravel

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
