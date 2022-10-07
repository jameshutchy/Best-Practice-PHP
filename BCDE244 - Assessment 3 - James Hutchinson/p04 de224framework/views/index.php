<?php
include 'lib/abstractView.php';
class IndexView extends AbstractView {

	public function prepare () {
		$people=$this->getModel()->getPeople();
		$content="<div>
		<h2 class='py-1'>The Right Solution</h2>
		<p>As a manufacturer, wholesaler or distributor, you need a solution that was built for your specific needs. Whether these are the needs of your business from an internal perspective or from your customer's perspective: You need a solution that offers B2B compatibility.</p>
	  </div>

	  <figure class='p-1'>
		  <img src='images/newsImage.png' class='img-fluid' alt='Business To business e-commerce diagram'>
		  <figcaption class='fig-caption p-1'>Business to business Agora Trading</figcaption>
		</figure>";

		$section = "<figure class='m-1'><img src='images/handShake.jpg' class='img-fluid' alt='Hand Shake'></figure>          
		<div class='p-2 mt-2'>
		  <h2 class='py-1'>Reliability Without Compromise</h2>
		  <p>Your customer's goal is to get the right product for the job at the right price and they depend on you to do that. Your B2B e-commerce solution should be one that buyers can rely on to provide always-accurate, data-rich and secure information and processes.</p>         
		</div> 
	  
	  <a href='signUp.html'><button class='btn m-1 btnColour'>Get Started</button></a>";
		$this->setTemplateField('mainContent',$content);
		$this->setTemplateField('userProfile', $section);

	}
}
?>