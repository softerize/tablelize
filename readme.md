# Tablelize

Customizable Laravel Eloquent html tables with pagination, search, sorting and buttons.

## Installation

Require it directly with composer:

```
$ composer require softerize/tablelize
```

Or add it to composer.json:

```
{
    "require": {
        "softerize/tablelize": "^0.1.0"
    }
}
```

After updating composer, add the ServiceProvider to the providers array in config/app.php

```php
Softerize\Tablelize\TablelizeServiceProvider::class,
```

## Simple execution

In your route/controller, do the following:

```php
Route::get('links', function(\Illuminate\Http\Request $request){
    // Create the table list using your model and the request object
    $tablelize = new \Softerize\Tablelize\Tablelize('\App\Models\Link', $request);
    return view('home.index', compact('tablelize'));
});
```

In your view simply generate the HTML:

```php
@extends('layouts.app')

@section('content')
{!! $tablelize->generate() !!}
@endsection
```

This is what you'll get:

![Simple example](http://www.softerize.com/wp-content/uploads/2016/09/example-simple.png)

If you want a more distinct look, you can use additional options and turn it into:

![Advanced example](http://www.softerize.com/wp-content/uploads/2016/09/example-advanced.png)

## Documentation

You'll find the complete documentation at [https://softerize.github.io/tablelize/](https://softerize.github.io/tablelize/).

## Support

In case you need support, please create an issue and we will check it as soon as possible.

If you want to hire a professional support, let us know at [http://www.softerize.com/contact/](http://www.softerize.com/contact/).