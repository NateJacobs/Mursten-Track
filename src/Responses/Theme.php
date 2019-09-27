<?php

namespace NateJacobs\MurstenTrack\Responses;

class Theme
{
	public function __construct($theme)
	{
		$this->theme = $theme['theme'];
		$this->subtheme = isset($theme['subtheme']) ? $theme['subtheme'] : '';
		$this->setCount = isset($theme['setCount']) ? $theme['setCount'] : '';
		$this->subthemeCount = isset($theme['subthemeCount']) ? $theme['subthemeCount'] : '';
		$this->startYear = isset($theme['yearFrom']) ? $theme['yearFrom'] : '';
		$this->endYear = isset($theme['yearTo']) ? $theme['yearTo'] : '';

		return $this;
	}
}
