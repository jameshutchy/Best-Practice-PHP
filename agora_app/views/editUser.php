<?php
require_once 'lib/abstractView.php';
class EditUserView extends AbstractView {

	public function prepare () {
    $model = $this->getModel();
    include 'public/defineRole.php';
		$content='<h1>User</h1>
        <form class="aForm p-4" action="##site##user.php/editUser" method="post">
            <div id="sellerBuyer">
            <div class="mb-3">
              <label for="firstName" class="form-label">First Name</label>
              <input type="text" class="form-control" id="firstName" name="firstName" value="'.$model->getFirstName().'">
            </div>
            <div class="mb-3">
              <label for="lastName" class="form-label">Last Name</label>
              <input type="text" class="form-control" id="lastName" name="lastName" value="'.$model->getLastName().'">
            </div>
            <div class="mb-3">
              <label for="address" class="form-label">Street Address</label>
              <input type="text" class="form-control" id="address" name="address" value="'.$model->getAddress().'">
            </div>
            <div class="mb-3">
              <label for="city" class="form-label">City</label>
              <input type="text" class="form-control" id="city" name="city" value="'.$model->getCity().'">
            </div>
            <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" value="'.$model->getEmail().'">
          </div>
          <div class="mb-3">
          <label for="contactNumber" class="form-label">Contact Number</label>
          <input type="text" class="form-control" id="contactNumber" name="contactNumber" value="'.$model->getContactNumber().'">
        </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" value="">
          </div>
          <div class="mb-3">
            <label for="confirmPassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" ="confirmPassword" value="">
          </div>
          <button type="submit" class="btn btnColour">Submit</button> 
          </form>';

          include_once 'public/signOut.php';

          $this->setTemplateField('test', $model->getRole());
          $this->setTemplateField('nav', $nav);
              $this->setTemplateField('login', $login);
                $this->setTemplateField('content',$content);
              $this->setTemplateField('pagename', 'Edit Profile');
  }
}
  ?>