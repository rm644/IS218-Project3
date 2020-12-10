<?php
class QuestionController extends Controller {
    public function __construct() {
       $this->questionModel = $this->model('Question');
    }

    public function list(){
        $user_id = $_SESSION['user_id'];
        
        $rows = $this->questionModel->loadForUser($user_id);

        $this->view('questions/list', $rows);
    }

    public function edit() {
        $this->view('questions/edit');
    }

    public function update() {
        $this->view('questions/updated');
    }

    public function create() {
        $this->view('questions/create');
    }

    public function save() {
        $this->view('questions/saved');
    }
}
?>