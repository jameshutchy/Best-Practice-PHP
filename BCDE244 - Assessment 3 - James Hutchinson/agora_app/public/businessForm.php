<?php
$content='<h1>Sign Up</h1>
<form class="aForm p-4" action="##site##user.php/signUp" method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="businessName" class="form-label">Business Name</label>
      <input type="text" class="form-control" id="businessName" name="businessName" value="'.$value.'" required>
    </div>
    <div class="mb-3">
      <label for="registrationID" class="form-label">NZ Registration Number</label>
      <input type="text" class="form-control" id="registrationID" name="registrationID" value="'.$value.'" required>
    </div>
    <div class="mb-3">
    <label for="contactNumber" class="form-label">Contact Number</label>
    <input type="text" class="form-control" id="contactNumber" name="contactNumber" value="'.$value.'" required>
  </div>
    <div class="mb-3">
      <label for="uploadfile" class="form-label">Business Logo</label>
      <input type="file" class="form-control" id="uploadFile" name="uploadfile"  value="'.$value.'" required>
    </div>
    <div class="mb-3">
      <label for="hQAddress" class="form-label">Head Quarters Address</label>
      <input type="text" class="form-control" id="hQAddress" name="hQAddress" value="'.$value.'" required>
    </div>
    <div class="mb-3">
      <label for="hQcity" class="form-label">Head Quarters City</label>
      <input type="text" class="form-control" id="hQCity" name="hQCity" value="'.$value.'" required>
    </div>
    <div class="mb-3">
    <label for="bankNumber" class="form-label">Bank Number</label>
    <input type="text" class="form-control" id="bankNumber" name="bankNumber" value="'.$value.'" required>
  </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email Address</label>
      <input type="email" class="form-control" id="email" name="email" value="'.$value.'" required>
    </div>
    <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name="userName" value="'.$value.'" required>
  </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" name="password" value="'.$value.'" required>
    </div>
    <div class="mb-3">
      <label for="confirmPassword" class="form-label">Confirm Password</label>
      <input type="password" class="form-control" name="confirmPassword" value="'.$value.'" required>
    </div>
    <button type="submit" class="btn btnColour" >Submit</button> 
    <a class="form-text"href="##site##user.php/login">Already have an account?... Sign in</a>
  </form>';
?>