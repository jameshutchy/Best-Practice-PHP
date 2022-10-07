<?php 
$user='<div>
<figure class="m-2"><img src="##site##images/BusinessLogo.png" class="img-fluid" alt="Business Logo"></figure>';
  
$user.='<div class="p-2 mt-2">';
$user.="<p>".$model->getFirstName()." ".$model->getLastName()."</p>
  <p>".$model->getEmail()."</p>
  <p>".$model->getAddress()."</p>
  <p>".$model->getCity()."</p>
  <p>".$model->getContactNumber()."</p>
</div>
</div>";
$user.='<a href="index.html"><button class="btn m-1 btnColour">Edit Profile</button></a>';
?>