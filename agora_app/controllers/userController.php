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
                $view = new AddUserView();
                $view->setTemplate('html/form.html');
                if($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $model = new UserModel(
                    $db, $_POST["userName"], $_POST["firstName"], 
                    $_POST["lastName"], $_POST["address"],  
                    $_POST["address"], $_POST["city"], 
                    $_POST["contactNumber"], $_POST["role"],
                    $_POST["email"], $_POST["password"], 
                    $_POST["businessID"]);
                }
            break;
            case 'user':
                $id = $uri->getID();
                include_once 'views/userIndex.php';
                $view = new UserIndexView();
                $view->setTemplate('html/masterPage.html');
                $model->getUserByID($id);
                $model->loadBusiness($db);
            break;
            case 'signOut':
                // need to add session / unset session
                $id = $uri->getID();
                include_once 'views/index.php';
                $view = new IndexView();
                $view->setTemplate('html/masterPage.html');
                //$model->getUserByID($id);
            break;
            // TEST buyer and seller listings
            case 'allListings':
                $id = $uri->getID();
                include_once 'views/allListings.php';
                $view = new AllListingsView();
                $view->setTemplate('html/masterPage.html');
                $model->getUserByID($id);
                $model->loadListings('');
            break;
            case 'newListing':
                $id = $uri->getID();
                include_once 'views/listingForm.php';
                $view = new ListingFormView();
                $view->setTemplate('html/form.html');
                $model->getUserByID($id);
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
                $id = $uri->getID();
                include_once 'views/listingForm.php';
                $view = new ListingFormView();
                $view->setTemplate('html/form.html');
                $model->getUserByID($id);
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