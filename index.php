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
        <label for="text_get_all">GET DI TUTTI GLI STUDENTI</label>
        <input type="submit" value="PROVA GET (Tutti)"><br>
        
        <label for="text_get">GET DI UNO STUDENTE</label>
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
    <br><br>
    <form action="student.php" method="POST">
        <legend>Inserimento dati studente</legend>
        <label for="text_name">Inserisci il nome</label>
        <input type="name" name="name" required><br>
        <label for="text_surname">Inserisci il cognome</label>
        <input type="surname" name="surname" required><br>
        <label for="text_sisi_cod">Inserisci il sisi_cod</label>
        <input type="sisi_cod" name="sidi_cod" required><br>
        <label for="text_tax_cod">Inserisci il tax_cod</label>
        <input type="tax_cod" name="tax_cod" required><br>
        <input type="submit" value="Inserisci dati">
    </form>
</body>
</html>