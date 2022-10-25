<?php
require_once 'lib/abstractView.php';
class SingleListingView extends AbstractView {

	public function prepare () {
        $fmt = numfmt_create( 'en_US', NumberFormatter::CURRENCY );
        $model = $this->getModel();
        $listing = $model->getSingleListing();
        $business = $model->getBusiness();
        include 'public/defineRole.php';
        $content = '
        <figure class=" d-flex justify-content-center"><img src="##site##images/'.$business->getLogo().'" class="img-fluid w-50" alt="Business Logo"></figure>
        <h2 class="ps-3">'.$listing->getItemName().'</h2> 
        <div class="singleListingContainer p-2">
            <div class="d-flex p-3">
                <figure class="w-25"><img src="##site##images/'.$listing->getPhoto().'" class="img-fluid" alt="'.$listing->getItemName().'"></figure>
                <div class="flex-grow-1 p-3">
                <h3 class="mb-3">'.numfmt_format_currency($fmt, $listing->getPrice(), "NZD").'</h3>
                <p>Seller: '.$listing->getSellerName().'</p>
                <p>Contact: '.$listing->getSellerContact().'</p>
                <p>Listed: '.$listing->getListingDate().'</p>
                <p>'.$listing->getHashTag().'</p>
            </div>
        </div>
    <p class="mb-0">Description:</p>
    
    <p>'.$listing->getItemDescription().'</p>';
    if ($role == 'Seller'){
        include_once 'public/sellerListingButton.php';
    }
    if ($role == 'Buyer'){
        include_once 'public/purchaseButton.php';
    }
    $content.='</div> ';
    include_once 'public/signOut.php';

    $this->setTemplateField('nav', $nav);
    $this->setTemplateField('login', $login);
      $this->setTemplateField('content',$content);
    $this->setTemplateField('pagename', 'Home');
    $this->setTemplateField('userProfile', $user);

    }
}
?>