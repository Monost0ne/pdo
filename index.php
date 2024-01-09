<!DOCTYPE html>

<html>

<?php

require_once 'connec.php';
$pdo = new \PDO(DSN, USER, PASS);
// A exécuter afin d'afficher vos lignes déjà insérées dans la table friends

if ($_SERVER['REQUEST_METHOD']=='POST') {
    $firstName = trim($_POST['firstname']);
    $lastName = trim($_POST['lastname']);

    $query = "INSERT INTO friend (firstname, lastname) VALUES (:firstname,:lastname)";
    $statement = $pdo->prepare($query);

    $statement->bindValue(':firstname', $firstName, PDO::PARAM_STR);
    $statement->bindValue(':lastname', $lastName, PDO::PARAM_STR);

    $statement->execute();
}

$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friendsObject = $statement->fetchAll(PDO::FETCH_OBJ);
?>
<ul>
<?php foreach($friendsObject as $friend) { ?>
    <li><?php echo "$friend->firstname $friend->lastname"?></li>
<?php }
?>
</ul>
<form method="post" action="">
    <label for="firstname">Firstname :</label>
    <input type="text" id="firstname" name="firstname" required><br>

    <label for="lastname">Lastname :</label>
    <input type="text" id="lastname" name="lastname" required><br>

    <input type="submit" value="Send">
</form>
<?php
header('index.php');
exit();
?>
</html>