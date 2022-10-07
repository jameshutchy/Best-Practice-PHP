<?php 
class ListingModel extends AbstractModel {

    private $itemID;
    private $itemName;
    private $itemDescription;
    private $photo;
    private $price;
    private $listingDate;
    private $hashTag;
    private $sellerID;
    private $sellerContact;
    private $sellerName;
    private $changed;
    
    //login will create userModel with empty properties and onload will generate, but for sign in will pass all properties to then be saved.
    public function __construct($db, $id=null, $itemName=null, $itemDescription=null, $photo=null, $price=null, $listingDate=null, 
    $hashTag=null, $sellerID=null, $sellerContact=null, $sellerName=null) {
        //setter functions for exceptions ie businessID doesnt exist****
		parent::__construct($db);
        $this->itemID=$id;
		$this->setItemName($itemName);
        $this->setItemDescription($itemDescription);
		$this->setPhoto($photo);
		$this->setPrice($price);
        $this->setListingDate($listingDate);
        $this->setHashTag($hashTag);
        $this->setSellerID($sellerID);
        $this->setSellerContact($sellerContact);
        $this->setsellerName($sellerName);
		$this->changed=false;
	}
	
	public function getID() {
		return $this->itemID;
	}
	
	public function getItemName() {
		return $this->itemName;
	}
	
	public function setItemName($value) {
		$this->itemName=$value;
		$this->changed=true;
	}
	
	public function getItemDescription() {
		return $this->itemDescription;
	}
	
	public function setItemDescription($value) {
		$this->ItemDescription=$value;
		$this->changed=true;
	}
	
	public function hasChanges() {
		return $this->changed;
	}
    public function setPhoto($value) {
        $this->photo=$value;
    } 
    public function getPhoto() {
        return "<img src="."./images/$this->photo"."/>";
    }
    public function setPrice($value) {
        $this->price = $value;
        $this->changed=true; 
    }
    public function getPrice() {
        return $this->price;
    }
    public function setListingDate($value){
        $this->listingDate=$value;
        $this->changed=true;
    }
    public function getListingDate() {
        return $this->listingDate;
    }
    public function setHashTag($value){
        $this->hashTag = $value;
        $this->changed=true;
    }
    public function getHashTag() {
        return $this->hashTag;
    }
    public function setSellerID($value){
        
        $this->sellerID = $value;
        $this->changed = true;
    }
    public function getSellerID(){
        return $this->sellerID;
    }
    public function setSellerContact($value){
        $this->sellerContact = $value;
        $this->changed=true;
    }
    public function getSellerContact(){
        return $this->sellerContact;
    }
    public function setSellerName($value){
        $this->sellerName = $value;
        $this->changed=true;
    }
    public function getSellerName(){
        return $this->sellerName;
    }

	public function load($id) {  
        $this->itemID = $id;     
        $sql="CALL sp_loadListing($id)";
        $rows=$this->getDB()->query($sql);
        if (count($rows)!==0) {
            throw new InvalidDataException("listing id $id not found");
        }
        $row=$rows[0];
        $this->itemName=$row['itemName'];
        $this->itemDescription=$row['itemDescription'];
        $this->photo=$row['photo'];
        $this->price=$row['price'];
        $this->listingDate=$row['listingDate'];
        $this->hashTag=$row['hashTag'];
        $this->sellerID=$row['sellerID'];
        $this->sellerContact=$row['contactNumber'];
        $this->sellerName=$row['sellerName'];
        $this->changed=false;
        
		
	}
	
	public function save() {
		$id=$this->userID;
		$first=$this->firstName;
		$last=$this->lastName;
        $addy=$this->address;
        $city=$this->city;
        $number=$this->contactNumber;
        $role=$this->role;
        $busID=$this->businessID;
        $email=$this->email;
        $pass=$this->password;
		
		if ($this->id===null) {
			$sql="insert into agorauser(email, userpassword, firstName, lastName, 
            address, city, contactNumber, userRole, businessID) 
            values ("."'$email', '$password', '$first', '$last', '$addy', '$city', '$number', '$role', '$busID')";
			$this->getDB()->execute($sql);
			//$this->id=getDB()->insertID();	
		} else {
			$sql="update agorauser ".
					"set email='$email', ".
			            "userpassword='$password', ".
                        "firstName='$first', ".
                        "lastName='$last', ".
                        "address='$addy', ".
                        "city='$city', ".
                        "contactNumber='$number', ".
                        "userRole='$role', ".
                        "businessID='$busID', ".
					"where userID= $id";
			$this->getDB()->execute($sql);
		}
		$this->hasChanges=false;
	}
	
	public function delete () {
	    $sql="delete from agorauser where userID = $id";
		$rows=$this->getDB()->execute($sql);
		$this->id=$null;
		$this->changed=false;
	}





}
?>