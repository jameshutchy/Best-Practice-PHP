<?php 
$business = $model->getBusiness();
$user='<div>
<figure class="m-2"><img src="##site##images/'.$business->getLogo().'" class="img-fluid" alt="Business Logo"></figure>';
  
$user.='<div class="p-2 mt-2">';
$user.="<p>".$model->getFirstName()." ".$model->getLastName()."</p>
  <p>".$model->getEmail()."</p>
  <p>".$model->getAddress()."</p>
  <p>".$model->getCity()."</p>
  <p>".$model->getContactNumber()."</p>
</div>
</div>";
$user.='<a href="##site##user.php/editUser"><button class="btn m-1 btnColour">Edit Profile</button></a>';
?>