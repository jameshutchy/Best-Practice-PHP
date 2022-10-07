<?php
include 'lib/abstractModel.php';
include 'models/listingModel.php';

class PeopleModel extends AbstractModel {

	private $people;
	
	public function __construct($db) {
		parent::__construct($db);
		$this->people=array();
		$this->load();
	}
	
	private function load() {
		$sql="CALL sp_loadAllListing()";
        $rows=$this->getDB()->query($sql);
		foreach ($rows as $row){
            $itemID=$row['itemID'];
			$itemName=$row['itemName'];
			$itemDescription=$row['itemDescription'];
			$photo=$row['photo'];
			$price=$row['price'];
			$listingDate=$row['listingDate'];
			$hashTag=$row['hashTag'];
			$sellerID=$row['sellerID'];
			$sellerContact=$row['contactNumber'];
			$sellerName=$row['sellerName'];
			$person = new ListingModel($this->getDB(),$itemID,$itemName,$itemDescription,$photo,$price,$listingDate,$hashTag,$sellerID,$sellerContact,$sellerName);
			$this->people[]=$person;
		}
	}
	
	public function getPeople() {
		return $this->people;
	}
}
?>