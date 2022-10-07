<?php
	include 'lib/context.php';
	include 'controllers/indexController.php';
	
	$context=Context::createFromConfigurationFile("website.conf");
	$index = new IndexController($context);
	$index->process();
	
?>