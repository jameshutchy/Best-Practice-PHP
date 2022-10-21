<?php
	include 'lib/context.php';
	include 'controllers/userController.php';
	
	$context=Context::createFromConfigurationFile("website.conf");
	$index = new UserController($context);
	$index->process();



?>