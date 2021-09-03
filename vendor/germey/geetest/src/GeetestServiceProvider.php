<?php namespace Germey\Geetest;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class GeetestServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->loadViewsFrom(__DIR__ . '/views', 'geetest');

		$this->publishes([
			__DIR__ . '/views' => base_path('resources/views/vendor/geetest'),
			__DIR__ . '/config.php' => config_path('geetest.php'),
		], 'geetest');

		Route::get('geetest', 'Germey\Geetest\GeetestController@getGeetest');

		Validator::extend('geetest', function () {
			list($geetest_challenge, $geetest_validate, $geetest_seccode) = array_values(\request()->only('geetest_challenge', 'geetest_validate', 'geetest_seccode'));
			$data = [
				'user_id' => @Auth::user()?@Auth::user()->id:'UnLoginUser',
				'client_type' => 'web',
				'ip_address' => \request()->ip()
			];
			if (session()->get('gtserver') == 1) {
				if (Geetest::successValidate($geetest_challenge, $geetest_validate, $geetest_seccode, $data)) {
					return true;
				}
				return false;
			} else {
				if (Geetest::failValidate($geetest_challenge, $geetest_validate, $geetest_seccode)) {
					return true;
				}
				return false;
			}
		});

		Blade::extend(function ($value) {
			return preg_replace('/@define(.+)/', '<?php ${1}; ?>', $value);
		});

	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton('geetest', function () {
			return $this->app->make(GeetestLib::class);
		});
	}
}
