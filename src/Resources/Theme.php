<?php

namespace NateJacobs\MurstenTrack\Resources;

use NateJacobs\MurstenTrack\Request;
use NateJacobs\MurstenTrack\Responses\Theme as ThemeResponse;

class Theme extends Request
{
	public function getThemes()
	{
		try {
			$response = $this->request('getThemes', 'get', []);
			return $this->createReturnObject($response);
		} catch(\Exception $e) {
			return $e;
		}
	}

	public function getSubthemes($theme)
	{
		if (false === isset($theme)) {
			throw new MissingParamsException('You must provide a theme name.');
		}

		try {
			$response = $this->request('getSubthemes', 'get', ['parentTheme' => $theme]);
			return $this->createReturnObject($response);
		} catch(\Exception $e) {
			return $e;
		}
	}

	public function createReturnObject($response)
	{
		$response = is_array($response) ? $response : [$response];
		$loop = isset($response['themes']) ? $response['themes'] : $response['subthemes'] ;
		foreach ($loop as $object) {
			foreach ($object as $key => $theme) {
				if (is_array($theme) && count($theme) === 0) {
					$theme = '';
				}

				$final_theme[$key] = $theme;
			}

			$themes[] = new ThemeResponse($final_theme);
		}

		return $themes;
	}
}
