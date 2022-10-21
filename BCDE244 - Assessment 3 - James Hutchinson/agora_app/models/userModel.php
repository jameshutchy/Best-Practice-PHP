<?php 
include 'lib/abstractModel.php';
include 'models/listingModel.php';
include 'models/businessModel.php';
class UserModel extends AbstractModel {

    private $userName;
    private $userID;
    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $role;
    private $address;
    private $city;
    private $contactNumber;
    private $businessID;
    private $business;
    private $listings;
    private $listing;
    private $changed;
    public $isLogedIn;
    
    //login will create userModel with empty properties and onload will generate, but for sign in will pass all properties to then be saved.
    public function __construct($db, 
    $username=null, $id=null, $email=null, 
    $password=null, $firstName=null, 
    $lastName=null, $role=null, 
    $address=null, $city=null, 
    $contactNumber=null, $businessID=null) {
		parent::__construct($db);
        $this->setUserName($username);
		$this->setEmail($email);
        $this->hashPassword($password);
		$this->setfirstName($firstName);
		$this->setLastName($lastName);
        // role and id cant change
        $this->userID=$id;
        $this->role=$role;
        $this->setAddress($address);
        $this->setCity($city);
        $this->setContactNumber($contactNumber);
        $this->setBusinessID($businessID);
		$this->changed=false;
	}
    //Getters
	public function getID() {
		return $this->userID;
	}
    public function getUserName() {
		return $this->userName;
	}
	public function getFirstName() {
		return $this->firstName;
	}
	
    public function getContactNumber(){
        return $this->contactNumber;
    }
	
	public function getLastName() {
		return $this->lastName;
	}

    public function getEmail() {
        return $this->email;
    }

	public function getRole() {
        return $this->role;
    }
    public function getAddress() {
        return $this->address;
    }
    public function getCity() {
        return $this->city;
    }
    
    public function getBusinessID(){
        return $this->businessID;
    }

    public function getBusiness() {
        return $this->business;
    }
    public function getPassword() {
        return $this->password;
    }
	public function hasChanges() {
		return $this->changed;
	}

    public function setEmail($value) {
        $this->email = $value;
        $this->changed=true; 
    }

    public function setAddress($value){
        $this->address=$value;
        $this->changed=true;
    }

    public function setCity($value){
        $this->city = $value;
        $this->changed=true;
    }
    public function setContactNumber($value){
        $this->contactNumber = $value;
        $this->changed = true;
    }
	public function setLastName($value) {
		$this->lastName=$value;
		$this->changed=true;
	}
    public function setfirstName($value) {
		$this->firstName=$value;
		$this->changed=true;
	}
    public function setUserName($value) {
		$this->userName=$value;
		$this->changed=true;
	}
    public function hashPassword($password) {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    } 

    public function setBusinessID($value){
        $this->businessID = $value;
        $this->changed=true;
    }

    //Need to call this! needs work
    public function verifyPassword($username, $password){
        $escp = $this->getDB();
        $sql="select userPassword from agorauser WHERE username = '$username'";
        $rows=$this->getDB()->query($sql);
        if (count($rows)==0) {
            throw new InvalidDataException("Username $username not found");
        }
        $row=$rows[0];
        $hash=$row['userPassword'];
        $result = false;
        if (password_verify($password, $hash)) {
            $result = true;
        }
        else 
        {
            $result = false;
        }
        return $result;
    }
    function userLogin($username, $password) {
        if($this->verifyPassword($username, $password)){
            session_start();
            $this->getUserByUserName($username);
            $_SESSION['id'] = $this->userID;
            $_SESSION['role'] = $this->role;
            $_SESSION['bussinesID'] = $this->$businessID;
        }
        else {
            throw new InvalidDataException("incorrect password");
        }

      }

