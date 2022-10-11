<?php
require_once 'lib/abstractView.php';
class editAdminView extends AbstractView {

	public function prepare () {
    $model = $this->getModel();
    $business = $model->getBusiness();
    $content='<h1>Profile</h1>
    <form class="aForm p-4" action="##site##user.php/editAdmin/'.$model->getID().'" method="post" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="businessName" class="form-label">Business Name</label>
          <input type="text" class="form-control" id="businessName" name="businessName" value="'.$business->getName().'">
        </div>
        <div class="mb-3">
          <label for="registrationID" class="form-label">NZ Registration Number</label>
          <input type="text" class="form-control" id="registrationID" name="registrationID" value="'.$business->getRegID().'">
        </div>
        <div class="mb-3">
        <label for="contactNumber" class="form-label">Contact Number</label>
        <input type="text" class="form-control" id="contactNumber" name="contactNumber" value="'.$model->getContactNumber().'">
      </div>
      <div class="mb-3">
        <label for="uploadfile" class="form-label">Business Logo</label>
        <input type="file" class="form-control" id="uploadFile" name="uploadfile">
      </div>
        <div class="mb-3">
          <label for="hQAddress" class="form-label">Head Quarters Address</label>
          <input type="text" class="form-control" id="hQAddress" name="hQAddress" value="'.$business->getHQAddress().'">
        </div>
        <div class="mb-3">
          <label for="hQcity" class="form-label">Head Quarters City</label>
          <input type="text" class="form-control" id="hQCity" name="hQCity" value="'.$business->getHQCity().'">
        </div>
        <div class="mb-3">
        <label for="bankNumber" class="form-label">Bank Number</label>
        <input type="text" class="form-control" id="bankNumber" name="bankNumber" value="'.$business->getBankNumber().'">
      </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email Address</label>
          <input type="email" class="form-control" id="email" name="email" value="'.$model->getEmail().'">
        </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" value="'.$model->getPassword().'">
    </div>
        <div class="mb-3">
            <label for="confirmPassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="confirmPassword" value="'.$model->getPassword().'">
        </div>

        <button type="submit" class="btn btnColour" >Submit</button> 
        <a class="form-text"href="##site##user.php/login">Already have an account?... Sign in</a>
      </form>';

    include_once 'public/adminProfile.php';
    include_once 'public/signOut.php';
    include_once 'public/navAdmin.php';
    $this->setTemplateField('nav', $nav);
    $this->setTemplateField('userProfile', $user);
		$this->setTemplateField('login', $login);
	  	$this->setTemplateField('content',$content);
		$this->setTemplateField('pagename', 'Edit Business');

	}
}