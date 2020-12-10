<?php
class QuestionController extends Controller {
    public function __construct() {
       $this->questionModel = $this->model('Question');
    }

    public function list(){
        $user_id = $_SESSION['user_id'];

        $rows = $this->questionModel->loadForUser($user_id);
        
        $data = ["rows" => $rows];

        $this->view('questions/list', $data);
    }

    public function edit() {
        $id = $_REQUEST['id'];

        $question = $this->questionModel->find($id);

        $data = ["question" => $question];

        $this->view('questions/edit', $data);
    }

    public function update() {
        $id = $_REQUEST['id'];
        $questionName = $_REQUEST['name'];
        $questionBody = $_REQUEST['body'];
        $questionSkills = $_REQUEST['skills'];

        $strResult = '';
        $isValidForm = true;

        if(strlen($questionName) == 0){
            $isValidForm = false;
            $strResult .= 'Question Name is empty<br/>';
        }
        else if(strlen($questionName) < 3) {
            $isValidForm = false;
            $strResult .= 'Question Name is too short<br/>';

        }
        else if(strlen($questionName) > 500) {
            $isValidForm = false;
            $strResult .= 'Question Name is too long<br/>';

            
        }
        
        if(strlen($questionBody) == 0){
            $isValidForm = false;
            $strResult .= 'Question Body is empty<br/>';
        }

        else if(strlen($questionBody > 500)) {
            $isValidForm = false;
            $strResult .= 'Question Body is too long<br/>';
        }
        

        if($isValidForm){
            echo "Here is your posted data<br/>";
            echo "$questionName<br>";
            echo "$questionBody<br>";
            $arSkills = explode (", ", $questionSkills);
            print_r($arSkills);

            $user_id = $_SESSION['user_id'];
            
            $question = array(
                    'name' => $questionName,
                    'body' => $questionBody,
                    'skills' => $questionSkills,
            );
            
            $this->questionModel->update($id, $question);

                echo "<a href='../question/list'>Show Questions</a>";
        }else{
            echo $strResult;

            echo "<a href='../question/list'>Show Questions</a>";
            }
        }


    public function create() {
        $this->view('questions/create');
    }

    public function save() {
        $questionName = $_REQUEST['name'];
        $questionBody = $_REQUEST['body'];
        $questionSkills = $_REQUEST['skills'];

        $strResult = '';
        $isValidForm = true;

        if(strlen($questionName) == 0){
            $isValidForm = false;
            $strResult .= 'Question Name is empty<br/>';
        }
        else if(strlen($questionName) < 3) {
            $isValidForm = false;
            $strResult .= 'Question Name is too short<br/>';

        }
        else if(strlen($questionName) > 500) {
            $isValidForm = false;
            $strResult .= 'Question Name is too long<br/>';

            
        }
        
        if(strlen($questionBody) == 0){
            $isValidForm = false;
            $strResult .= 'Question Body is empty<br/>';
        }

        else if(strlen($questionBody > 500)) {
            $isValidForm = false;
            $strResult .= 'Question Body is too long<br/>';
        }
        

        if($isValidForm){
            echo "Here is your posted data<br/>";
            echo "$questionName<br>";
            echo "$questionBody<br>";
            $arSkills = explode (", ", $questionSkills);
            print_r($arSkills);

            $user_id = $_SESSION['user_id'];
            
            $question = array(
                    'name' => $questionName,
                    'body' => $questionBody,
                    'skills' => $questionSkills,
                    'user_id' => $user_id
            );

            $this->questionModel->save($question);

                echo "<a href='../question/list'>Show Questions</a>";
        }else{
            echo $strResult;

            echo "<a href='../question/list'>Show Questions</a>";
            }
        }

        public function delete() {
            $id = $_REQUEST['id'];
    
            $this->questionModel->delete($id);
            
            header('location:../question/list');
        }
}
?>