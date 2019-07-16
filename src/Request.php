<?php

namespace NateJacobs\MurstenTrack;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use NateJacobs\MurstenTrack\Exceptions\AuthException;
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
			['base_uri' => 'https://brickset.com/api/v2.asmx/']
		);

		// send API request
		try {
			$response = $client->send($request, ['query' => $options]);

			try {
				$sets = $this->check_brickset_status($response);
				return $this->checkIfMultiArray($sets);
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
			'apiKey' => getenv('MURSTEN_TRACK_KEY')
		];

		if (is_array($params)) {
			$options = array_merge( $defaults, $params );
		} else {
			throw new MissingParamsException('The options provided must be an array.');
		}

		return $options;
	}

	private function check_brickset_status($response)
	{
		if (in_array($response->getStatusCode(), [200, 201, 204]) ) {
			$xml = new \SimpleXMLElement($response->getBody());
			$json = json_decode(json_encode((array)$xml),TRUE);
			return $json['sets'];
		} else {
			throw new Exception('There was a problem with your request.');
		}
	}

	private function checkIfMultiArray($sets)
	{
		if (isset($sets[0]) && is_array($sets[0])) {
			return $sets;
		} else {
			$sets_array[] = $sets;
			return $sets_array;
		}
	}
}
