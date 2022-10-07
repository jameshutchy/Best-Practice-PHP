<?php 
class UserModel extends AbstractModel {

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
    private $Listings;
    private $changed;
    private $isLogedIn;
    
    //login will create userModel with empty properties and onload will generate, but for sign in will pass all properties to then be saved.
    public function __construct($db, $id=null, $email=null, $password=null, $firstName=null, $lastName=null, $role=null, 
    $address=null, $city=null, $contactNumber=null, $businessID=null) {
        //setter functions for exceptions ie businessID doesnt exist****
		parent::__construct($db);
        $this->userID=$id;
		$this->email=$email;
        $this->hashPassword($password);
		$this->setfirstName($firstName);
		$this->setLastName($lastName);
        $this->role=$role;
        $this->setAddress($address);
        $this->setCity($city);
        $this->setContactNumber($contactNumber);
        $this->setBusinessID($businessID);
		$this->changed=false;
	}
	
	public function getID() {
		return $this->userID;
	}
	
	public function getFirstName() {
		return $this->firstName;
	}
	
	public function setfirstName($value) {
		$this->firstName=$value;
		$this->changed=true;
	}
	
	public function getLastName() {
		return $this->lastName;
	}
	
	public function setLastName($value) {
		$this->lastName=$value;
		$this->changed=true;
	}
	
	public function hasChanges() {
		return $this->changed;
	}
    public function hashPassword($password) {
        if ($this->password !==null) {
            $this->password = password_hash($password, PASSWORD_BCRYPT);
        }
    } 
    public function getEmail() {
        return $this->email;
    }
    public function setEmail($value) {
        $this->email = $value;
        $this->changed=true; 
    }
	public function getRole() {
        return $this->role;
    }
    public function setAddress($value){
        $this->address=$value;
        $this->changed=true;
    }
    public function getAddress() {
        return $this->address;
    }
    public function setCity($value){
        $this->city = $value;
        $this->changed=true;
    }
    public function setContactNumber($value){
        $this->contactNumber = $value;
        $this->changed = true;
    }
    public function getContactNumber(){
        return $this->contactNumber;
    }
    public function setBusinessID($value){
        $sql="select * from business where businessID = $value";
        $rows=$this->getDB()->query($sql);
        if (count($rows)!==1) {
            throw new InvalidDataException("businessID $value not found");
        }
        $this->businessID = $value;
        $this->changed=true;
    }
    public function getBusinessID(){
        return $this->businessID;
    }
    //this will probly be in controller for user handle login 
    public function verifyPassword($email, $password){
        $sql="select password from agorauser where email = $email";
        $rows=$this->getDB()->query($sql);
        if (count($rows)!==0) {
            throw new InvalidDataException("Email $email not found");
        }
        $row=$rows[0];
        $hash=$row['password'];
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

	public function load($email) {
        if($this->verifyPassword()){
            $sql="select userID, firstName, lastName, 
            address, city, contactNumber, userRole, businessID, email, userpassword from agorauser".
                 "where email = $email";
            $rows=$this->getDB()->query($sql);
            if (count($rows)!==0) {
                throw new InvalidDataException("user email $email not found");
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
            $this->password=$row['userpassword'];
            $this->changed=false;
        }
		
	}
	
	public function saveBuyerSeller() {
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