    // get user 
	public function getUserByUserName($username) {   
            $this->username = $username;
            $sql="select * from agorauser where username = '$username'";
            $rows=$this->getDB()->query($sql);
            if (count($rows)==0) {
                throw new InvalidDataException("user email $username not found");
            }
            $row=$rows[0];
            $this->firstName=$row['firstName'];
            $this->lastName=$row['lastName'];
            $this->userID=$row['userID'];
            $this->address=$row['address'];
            $this->city=$row['city'];
            $this->contactNumber=$row['contactNumber'];
            $this->role=$row['userRole'];
            $this->businessID=$row['businessID'];
            $this->email=$row['email'];
            $this->password=$row['userPassword'];
            $this->changed=false;	
	}
    public function getUserByID($id) {   
        $this->userID = $id;
        $sql="select * from agorauser where userID = '$id'";
        $rows=$this->getDB()->query($sql);
        if (count($rows)==0) {
            throw new InvalidDataException("user id $id not found");
        }
        $row=$rows[0];
        $this->firstName=$row['firstName'];
        $this->lastName=$row['lastName'];
        $this->username=$row['username'];
        $this->address=$row['address'];
        $this->city=$row['city'];
        $this->contactNumber=$row['contactNumber'];
        $this->role=$row['userRole'];
        $this->businessID=$row['businessID'];
        $this->email=$row['email'];
        $this->password=$row['userPassword'];
        $this->changed=false;	
    }
	//needs work on update - Check
	public function save() {
		$id=$this->userID;
        $username=$this->userName;
		$first=$this->firstName;
		$last=$this->lastName;
        $addy=$this->address;
        $city=$this->city;
        $number=$this->contactNumber;
        $role=$this->role;
        $busID=$this->businessID;
        $email=$this->email;
        $pass=$this->password;
        $busID=$this->businessID;
		
		if ($this->userID===null) {
			$sql="insert into agorauser(username, email, userPassword, firstName, lastName, 
            address, city, contactNumber, userRole, businessID) 
            values ("."'$username', '$email', '$pass', '$first', '$last', '$addy', '$city', '$number', '$role', '$busID')";
			$this->getDB()->execute($sql);
			$this->userID = $this->getDB()->getInsertID();	
		} else {
			$sql="update agorauser ".
					"set email='$email', ".
			            "userPassword='$pass', ".
                        "firstName='$first', ".
                        "lastName='$last', ".
                        "address='$addy', ".
                        "city='$city', ".
                        "contactNumber='$number', ".
                        "businessID='$busID'".
					"where userID= $id";
			$this->getDB()->execute($sql);
		}
		$this->hasChanges=false;
	}
	//needs work
	public function delete () {
	    $sql="delete from agorauser where userID = $id";
		$rows=$this->getDB()->execute($sql);
		$this->id=$null;
		$this->changed=false;
	}
    // Business
    public function editBusiness($db, $id, $busName, $bnkNum, $regID, $hQAddy, $hQCity, $logo){
        $business = new BusinessModel($db, $id, $busName, $bnkNum, $regID, $hQAddy, $hQCity, $logo);
        $business->save();
        return $business;
    }
    public function loadBusiness($db){
        $business = new BusinessModel($db);
        $business->load($this->businessID);
        $this->business = $business;
    }
    // Listings
    public function loadListings($word){
        switch($this->role){
            case 'admin':
                $sql = "call sp_searchListingAdmin(".$this->businessID.", '$word')";
            break;
            case 'Seller':               
                $sql = "call sp_searchListingSeller(".$this->userID.",'$word')";
            break;
            case 'Buyer':
                $sql = "call sp_searchListingBuyer(".$this->businessID.", '$word')";
            break;
        }
        $rows=$this->getDB()->query($sql);
        if (count($rows)!==0) {
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
            $listing = new ListingModel($this->getDB(),$itemID,$itemName,$itemDescription,$photo,$price,$listingDate,$hashTag,$sellerID,$sellerContact,$sellerName);
            $this->listings[]=$listing;
        }
    }
    }
    public function editListing($db, $id, $itemName, $itemDescription, $price, $hashTag, $photo){
        $listing = new ListingModel($db, $id, $itemName, $itemDescription, $photo, 
        $price, null, $hashTag, $this->userID, null, null);
        $listing->save();
    }
    public function getListings(){
        return $this->listings;
    }
    // load and get single listing
    public function loadListingByID($id){
        $theListing = new ListingModel($this->getDB(), null, null, null, null, null, null, null, null, null, null);
        $theListing->load($id);
        $this->listing = $theListing;
    }
    public function getSingleListing(){
        return $this->listing;
    }

}
?>