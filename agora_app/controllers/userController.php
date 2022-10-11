<?php
include 'lib/abstractController.php';
include 'models/userModel.php';

class UserController extends AbstractController {

	public function __construct($context) {
		parent::__construct($context);
	}
	protected function getView($isPostback) {
        $db=$this->getDB();
		$uri=$this->getURI();
		$action=$uri->getPart();
        $model = new UserModel($db);
        $view = null;     
		switch ($action) {
            case 'login':
                include_once 'views/login.php';
                $view = new LoginView();
                $view->setTemplate('html/form.html');
                if($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $model->verifyPassword($username, $password);
                    //need some work here!!!! - Create Session
                    $model->getUserByUserName($username);
                    $this->redirect_to('user/'. $model->getID().'');
                }
                break;
            case 'signUp':
                include_once 'views/signUp.php';
                $view = new SignUpView();
                $view->setTemplate('html/form.html');
                if($_SERVER['REQUEST_METHOD'] == 'POST') {  
                    $logo = $this->addImgFile();         
                    $business = $model->editBusiness($db, null,
                    $_POST["businessName"], 
                    $_POST["bankNumber"],
                    $_POST["registrationID"],  
                    $_POST["hQAddress"], 
                    $_POST["hQCity"], $logo); 
                    $model= new UserModel($db, $_POST["userName"], null, $_POST["email"], $_POST["password"],
                    null, null, "admin", null, null, $_POST["contactNumber"], $business->getBusinessID());
                    $model->save(); 
                    $this->redirect_to('user/'. $model->getID().'');          
            }
            break;
            case 'addUser':
                include_once 'views/addUser.php';
                include_once 'lib/initModel.php';
                $view = new AddUserView();

                $view->setTemplate('html/form.html');
                if($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $user = new UserModel(
                    $db, $_POST["userName"], null, $_POST["email"], 
                    $_POST["password"], $_POST["firstName"], 
                    $_POST["lastName"], $_POST["role"], 
                    $_POST["address"], $_POST["city"], 
                    $_POST["contactNumber"],                      
                    $model->getBusinessID());
                    $user->save();
                }
            break;
            case 'user':
                include_once 'lib/initModel.php';
                include_once 'views/userIndex.php';
                $view = new UserIndexView();
                $view->setTemplate('html/masterPage.html');
            break;
            case 'signOut':
                // need to add session / unset session
                include_once 'lib/initModel.php';
                include_once 'views/index.php';
                $view = new IndexView();
                $view->setTemplate('html/masterPage.html');
                //$model->getUserByID($id);
            break;
            // TEST buyer and seller listings
            case 'allListings':
                include_once 'lib/initModel.php';
                include_once 'views/allListings.php';
                $view = new AllListingsView();
                $view->setTemplate('html/masterPage.html');
                $model->loadListings('');
            break;
            case 'newListing':
                include_once 'lib/initModel.php';
                include_once 'views/listingForm.php';
                $view = new ListingFormView();
                $view->setTemplate('html/form.html');
                if($_SERVER['REQUEST_METHOD'] == 'POST') {  
                    $photo = $this->addImgFile();         
                    $model->editListing($db, null,
                    $_POST["itemName"], 
                    $_POST["description"],
                    $_POST["price"],                    
                    $_POST["hashTag"],
                    $photo); 
                 $this->redirect_to('/agora_app/user.php/allListings/' . $model->getID().'');          
            }
            break;
            case 'admin':
                include_once 'lib/initModel.php';
                include_once 'views/adminUsers.php';
                $view = new AdminUsersView();
                $view->setTemplate('html/masterPage.html');
            break;
            case 'editAdmin':
                include_once 'lib/initModel.php';
                include_once 'views/editAdmin.php';
                $view = new EditAdminView();
                $view->setTemplate('html/masterPage.html');
                $business = $model->getBusiness();
                $view->setTemplateField('test', $model->getUserName());
                if($_SERVER['REQUEST_METHOD'] == 'POST') {  
                    if ($_FILES["uploadfile"]["name"] == ""){
                        $logo = $business->getLogo();
                    } 
                    else {    
                        $logo = $this->addImgFile(); 
                    }      
                    $business = $model->editBusiness($db, $model->getBusinessID(),
                    $_POST["businessName"], 
                    $_POST["bankNumber"],
                    $_POST["registrationID"],  
                    $_POST["hQAddress"], 
                    $_POST["hQCity"], $logo);  
                    $updateModel= new UserModel($db, $model->getUserName(), $model->getID(), $_POST["email"], $_POST["password"],
                    null, null, "admin", null, null, $_POST["contactNumber"], $model->getBusinessID());
                    $updateModel->save();
                 $this->redirect_to('/agora_app/user.php/user/' . $model->getID().'');          
            }
            break;
            case 'editUser':
                include_once 'views/editUser.php';
                include_once 'lib/initModel.php';
                $view = new EditUserView();
                $view->setTemplate('html/form.html');
                if($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $user = new UserModel(
                    $db, $model->getUserName(), $id, $_POST["email"], 
                    $_POST["password"], $_POST["firstName"], 
                    $_POST["lastName"], $model->getRole(), 
                    $_POST["address"], $_POST["city"], 
                    $_POST["contactNumber"],                      
                    $model->getBusinessID());
                    $user->save();
                    $this->redirect_to('/agora_app/user.php/user/' . $model->getID().''); 
                }
            break;
			default:
				throw new InvalidRequestException ("Invalid action in URI");
		}
        $view->setModel($model);
		return $view;
	}
    private function addImgFile(){
        $filename   = uniqid() . "-" . time();
        $extension  = pathinfo( $_FILES["uploadfile"]["name"], PATHINFO_EXTENSION );
        $basename   = $filename . "." . $extension;
    
        $source = $_FILES["uploadfile"]["tmp_name"];
        $destination  = "./images/{$basename}";

        move_uploaded_file( $source, $destination );
        return $basename;
}
}