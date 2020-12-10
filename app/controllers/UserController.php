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
        $password = md5($_REQUEST['password']);

        $user = $this->userModel->login($email, $password);

        if(isset($user)){
            $name = $user->first_name;

	        if(isset($user->last_name))
                $name = $name . ', ' . $user->last_name;
        
            $_SESSION['user_id'] = $user->id;
            $_SESSION['name'] = $name;

            header('location:../question/list');
        }
        else{
            $this->view('pages/loginfailed');
        } 
    }
}
?>