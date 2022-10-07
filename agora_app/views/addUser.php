<?php
require_once 'lib/abstractView.php';
class AddUserView extends AbstractView {

	public function prepare () {
		$content='<h1>Sign Up</h1>
        <form class="aForm p-4" action="##site##user.php/addUser" method="post">
            <div class="mb-3">
              <label for="accountType" class="form-label">Account Type</label>
              <select id="accountType" class="form-select">
                <option selected disabled hidden>Choose Account...</option>
                <option value="Seller">Seller</option>
                <option value="Buyer">Buyer</option>
              </select>
            </div>
            <div id="sellerBuyer">
            <div class="mb-3">
              <label for="firstName" class="form-label">First Name</label>
              <input type="text" class="form-control" id="firstName" name="firstName" required>
            </div>
            <div class="mb-3">
              <label for="lastName" class="form-label">Last Name</label>
              <input type="text" class="form-control" id="lastName" name="lastName" required>
            </div>
            <div class="mb-3">
              <label for="address" class="form-label">Street Address</label>
              <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="mb-3">
              <label for="city" class="form-label">City</label>
              <input type="text" class="form-control" id="city" name="city" required>
            </div>
            <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email"required>
          </div>
          <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="userName"required>
        </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" required>
          </div>
          <div class="mb-3">
            <label for="confirmPassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirmPassword" required>
          </div>
          <button type="submit" class="btn btnColour">Submit</button> 
          </form>';

          include_once 'public/signOut.php';
          include_once 'public/navLogIn.php';
          $this->setTemplateField('nav', $nav);
              $this->setTemplateField('login', $login);
                $this->setTemplateField('content',$content);
              $this->setTemplateField('pagename', 'Sign Up');