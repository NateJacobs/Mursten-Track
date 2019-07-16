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
		$this->name = $set['name'];
		$this->year = $set['year'];
		$this->pieces = $set['pieces'];
		$this->minifigs = $set['minifigs'];
		$this->bricksetURL = $set['bricksetURL'];
		$this->released = $set['released'];
		$this->ownedByTotal = $set['ownedByTotal'];
		$this->wantedByTotal = $set['wantedByTotal'];
		$this->USDateAddedToSAH = $set['USDateAddedToSAH'];
		$this->USDateRemovedFromSAH = $set['USDateRemovedFromSAH'];
		$this->rating = $set['rating'];
		$this->reviewCount = $set['reviewCount'];
		$this->packagingType = $set['packagingType'];
		$this->availability = $set['availability'];
		$this->instructionsCount = $set['instructionsCount'];
		$this->ageMin = $set['ageMin'];
		$this->ageMax = $set['ageMax'];
		$this->category = $set['category'];
		$this->EAN = $set['EAN'];
		$this->UPC = $set['UPC'];
		$this->lastUpdated = $set['lastUpdated'];

		return $this;
	}

	private function setNumbers($set)
	{
		return [
			'setID' => $set["setID"],
			'number' => $set["number"],
			'numberVariant' => $set["numberVariant"],
		];
	}

	private function setThemes($set)
	{
		return [
			'theme' => $set["theme"],
			'themeGroup' => $set["themeGroup"],
			'subtheme' => $set["subtheme"],
		];
	}

	private function setDimensions($set)
	{
		return [
			'height' => $set["height"],
			'width' => $set["width"],
			'depth' => $set["depth"],
			'weight' => $set["weight"],
		];
	}

	private function setImages($set)
	{
		return [
			'image' => $set["image"],
			'imageFilename' => $set["imageFilename"],
			'thumbnailURL' => $set["thumbnailURL"],
			'largeThumbnailURL' => $set["largeThumbnailURL"],
			'imageURL' => $set["imageURL"],
			'additionalImageCount' => $set["additionalImageCount"],
		];
	}

	private function setPrices($set)
	{
		return [
			'UKRetailPrice' => $set["UKRetailPrice"],
			'USRetailPrice' => $set["USRetailPrice"],
			'CARetailPrice' => $set["CARetailPrice"],
			'EURetailPrice' => $set["EURetailPrice"],
		];
	}

	private function setCollection($set)
	{
		return [
			'owned' => $set["owned"],
			'wanted' => $set["wanted"],
			'quantityOwned' => $set["qtyOwned"],
			'userRating' => $set["userRating"],
			'AdvancedCollectionDataCount' => $set["ACMDataCount"],
		];
	}
}
