<?php

namespace Germey\Geetest;

use Illuminate\Routing\Controller;

class GeetestController extends Controller
{
	use GeetestCaptcha;

	public function __construct()
	{
		$version = app()::VERSION;
		if (! preg_match('/5\.1.*/', $version, $matches)) {
			$this->middleware('web');
		}
	}
}