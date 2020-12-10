<?php
class UserController extends Controller {
    public function __construct() {
       $this->userModel = $this->model('User');
    }

    public function register(){
     
        $this->view('pages/registered', $data);
    }

    public function login(){

        $user = $this->userModel->login($email, $password);

        if(isset($user)){

        }
        else{
            $this->view('pages/loginfailed');
        }
        
    }
}
?>