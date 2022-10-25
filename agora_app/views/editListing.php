<?php
require_once 'lib/abstractView.php';
class EditListingView extends AbstractView {

	public function prepare () {
        $model = $this->getModel();
        $listing = $model->getSingleListing();
        $content = '<h1>Listing</h1>
        <form class="aForm p-4" method="post" enctype="multipart/form-data" action="##site##user.php/editListing/'.$listing->getID().'">
            <div class="mb-3">
                <div class="mb-3">
                    <label for="itemName" class="form-label">Item Name</label>
                    <input type="text" class="form-control" name="itemName" value="'.$listing->getItemName().'" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" name="description" value="'.$listing->getItemDescription().'" required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" name="price" value="'.$listing->getPrice().'" required>
                </div>
                <div class="mb-3">
                    <label for="hashTag" class="form-label">Hash Tag#</label>
                    <input type="text" class="form-control" name="hashTag" value="'.$listing->getHashTag().'" required>
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Photo</label>
                    <input type="file" class="form-control" name="uploadfile">
                </div>
                <div class="mb-3"></div>
                </div>
                <button type="submit" class="btn btnColour">Submit</button> 
            </div>
        </form>';
    include_once 'public/signOut.php';
    include 'public/navLogIn.php';
    $this->setTemplateField('nav', $nav);
		$this->setTemplateField('login', $login);
	  	$this->setTemplateField('content',$content);
		$this->setTemplateField('pagename', 'Edit Listing');

    }
}
?>