<?php
require_once 'lib/abstractView.php';
class AdminUsersView extends AbstractView {

	public function prepare () {
        $model = $this->getModel();
        $business = $model->getBusiness();
        $users = $business->getUsers();
        $content = '<section class="d-flex flex-column">
        <div class="d-flex justify-content-start">
          <h1 class="flex-fill">Users</h1> 
          <a href="##site##user.php/addUser/'.$model->getID().'">
            <button class="btn btnColour m-1">Add User</button>
          </a>
        </div> 
        <div class="mt-2 listingsContainer">';
        if (count($users) > 1){
          foreach ($users as $user) {
            if ($user->getRole() !== 'admin'){
              $content.= 
              '<div class="listingCard  rounded-2 border m-1">
                <h2 class="listingName p-2 rounded-top">'.$user->getRole().'</h2>
                    
                <div class="d-flex flex-wrap justify-content-between">
                    <div class="m-1 px-2">
                      <p>Name<p>
                      <h5>'.$user->getFirstName(). " " .$user->getLastName().'</h5>                    
                  </div>

                  <div class="m-1 px-2">
                    <p>Email<p>
                    <h5>'.$user->getEmail().'</h5>    
                  </div> 
                  <div class="m-1 px-2">
                  <p>Contact No#</p>                   
                  <h5>'.$user->getContactNumber().'</h5>
                </div>

                  <div class="m-1 px-2">
                    <p>Address<p>
                    <h5>'.$user->getAddress().'</h5>     
                  </div>     

                  <div class="m-1 px-2">
                    <p>City</p>                   
                    <h5>'.$user->getCity().'</h5>
                  </div>
                  
                      <div class="m-1 d-flex">     
                        <a class="mt-3 href="##site##user.php/editUser/'.$user->getID().'"><button class="btn btnColour m-1">Edit Profile</button></a>
                        <a class="mt-3 href="##site##user.php/deleteUser/'.$user->getID().'"><button class="btn btnColour m-1">Delete</button></a>                                                       
                    </div>
                  </div>
                </div>';
            }          
        }
      }      
        else {
          $content.= '<h2>Create a Buyer Or Seller Account to start trading</h2>';
        }
        $content.='</div></section>';
        
        include 'public/defineRole.php';
        include_once 'public/signOut.php';
        $this->setTemplateField('nav', $nav);
		$this->setTemplateField('login', $login);
	  	$this->setTemplateField('content',$content);
		$this->setTemplateField('pagename', 'Home');
    $this->setTemplateField('userProfile', $user);

	}

}

?>