<?php

namespace NateJacobs\MurstenTrack;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use NateJacobs\MurstenTrack\Exceptions\AuthException;
use NateJacobs\MurstenTrack\Exceptions\ResponseException;
use NateJacobs\MurstenTrack\Exceptions\MissingParamsException;

class Request
{
	// public function __construct() {}

	public function __construct()
	{
		// check if API key is set
		$this->check_api_key();
	}

	protected function request($path, $method = 'get', $params = [])
	{
		// build query request
		$options = $this->build_request_params($params);

		// build API request
		$request = new \GuzzleHttp\Psr7\Request($method, $path);
		$client = new Client(
			['base_uri' => 'https://brickset.com/api/v3.asmx/']
		);

		// send API request
		try {
			$response = $client->send($request, ['query' => $options]);

			try {
				$test = $this->check_brickset_status($response);
var_dump($test);
				return $test;
			} catch(\Exception $e) {
				throw new ResponseException($e);
			}
		} catch (RequestException $e) {
			throw new ResponseException($e);
		}

		return $response;
	}

	private function check_api_key()
	{
		$key = getenv('MURSTEN_TRACK_KEY');

		if (false === $key || empty($key)) {
			throw new AuthException('Missing Brickset API key.');
		}
	}

	private function build_request_params($params)
	{
		$defaults = [
			'apiKey' => getenv('MURSTEN_TRACK_KEY'),
			'userHash' => isset($params['userHash']) ? $params['userHash'] : '',
		];

		if (isset($params['parentTheme'])) {
			$defaults['Theme'] = $params['parentTheme'];
		}

		if (isset($params['setID'])) {
			$defaults['setID'] = $params['setID'];
		}

		if (is_array($params)) {
			if (isset($params['userHash'])) {
				unset($params['userHash']);
			}

			$json_params = ['params' => \json_encode($params)];

			$options = array_merge( $defaults, $json_params );
		} else {
			throw new MissingParamsException('The options provided must be an array.');
		}

		return $options;
	}

	private function check_brickset_status($response)
	{
		if (in_array($response->getStatusCode(), [200, 201, 204]) ) {
			return json_decode($response->getBody()->getContents(),TRUE);
		} else {
			throw new Exception('There was a problem with your request.');
		}
	}
}
