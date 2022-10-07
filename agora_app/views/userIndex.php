<?php
require_once 'lib/abstractView.php';
class UserIndexView extends AbstractView {

	public function prepare () {
        $model = $this->getModel();
        
        include_once 'public/homeContent.php';
        $role = $model->getRole();
        if ($role == 'admin'){
          include_once 'public/adminProfile.php';      
        }
        else {
          include_once 'public/userProfile.php';
        }
        include_once 'public/signOut.php';

        include_once 'public/navLogIn.php';
        
      $this->setTemplateField('nav', $nav);
      $this->setTemplateField('login', $login);
      $this->setTemplateField('content',$content);
      $this->setTemplateField('pagename', 'Home');
      $this->setTemplateField('userProfile', $user);

	}

}

?>