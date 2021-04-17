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
      $body = file_get_contents("php://input");
      $decodeBody = json_decode($body, true);

      //Only to get the last id
      /* $db = new DBConnection;
      $db = $db->returnConnection();
      $sql = "SELECT id FROM student ORDER BY id DESC LIMIT 1;";
      $stmt = $db->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll(\PDO::FETCH_ASSOC); */

      /* $student->_id = $result[0]['id']+1;
      $student->_name = $js_decoded["_name"];
      $student->_surname = $js_decoded["_surname"];
      $student->_sidiCode = $js_decoded["_sidiCode"];
      $student->_taxCode = $js_decoded["_taxCode"];

      $student->add($student); */
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
     
      $id = substr($_SERVER["REQUEST_URI"], -1); //To get the id of the student  
      $body = file_get_contents("php://input");
      $decodeBody = json_decode($body, true);

      $student->_id = $id;
      $student->_name = $js_decoded["_name"];
      $student->_surname = $js_decoded["_surname"];
      $student->_sidiCode = $js_decoded["_sidiCode"];
      $student->_taxCode = $js_decoded["_taxCode"];

      $student->update($student);

      break;

    default: 
      echo "Metodo non gestito"; 
      break;
  }
?>
