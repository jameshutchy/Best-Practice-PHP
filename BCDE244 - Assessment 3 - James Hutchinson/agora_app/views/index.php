<?php
require_once 'lib/abstractView.php';
class IndexView extends AbstractView {

	public function prepare () {
		include_once 'public/homeContent.php';
		include_once 'public/navNotLogIn.php';
		$section = "<figure class='m-1'><img src='images/handShake.jpg' class='img-fluid' alt='Hand Shake'></figure>          
		<div class='p-2 mt-2'>
		  <h2 class='py-1'>Reliability Without Compromise</h2>
		  <p>Your customer's goal is to get the right product for the job at the right price and they depend on you to do that. Your B2B e-commerce solution should be one that buyers can rely on to provide always-accurate, data-rich and secure information and processes.</p>         
		</div> 
	  
	  <a href='##site##user.php/signUp'><button class='btn m-1 btnColour'>Get Started</button></a>";
	  include_once 'public/signInAndUp.php';

	  	$this->setTemplateField('nav', $nav);
		$this->setTemplateField('login', $login);
	  	$this->setTemplateField('content',$content);
		$this->setTemplateField('userProfile', $section);
		$this->setTemplateField('pagename', 'Home');

	}
}
?>