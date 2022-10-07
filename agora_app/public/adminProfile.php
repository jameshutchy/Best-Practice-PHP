<?php 
$business = $model->getBusiness();
$user='<div>
<figure class="m-2"><img src="##site##images/'.$business->getLogo().'" class="img-fluid" alt="Business Logo"/></figure>';
  
$user.='<div class="p-2 mt-2">';
$user.="<p>".$business->getName()."</p>
  <p>".$model->getEmail()."</p>
  <p>".$business->getHQAddress()."</p>
  <p>".$business->getHQCity()."</p>
  <p>".$model->getContactNumber()."</p>
</div>
</div>";
$user.='<a href="index.html"><button class="btn m-1 btnColour">Edit Profile</button></a>';
?>