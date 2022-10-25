<?php
require_once 'lib/abstractView.php';
class allListingsView extends AbstractView {

	public function prepare () {
    $fmt = numfmt_create( 'en_US', NumberFormatter::CURRENCY );
        $model = $this->getModel();
        $listings = $model->getListings();
        $role = $model->getRole();
        $content = 
        '<div class="d-flex justify-content-start flex-wrap">
            <div class="d-flex">
                <div class="form-outline border rounded-start searchInput">
                <form method="post" action="##site##user.php/allListings">
                    <input type="search" id="searchListing" name="searchListing" class="form-control" />
                    <label class="form-label" for="searchListing">Search</label>
                </div>
                <button type="submit" class="btn btnColour rounded-end">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <select name="sort" onchange="this.form.submit()" class="form-select border searchInput ml-2" aria-label="sortListings">
            <option selected disabled hidden>Sort</option>
            <option value="newest">Newest Listing</option>
            <option value="oldest">Oldest Listing</option>
            <option value="highest">Highest Price</option>
            <option value="lowest">Lowest Price</option>
            </select>
            </form>';
        if ($role == 'Seller'){
          include_once 'public/newListingButton.php';
        }           
        $content.='</div>
        <div class="mt-2 listingsContainer">';
        if ($listings != null){
        foreach ($listings as $listing) {
            $content.= 
            '<a href="##site##/user.php/singleListing/'.$listing->getID().'">
              <div class="listingCard  rounded-2 border m-1">
                <h2 class="listingName p-2 rounded-top">'.$listing->getItemName().'</h2>
                <div class="m-1 d-flex">
                  <img src="##site##images/'.$listing->getPhoto().'" class="listImage m-2" alt="'.$listing->getItemName().'">
                  <div class="m-1">
                  <h2>'.numfmt_format_currency($fmt, $listing->getPrice(), "NZD").'</h2>
                  <p>Seller: '.$listing->getSellerName().'</p>
                  <p>Contact: '.$listing->getSellerContact().'</p>
                  <p>'.$listing->getHashTag().'</p>
                  <span class="listingAge">Listed '.$listing->getListingDate().'</span>
                </div>
                </div>
              </div>
            </a>';
        }
      }
        $content.='</div>';
        
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