<?php

namespace NateJacobs\MurstenTrack\Responses;

class Set
{
	public function __construct($set)
	{
		$this->itemNumbers = $this->setNumbers($set);
		$this->themeDetails = $this->setThemes($set);
		$this->dimensions = $this->setDimensions($set);
		$this->images = $this->setImages($set);
		$this->prices = $this->setPrices($set);
		$this->userCollection = $this->setCollection($set);
		$this->name = isset($set['name']) ? $set['name'] : '';
		$this->year = isset($set['year']) ? $set['year'] : '';
		$this->pieces = isset($set['pieces']) ? $set['pieces'] : '';
		$this->minifigs = isset($set['minifigs']) ? $set['minifigs'] : '';
		$this->bricksetURL = isset($set['bricksetURL']) ? $set['bricksetURL'] : '';
		$this->released = isset($set['released']) ? $set['released'] : '';
		$this->ownedByTotal = isset($set['collections']['ownedBy']) ? $set['collections']['ownedBy'] : '';
		$this->wantedByTotal = isset($set['collections']['wantedBy']) ? $set['collections']['wantedBy'] : '';
		$this->rating = isset($set['rating']) ? $set['rating'] : '';
		$this->reviewCount = isset($set['reviewCount']) ? $set['reviewCount'] : '';
		$this->packagingType = isset($set['packagingType']) ? $set['packagingType'] : '';
		$this->availability = isset($set['availability']) ? $set['availability'] : '';
		$this->instructionsCount = isset($set['instructionsCount']) ? $set['instructionsCount'] : '';
		$this->ageMin = isset($set['ageRange']['min']) ? $set['ageRange']['min'] : '';
		$this->ageMax = isset($set['ageRange']['max']) ? $set['ageRange']['max'] : '';
		$this->category = isset($set['category']) ? $set['category'] : '';
		$this->EAN = isset($set['barcode']['EAN']) ? $set['barcode']['EAN'] : '';
		$this->UPC = isset($set['barcode']['UPC']) ? $set['barcode']['UPC'] : '';
		$this->lastUpdated = isset($set['lastUpdated']) ? $set['lastUpdated'] : '';

		return $this;
	}

	private function setNumbers($set)
	{
		return [
			'setID' => isset($set['setID']) ? $set['setID'] : '',
			'number' => isset($set['number']) ? $set['number'] : '',
			'numberVariant' => isset($set['numberVariant']) ? $set['numberVariant'] : '',
		];
	}

	private function setThemes($set)
	{
		return [
			'theme' => isset($set['theme']) ? $set['theme'] : '',
			'themeGroup' => isset($set['themeGroup']) ? $set['themeGroup'] : '',
			'subtheme' => isset($set['subtheme'])? $set['subtheme'] : '',
		];
	}

	private function setDimensions($set)
	{
		return [
			'height' => isset($set['dimensions']['height']) ? $set['dimensions']['height'] : '',
			'width' => isset($set['dimensions']['width']) ? $set['dimensions']['width'] : '',
			'depth' => isset($set['dimensions']['depth']) ? $set['dimensions']['depth'] : '',
			'weight' => isset($set['dimensions']['weight']) ? $set['dimensions']['weight'] : '',
		];
	}

	private function setImages($set)
	{
		return [
			'thumbnailURL' => isset($set['image']['thumbnailURL']) ? $set['image']['thumbnailURL'] : '',
			'imageURL' => isset($set['image']['imageURL']) ? $set['image']['imageURL'] : '',
			'additionalImageCount' => isset($set['additionalImageCount']) ? : '',
		];
	}

	private function setPrices($set)
	{
		return [
			'UK' => [
				'retailPrice' => isset($set['LEGOCom']['UK']['retailPrice']) ? $set['LEGOCom']['UK']['retailPrice'] : '',
				'dateFirstAvailable' => isset($set['LEGOCom']['UK']['dateFirstAvailable']) ? $set['LEGOCom']['UK']['dateFirstAvailable'] : '',
				'dateLastAvailable' => isset($set['LEGOCom']['UK']['dateLastAvailable']) ? $set['LEGOCom']['UK']['dateLastAvailable'] : '',
			],
			'US' => [
				'retailPrice' => isset($set['LEGOCom']['US']['retailPrice']) ? $set['LEGOCom']['US']['retailPrice'] : '',
				'dateFirstAvailable' => isset($set['LEGOCom']['US']['dateFirstAvailable']) ? $set['LEGOCom']['US']['dateFirstAvailable'] : '',
				'dateLastAvailable' => isset($set['LEGOCom']['US']['dateLastAvailable']) ? $set['LEGOCom']['US']['dateLastAvailable'] : '',
			],
			'CA' => [
				'retailPrice' => isset($set['LEGOCom']['CA']['retailPrice']) ? $set['LEGOCom']['CA']['retailPrice'] : '',
				'dateFirstAvailable' => isset($set['LEGOCom']['CA']['dateFirstAvailable']) ? $set['LEGOCom']['CA']['dateFirstAvailable'] : '',
				'dateLastAvailable' => isset($set['LEGOCom']['CA']['dateLastAvailable']) ? $set['LEGOCom']['CA']['dateLastAvailable'] : '',
			],
			'DE' => [
				'retailPrice' => isset($set['LEGOCom']['DE']['retailPrice']) ? $set['LEGOCom']['DE']['retailPrice'] : '',
				'dateFirstAvailable' => isset($set['LEGOCom']['DE']['dateFirstAvailable']) ? $set['LEGOCom']['DE']['dateFirstAvailable'] : '',
				'dateLastAvailable' => isset($set['LEGOCom']['DE']['dateLastAvailable']) ? $set['LEGOCom']['DE']['dateLastAvailable'] : '',
			]
		];
	}

	private function setCollection($set)
	{
		return [
			'owned' => isset($set['collection']['owned']) ? $set['collection']['owned'] : '',
			'wanted' => isset($set['collection']['wanted']) ? $set['collection']['wanted'] : '',
			'quantityOwned' => isset($set['collection']['qtyOwned']) ? $set['collection']['qtyOwned'] : '',
			'userRating' => isset($set['collection']['rating']) ? $set['collection']['rating'] : '',
			'notes' => isset($set['collection']['notes']) ? $set['collection']['notes'] : '',
		];
	}
}
