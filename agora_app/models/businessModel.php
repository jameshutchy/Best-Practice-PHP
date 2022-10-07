<?php 
class BusinessModel extends AbstractModel {

    private $businessID;
    private $name;
    private $hQaddress;
    private $hQCity;
    private $regID;
    private $bankNumber;
    private $logo;
    private $changed;
    
    //login will create userModel with empty properties and onload will generate, but for sign in will pass all properties to then be saved.
    public function __construct($db, $id=null, $name=null, $bankNumber=null, $regID=null, 
    $hQAddress=null, $hQCity=null, $logo=null) {
		parent::__construct($db);
        // id cant change
        $this->businessID=$id;
        $this->setBusinessName($name);
        $this->setRegID($regID);
		$this->setBankNumber($bankNumber);
		$this->setLogo($logo);
        $this->setHQAddress($hQAddress);
        $this->setHQCity($hQCity);
		$this->changed=false;
	}
    //Getters
	public function getBusinessID() {
		return $this->businessID;
	}
    public function getName() {
		return $this->name;
	}
	public function RegID() {
		return $this->regID;
	}
		
	public function getBankNumber() {
		return $this->bankNumber;
	}

	public function getLogo() {
        return $this->logo;
    }
    public function getHQAddress() {
        return $this->hQAddress;
    }
    
    public function getHQCity(){
        return $this->hQCity;
    }

	public function hasChanges() {
		return $this->changed;
	}

    public function setHQAddress($value){
        $this->hQAddress=$value;
        $this->changed=true;
    }

    public function setHQCity($value){
        $this->hQCity = $value;
        $this->changed=true;
    }

	public function setBusinessName($value) {
		$this->name=$value;
		$this->changed=true;
	}
    public function setRegID($value) {
		$this->regID=$value;
		$this->changed=true;
	}
    public function setBankNumber($value) {
		$this->bankNumber=$value;
		$this->changed=true;
	}
    public function setLogo($value) {
        $this->logo = $value;
        $this->changed=true; 
    }


	public function load($id) {   
            $this->businessID = $id;
            $sql="select * from business where businessID = '$id'";
            $rows=$this->getDB()->query($sql);
            if (count($rows)==0) {
                throw new InvalidDataException("user slkdjfkls $username not found");
            }
            $row=$rows[0];
            $this->name=$row['businessName'];
            $this->regID=$row['registrationNumber'];
            $this->bankNumber=$row['bankNumber'];
            $this->logo=$row['logo'];
            $this->hQaddress=$row['hqAddress'];
            $this->hQCity=$row['hqCity'];
            $this->changed=false;
        
		
	}
	
	public function save() {
		$id=$this->businessID;
		$name=$this->name;
        $addy=$this->hQaddress;
        $city=$this->hQCity;
        $bnknum=$this->bankNumber;
        $regID=$this->regID;
        $logo=$this->logo;
		
		if ($this->businessID===null) {
			$sql="insert into business(businessName, registrationNumber, bankNumber, logo, 
            hqAddress, hqCity) 
            values ("."'$name', '$regID', '$bnknum', '$logo', '$addy', '$city')";
			$this->getDB()->execute($sql);
			$this->businessID=$this->getDB()->getInsertID();	
		} else {
			$sql="update agorauser ".
					"set businessName='$name', ".
			            "registrationNumber='$regID', ".
                        "bankNumber='$bnknum', ".
                        "logo='$logo', ".
                        "hqAddress='$addy', ".
                        "hqCity='$city', ".
					"where businessID = $id";
			$this->getDB()->execute($sql);
		}
		$this->hasChanges=false;
	}
	
	public function delete () {
	    $sql="delete from business where businessID = $id";
		$rows=$this->getDB()->execute($sql);
		$this->id=$null;
		$this->changed=false;
	}
    // users
    public function getUsers(){
        $sql = "select * from agorauser where businessID =" .$this->businessID. "";
        $rows=$this->getDB()->query($sql);
        if (count($rows)==0) {
            throw new InvalidDataException("users not found");
        }
        foreach ($rows as $row){
            $id = $row['userID'];
            $firstName=$row['firstName'];
            $lastName=$row['lastName'];
            $username=$row['username'];
            $address=$row['address'];
            $city=$row['city'];
            $contactNumber=$row['contactNumber'];
            $role=$row['userRole'];
            $businessID=$row['businessID'];
            $email=$row['email'];
            $password=$row['userPassword'];
            $user = new UserModel($this->getDB(), $username, $id, $email, $password, $firstName, $lastName, $role, 
            $address, $city, $contactNumber, $businessID);
            $users=[];
            $users[]=$listing;
    }
    }




}
?>