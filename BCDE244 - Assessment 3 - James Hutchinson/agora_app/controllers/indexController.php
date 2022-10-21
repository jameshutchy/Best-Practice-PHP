<?php
include 'lib/abstractController.php';
include 'views/index.php';




class IndexController extends AbstractController {

	public function __construct($context) {
		parent::__construct($context);
	}

	protected function getView($isPostback) {
		$model = null;
		$view=new IndexView();
		$view->setModel($model);
		$view->setTemplate('html/masterPage.html');
		return $view;
	}
	
}
?>