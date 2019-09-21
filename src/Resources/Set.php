<?php

namespace NateJacobs\MurstenTrack\Resources;

use NateJacobs\MurstenTrack\Request;
use NateJacobs\MurstenTrack\Utilities;
use NateJacobs\MurstenTrack\Responses\Set as SetResponse;
use NateJacobs\MurstenTrack\Exceptions\MissingParamsException;

class Set extends Request
{
	public function getSets($options)
	{
		$defaults = [
			'userHash' => '',
			'query' => '',
			'theme' => '',
			'subtheme' => '',
			'setNumber' => '',
			'year' => '',
			'owned' => '',
			'wanted' => '',
			'orderBy' => 'number',
			'pageSize' => 20,
			'pageNumber' => 1,
			'userName' => '',
		];

		if (false === is_array($options)) {
			throw new MissingParamsException('The options provided must be an array.');
		}

		if (is_array($options)) {
			$options = array_merge( $defaults, $options );
		}

		try {
			$response = $this->request('getSets', 'get', $options);
			// return $response;
			return $this->createReturnObject($response);
		} catch(\Exception $e) {
			return $e;
		}

	}

	public function getSet($id = null)
	{
		if (is_null($id)) {
			Utilities::missingIDParam();
		}


	}

	public function getUpdatedSets($minutesAgo = 1000)
	{
		if ('' === $minutesAgo || is_null($minutesAgo)) {
			return Utilities::missingValue('how many minutes ago to check');
		}
	}

	public function getAdditionalImages($id = null)
	{
		if (is_null($id) || '' === $id) {
			return Utilities::missingIDParam();
		}
	}

	public function getReviews($id = null)
	{
		if (is_null($id) || '' === $id) {
			return Utilities::missingIDParam();
		}
	}

	public function getInstructions($id = null)
	{
		if (is_null($id) || '' === $id) {
			return Utilities::missingIDParam();
		}
	}

	public function setCollectionQuantity($id = null, $options)
	{
		if (is_null($id) || '' === $id) {
			return Utilities::missingIDParam();
		}

		if (false === is_array($options)) {
			throw new MissingParamsException('The options provided must be an array.');
		}

		if (false === isset($options['qtyOwned'])) {
			return Utilities::missingValue('How many of this set do you own? You must pass qtyOwned.');
		}

		$defaults = [
			'setID' => $id,
		];

		if (is_array($options)) {
			$options = array_merge( $defaults, $options );
		}

		try {
			$response = $this->request('setCollection_qtyOwned', 'get', $options);
			return $this->createReturnObject($response);
		} catch(\Exception $e) {
			return $e;
		}
	}

	public function createReturnObject($response)
	{
		$response = is_array($response) ? $response : [$response];

		foreach ($response as $object) {
			foreach ($object as $key => $set) {
				if (is_array($set) && count($set) === 0) {
					$set = '';
				}

				$final_set[$key] = $set;
			}

			$sets[] = new SetResponse($final_set);
		}

		return $sets;
	}
}
