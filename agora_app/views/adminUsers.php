<?php
require_once 'lib/abstractView.php';
class AdminUsersView extends AbstractView {

	public function prepare () {
        $model = $this->getModel();
        $business = $model->getBusiness();
        $users = $business->getUsers();
        $content = '<h1>Users</h1>'
        //GOT TO HERE !!!!
        foreach ($users as $user) {
            $content.= 
            '<a href="listing.html">
              <div class="listingCard  rounded-2 border m-1">
                <h2 class="listingName p-2 rounded-top">'.$user->getItemName().'</h2>
                <div class="m-1 d-flex">
                  <img src="##site##images/'.$listing->getPhoto().'" class="listImage m-2" alt="'.$listing->getItemName().'">
                  <div class="m-1">
                  <h2>Price: '.$listing->getPrice().'</h2>
                  <p>Seller: '.$listing->getSellerName().'</p>
                  <p>Contact: '.$listing->getSellerContact().'</p>
                  <p>'.$listing->getHashTag().'</p>
                  <span class="listingAge">Listed '.$listing->getListingDate().'</span>
                </div>
                </div>
              </div>
            </a>';
        }
        $content.='</div>';
        
        $role = $model->getRole();
        if ($role == 'admin'){
          include_once 'pubic/adminProfile.php';
        }
        else {
          include_once 'public/userProfile.php';
        }
        include_once 'public/signOut.php';
        include_once 'public/navLogIn.php';
        $this->setTemplateField('nav', $nav);
		$this->setTemplateField('login', $login);
	  	$this->setTemplateField('content',$content);
		$this->setTemplateField('pagename', 'Home');
    $this->setTemplateField('userProfile', $user);

	}

}

?>