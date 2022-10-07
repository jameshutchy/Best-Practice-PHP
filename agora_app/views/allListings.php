<?php
require_once 'lib/abstractView.php';
class allListingsView extends AbstractView {

	public function prepare () {
        $model = $this->getModel();
        $listings = $model->getListings();
        $role = $model->getRole();
        $content = 
        '<div class="d-flex justify-content-start flex-wrap">
            <div class="d-flex">
                <div class="form-outline border rounded-start searchInput">
                    <input type="search" id="searchListing" class="form-control" />
                    <label class="form-label" for="searchListing">Search</label>
                </div>
                <button type="button" class="btn btnColour rounded-end">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <select class="form-select border searchInput ml-2" aria-label="sortListings">
            <option selected disabled hidden>Sort</option>
            <option value="newest">Newest Listing</option>
            <option value="oldest">Oldest Listing</option>
            <option value="highest">Highest Price</option>
            <option value="lowest">Lowest Price</option>
            </select>';
        if ($role == 'seller'){
          include_once 'public/newListingButton.php';
        }           
        $content.='</div>
        <div class="mt-2 listingsContainer">';

        foreach ($listings as $listing) {
            $content.= 
            '<a href="listing.html">
              <div class="listingCard  rounded-2 border m-1">
                <h2 class="listingName p-2 rounded-top">'.$listing->getItemName().'</h2>
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