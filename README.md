# Sensitive-Response-Detector for Laravel

## Usage

```php
Route::group(['middleware' => 'sensitive.detector'], function () {
    Route::get('/', function () {
        return view('welcome');
    });
});
```
