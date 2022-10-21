<?php
require_once 'lib/abstractView.php';
class SingleListingView extends AbstractView {

	public function prepare () {
        $model = $this->getModel();
        $listing = $model->getSingleListing();
        $business = $model->getBusiness();
        include 'public/defineRole.php';
        $content = '
        <figure class="w-50"><img src="##site##images/'.$business->getLogo().'" class="img-fluid  text-center" alt="Business Logo"></figure>
        <h2>'.$listing->getItemName().'</h2> 
        <div class="singleListingContainer p-2">
            <div class="d-flex p-3">
                <figure class="w-25"><img src="##site##images/'.$listing->getPhoto().'" class="img-fluid" alt="'.$listing->getItemName().'"></figure>
                <div class="flex-grow-1 p-3">
                <h3 class="mb-3">Price: '.$listing->getPrice().'</h3>
                <p>HashTag#: '.$listing->getHashTag().'</p>
                <p>Date Listed: '.$listing->getListingDate().'</p>
            </div>
        </div>
    <p class="mb-0">Description:</p>
    <p>The Royal Gala apple was developed as a cross between the Golden Delicious and a Kids Orange Red in the North Island of New Zealand in the 1930s by Mr Kidd. The Royal Gala is a red mutation of the Gala apple.</p>';
    include_once 'public/sellerListingButton.php';
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