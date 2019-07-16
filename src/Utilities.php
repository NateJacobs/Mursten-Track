<?php

namespace NateJacobs\MurstenTrack;

use NateJacobs\MurstenTrack\Exceptions\MissingParamsException;

class Utilities
{
	public static function missingIDParam()
	{
		throw new MissingParamsException('You must pass a set ID. The ID is not the set number, but the Brickset database ID.');
	}

	public static function missingValue($value = '')
	{
		throw new MissingParamsException('You must pass '.$value.'.');
	}
}
