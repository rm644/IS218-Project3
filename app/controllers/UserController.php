<?php
class UserController extends Controller {
    public function __construct() {
       $this->userModel = $this->model('User');
    }

    public function register(){
     
        $this->view('pages/registered', $data);
    }

    public function login(){
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];

        $user = $this->userModel->login($email, $password);

        if(isset($user)){
            $_SESSION['user_id'] = $user['id'];
            header('location:questions.php');
        }
        else{
            $this->view('pages/loginfailed');
        } 
    }
}
?>