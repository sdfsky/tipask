<?php namespace Germey\Geetest;

use Illuminate\Support\Facades\Config;

class GeetestLib
{
	/**
	 * @var const
	 */
	const GT_SDK_VERSION = 'php_3.0.0';

	/**
	 * @var int
	 */
	public static $connectTimeout = 5;

	/**
	 * @var int
	 */
	public static $socketTimeout = 5;

	/**
	 * @var
	 */
	private $response;

	/**
	 * @var string
	 */
	protected $url = '';

	/**
	 * @var
	 */
	protected $captcha_id;

	/**
	 * @var
	 */
	protected $private_key;

	/**
	 * @return string
	 */
	public function getGeetestUrl()
	{
		return $this->url;
	}

	/**
	 * @param string $geetestUrl
     * @return GeetestLib
	 */
	public function setGeetestUrl($url)
	{
		$this->url = $url;
		return $this;
	}

	/**
	 * GeetestLib constructor.
	 */
	public function __construct()
	{
		$this->captcha_id = Config::get('geetest.id');
		$this->private_key = Config::get('geetest.key');
	}

	/**
	 * Check Geetest server is running or not.
	 *
	 * @param null $user_id
	 * @return int
	 */
	public function preProcess($param, $new_captcha = 1)
	{
		$data = [
			'gt' => $this->captcha_id,
			'new_captcha' => $new_captcha
		];
		$data = array_merge($data, $param);
		$query = http_build_query($data);
		$url = "http://api.geetest.com/register.php?" . $query;
		$challenge = $this->sendRequest($url);

		if (strlen($challenge) != 32) {
			$this->failbackProcess();
			return 0;
		}
		$this->successProcess($challenge);
		return 1;
	}

	/**
	 * @param $challenge
	 */
	private function successProcess($challenge)
	{
		$challenge = md5($challenge . $this->private_key);
		$result = [
			'success' => 1,
			'gt' => $this->captcha_id,
			'challenge' => $challenge,
			'new_captcha' => 1
		];
		$this->response = $result;
	}

	/**
	 *
	 */
	private function failbackProcess()
	{
		$rnd1 = md5(rand(0, 100));
		$rnd2 = md5(rand(0, 100));
		$challenge = $rnd1 . substr($rnd2, 0, 2);
		$result = [
			'success' => 0,
			'gt' => $this->captcha_id,
			'challenge' => $challenge,
			'new_captcha' => 1
		];
		$this->response = $result;
	}

	/**
	 * @return mixed
	 */
	public function getResponseStr()
	{
		return json_encode($this->response);
	}


	/**
	 *
	 * @return mixed
	 */
	public function getResponse()
	{
		return $this->response;
	}

	/**
	 * Get success validate result.
	 *
	 * @param      $challenge
	 * @param      $validate
	 * @param      $seccode
	 * @param null $user_id
	 * @return int
	 */
	public function successValidate($challenge, $validate, $seccode, $param, $json_format = 1)
	{
		if (! $this->checkValidate($challenge, $validate)) {
			return 0;
		}
		$query = [
			"seccode" => $seccode,
			"timestamp" => time(),
			"challenge" => $challenge,
			"captchaid" => $this->captcha_id,
			"json_format" => $json_format,
			"sdk" => self::GT_SDK_VERSION,
		];
		$query = array_merge($query, $param);
		$url = "http://api.geetest.com/validate.php";
		$codevalidate = $this->postRequest($url, $query);
		$obj = json_decode($codevalidate, true);
		if ($obj === false) {
			return 0;
		}
		if ($obj['seccode'] == md5($seccode)) {
			return 1;
		} else {
			return 0;
		}
	}

	/**
	 * Get fail result.
	 *
	 * @param $challenge
	 * @param $validate
	 * @param $seccode
	 * @return int
	 */
	public function failValidate($challenge, $validate, $seccode)
	{
		if (md5($challenge) == $validate) {
			return 1;
		} else {
			return 0;
		}

	}

	/**
	 * @param $challenge
	 * @param $validate
	 * @return bool
	 */
	private function checkValidate($challenge, $validate)
	{
		if (strlen($validate) != 32) {
			return false;
		}
		if (md5($this->private_key . 'geetest' . $challenge) != $validate) {
			return false;
		}

		return true;
	}

	/**
	 * GET
	 *
	 * @param $url
	 * @return mixed|string
	 */
	private function sendRequest($url)
	{

		if (function_exists('curl_exec')) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, self::$connectTimeout);
			curl_setopt($ch, CURLOPT_TIMEOUT, self::$socketTimeout);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$curl_errno = curl_errno($ch);
			$data = curl_exec($ch);
			curl_close($ch);
			if ($curl_errno > 0) {
				return 0;
			} else {
				return $data;
			}
		} else {
			$opts = array(
				'http' => array(
					'method' => "GET",
					'timeout' => self::$connectTimeout + self::$socketTimeout,
				)
			);
			$context = stream_context_create($opts);
			$data = @file_get_contents($url, false, $context);
			if ($data) {
				return $data;
			} else {
				return 0;
			}
		}
	}

	/**
	 * @param       $url
	 * @param array $postdata
	 * @return mixed|string
	 */
	private function postRequest($url, $postdata = '')
	{
		if (! $postdata) {
			return false;
		}
		$data = http_build_query($postdata);
		if (function_exists('curl_exec')) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, self::$connectTimeout);
			curl_setopt($ch, CURLOPT_TIMEOUT, self::$socketTimeout);
			//不可能执行到的代码
			if (! $postdata) {
				curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
			} else {
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			}
			$data = curl_exec($ch);
			if (curl_errno($ch)) {
				$err = sprintf("curl[%s] error[%s]", $url, curl_errno($ch) . ':' . curl_error($ch));
				$this->triggerError($err);
			}
			curl_close($ch);
		} else {
			if ($postdata) {
				$opts = array(
					'http' => array(
						'method' => 'POST',
						'header' => "Content-type: application/x-www-form-urlencoded\r\n" . "Content-Length: " . strlen($data) . "\r\n",
						'content' => $data,
						'timeout' => self::$connectTimeout + self::$socketTimeout
					)
				);
				$context = stream_context_create($opts);
				$data = file_get_contents($url, false, $context);
			}
		}
		return $data;
	}


	/**
	 * @param $err
	 */
	private function triggerError($err)
	{
		trigger_error($err);
	}

	/**
	 * @param string $product
	 */
	public function render($product = 'float', $captchaId = 'geetest-captcha')
	{
		return view('geetest::geetest', [
			'captchaid' => $captchaId,
			'product' => $product,
			'url' => $this->url
		]);
	}

}

