# Laravel Geetest

[![Build Status](https://travis-ci.org/Germey/LaravelGeetest.svg?branch=master)](https://travis-ci.org/Germey/LaravelGeetest)
[![DUB](https://img.shields.io/dub/l/vibe-d.svg?maxAge=2592000?style=plastic)](https://github.com/Germey/LaravelGeetest)
[![Support](https://img.shields.io/badge/support-laravel-orange.svg)](https://laravel.com/)
[![Release](https://img.shields.io/badge/release-3.0.0-orange.svg)](https://github.com/Germey/LaravelGeetest/releases)

Laravel Geetest is a package for Laravel 5 developed by [Germey](http://cuiqingcai.com). It provides simple usage for laravel of [Geetest](http://www.geetest.com/). 

Geetest Demo: [Geetest](https://www.geetest.com/show)

## Installation

Laravel 5.0 or later is required.

This Package now supports Geetest 3.0. 

For Geetest 2.0, please see [LaravelGeetest 2.0](https://github.com/Germey/LaravelGeetest/tree/v2.0.3)

To get the latest version of Laravel Geetest, simply require the project using Composer:

```
$ composer require germey/geetest
```

Or you can add following to `require` key in `composer.json`:

```json
"germey/geetest": "~3.0"
```

then run:

```
$ composer update
```

Next, You should need to register the service provider. Open up `config/app.php` and add following into the `providers` key:

```php
Germey\Geetest\GeetestServiceProvider::class
```

And you can register the Geetest Facade in the `aliases` of `config/app.php` :

```php
'Geetest' => Germey\Geetest\Geetest::class
```

## Configuration

To get started, you need to publish vendor assets using the following command:

```
$ php artisan vendor:publish --tag=geetest
```

This will create a config file named `config/geetest.php` which you can configure geetest as you like.

It will also generate a views folder named `resources/views/vendor/geetest`, there will be a view file named `geetest.blade.php`. Here you can configure styles of geetest. For example, you can change the script `alert()` as you like.

## Usage

Firstly, You need to register in [Geetest](http://www.geetest.com/). Creating an app and get `ID` and `KEY`.

For example. You can see app `ID` and `KEY` after you added an app in [Geetest Admin Page](http://account.geetest.com)

![](https://ws3.sinaimg.cn/large/006tKfTcly1fh3qherw91j31kw0e6q4p.jpg)

Then configure them in your `.env` file because you'd better not make them public.

Add them to `.env` as follows:

```
GEETEST_ID=0f1097bef7xxxxxx9afdeced970c63e4
GEETEST_KEY=c070f0628xxxxxxe68e138b55c56fb3b
```

Then, You can use `render()` in views like following, It will render a geetest code captcha:

```php
{!! Geetest::render() !!}
```

 For example, you can use it in `form` like this:

```html
<form action="/" method="post">
    <input name="_token" type="hidden" value="{{ csrf_token() }}">
    <input type="text" name="name" placeholder="name">
    {!! Geetest::render() !!}
    <input type="submit" value="submit">
</form>
```

It will render like this:

![](https://ws4.sinaimg.cn/large/006tKfTcly1fh3qp3fhafj30i8052q37.jpg)


When you click the `submit` button, it will verify the Geetest Code. If you didn't complete the validation, it will alert some text and prevent the form from submitting.

Or you can set other style of Geetest:

```php
{!! Geetest::render('float') !!}
{!! Geetest::render('bind') !!}
{!! Geetest::render('popup') !!}
{!! Geetest::render('custom') !!}
```

Then it will be embed or popup style in the website. Default to `float`.

If the validation is completed, the form will be submitted successfully.

## Server Validation

What's the reason that Geetest is safe? If it only has client validation of frontend, can we say it is complete? It also has server validation to ensure that the post request is validate.

First I have to say that you can only use Geetest of Frontend. But you can also do simple things to achieve server validation.

You can use `$this->validate()` method to achieve server validation. Here is an example:

```php
use Illuminate\Http\Request;

class BaseController extends Controller 
{
    /**
     * @param Request $request
     */
    public function postValidate(Request $request)
    {
        $this->validate($request, [
            'geetest_challenge' => 'geetest',
        ], [
            'geetest' => config('geetest.server_fail_alert')
        ]);
        return true;
    }
} 
```

If we use Geetest, the form will post three extra parameters `geetest_challenge` `geetest_validate` `geetest_seccode`. Geetest use these three parameters to achieve server validation.

If you use ORM, we don't need to add these keys to Model, so you should add following in Model:

```php
protected $guarded = ['geetest_challenge', 'geetest_validate', 'geetest_seccode'];
```

You can define alert text by altering `server_fail_alert` in `config/geetest.php`

Also you can use Request to achieve validation:

```php
<?php namespace App\Http\Requests;
use App\Http\Requests\Request;

class ValidationRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'geetest_challenge' => 'geetest'
        ];
    }

    /**
     * Get validation messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'geetest' => 'Validation Failed'
        ];
    }
}

```

We can use it in our Controller by Request parameter:

```php
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use App\Http\Requests\ValidationRequest;

class BaseController extends Controller 
{
    /**
     * @param Request $request
     */
    public function postValidate(ValidationRequest $request)
    {
        // is Validate
    }
} 
```

## Options

### Change Ajax Url

If you want to change the Geetest Ajax Url, you can configure it in `config/geetest.php`, change `url` as you like, but at this time you need to add extra routes in your `routes.php` (Laravel 5.2 or former ) or `routes/web.php` (Laravel 5.3 or later). And you need to add a triat in your controller.

For example, If you add this route:

```php
Route::get('auth/geetest','Auth\AuthController@getGeetest');
```

you need to add  `Germey\Geetest\GeetestCaptcha` in your `AuthController`:

```php
use Germey\Geetest\GeetestCaptcha;
class AuthController extends Controller {
    use GeetestCaptcha;
}
```

Then an Ajax url is configured successfully.

Also you can use this Trait in other Controller but you need to configure  `url` in `config/geetest.php`.

### Configure Url while rendering

Also, you can set Geetest Ajax Url by following way:

```php
{!! Geetest::setGeetestUrl('/auth/geetest')->render() !!}
```

By `setGeetestUrl` method you can set Geetest Ajax Url. If it is configured, it will override `url` configured in `config/geetest.php`.

### Configure Alert Message

You can configure alert message by configure `client_fail_alert` and `server_fail_alert` in `config/geetest.php`.

### Configure Language

Geetest supports different language:

* Simplified Chinese
* Traditional Chinese
* English
* Japanese
* Korean

You can configure it in `config/geetest.php` .

Here are key-values of Languge Configuration:

- zh-cn (Simplified Chinese) 
- zh-tw (Traditional Chinese)
- en (English)
- ja (Japanese)
- ko (Korean)

for example, If you want to use Korean, just change `lang` key to `ko`:

```php
'lang' => 'ko'
```

### Configure Protocol

You can configure protocol in `config/geetest.php` .

for example, If you want to use https, just change `protocol` key to `https`:

```php
'protocol' => 'https'
```

### Configure Default Product

You can configure default product in `config/geetest.php` .

for example, If you want to use popup product, just change `product` key to `popup`:

```php
'product' => 'popup'
```

Mind that it only works when you use like this:

```php
{!! Geetest::render() !!}
```

If you use like this:

```php
{!! Geetest::render('bind') !!}
```

It will override the configuration in `config/geetest.php`.

## Contribution

If you find something wrong with this package, you can send an email to `cqc@cuiqingcai.com`

Or just send a pull request to this repository. 

Pull Requests are really welcomed.

## Author

[Germey](http://cuiqingcai.com) , from Beijing China

## License

Laravel Geetest is licensed under [The MIT License (MIT)](https://github.com/Germey/LaravelGeetest/blob/master/LICENSE).



 

