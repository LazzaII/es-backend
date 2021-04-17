<!-- ESEMPIO curl --header "Content-Type: application/json" --request POST --data '{"_name":"Ciccio", "_surname":"Benve"}' http://localhost:8080  -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Api</title>
</head>
<body>
    <form action="student.php" method="GET">
        <label for="text">GET DI TUTTI GLI STUDENTI</label>
        <input type="submit" value="PROVA GET (Tutti)"><br>
        
        <label for="text">GET DI UNO STUDENTE</label>
        <select name="id">
            <option selected disabled hidden value="">Id Studente</option>
            <?php
                include('./class/DBConnection.php');

                $db = new DBConnection;
                $db = $db->returnConnection();
                $sql = "SELECT id FROM student ORDER BY id ASC;";
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                foreach($result as $key)
                {   
                    echo '<option value="' . $key['id'] . '">' . $key['id'] . '</option>';
                }   
            ?>
        </select>
        <input type="submit" value="GET DI UNO STUDENTE">
    </form> 
</body>
</html>