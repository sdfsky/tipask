<?php namespace Germey\Geetest;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

trait GeetestCaptcha
{
	/**
	 * Get geetest.
	 */
	public function getGeetest()
	{
		$data = [
			'user_id' => @Auth::user()?@Auth::user()->id:'UnLoginUser',
			'client_type' => 'web',
			'ip_address' => Request::ip()
		];
		$status = Geetest::preProcess($data);
		session()->put('gtserver', $status);
		session()->put('user_id', $data['user_id']);
		echo Geetest::getResponseStr();
	}
}