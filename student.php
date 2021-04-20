<?php
  include('./class/Student.php');
  $method = $_SERVER["REQUEST_METHOD"];
  $student = new Student();

  switch($method) {
    case 'GET':
      $id = $_GET['id'];
      if (isset($id)) //Get method with id return only one   student
      {
        $student = $student->find($id);
        $js_encode = json_encode(array('state'=>TRUE, 'student'=>$student),true);
      }else //Get method without id return all the student from db
      {
        $students = $student->all();
        $js_encode = json_encode(array('state'=>TRUE, 'students'=>$students),true);
      }
      header("Content-Type: application/json");
      echo($js_encode);
      break;

    case 'POST': //Post method used to add a student in the db   
      //to get the last id for the new Student
      $numStudent = count($student->all());
      $result = $student->all();

      $student->_id = $result[$numStudent-1]['id']+1;
      $student->_name = $_POST["name"];
      $student->_surname = $_POST["surname"];
      $student->_sidiCode = $_POST["sidi_cod"];
      $student->_taxCode = $_POST["tax_cod"];
      $student->add($student);
      echo "Studente inserito";
      break;

    case 'DELETE': //Delete method used to delete a student from db using ID
      $substringedURI = explode('/', $_SERVER["REQUEST_URI"]); //To get the id of the student  
      if(count($substringedURI) != 0)
      {
        $student->delete($substringedURI[count($substringedURI)-1]);
        echo "Studente eliminato";
      }
      else echo "ID non inserito";
      break;

    case 'PUT': //Put method used to update information of a student
      $substringedURI = explode('/', $_SERVER["REQUEST_URI"]); //To get the id of the student  
      if(count($substringedURI) != 0)
      {
        $body = file_get_contents("php://input"); //get the body
        $decodeBody = json_decode($body, true);

        $student->_id = $substringedURI[count($substringedURI)-1];
        $student->_name = $decodeBody["_name"];
        $student->_surname = $decodeBody["_surname"];
        $student->_sidiCode = $decodeBody["_sidiCode"];
        $student->_taxCode = $decodeBody["_taxCode"];
  
        $student->update($student);
        echo "Dati studente aggiornati";
      }
      else echo "ID non inserito";
      break;

    default: 
      echo "Metodo non gestito"; 
      break;
  }
?>
