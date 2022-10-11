<?php
require_once 'lib/abstractView.php';
class UserIndexView extends AbstractView {

	public function prepare () {
        $model = $this->getModel();
        
        include_once 'public/homeContent.php';
        include 'public/defineRole.php';
        include_once 'public/signOut.php';

        
        
      $this->setTemplateField('nav', $nav);
      $this->setTemplateField('login', $login);
      $this->setTemplateField('content',$content);
      $this->setTemplateField('pagename', 'Home');
      $this->setTemplateField('userProfile', $user);

	}

}

?>