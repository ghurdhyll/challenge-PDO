<?php
require_once 'connec.php';

$pdo = new \PDO(DSN, USER, PASS);


$query = "SELECT * FROM friend";
$statement = $pdo->query($query);

$friends = $statement->fetchAll(PDO::FETCH_ASSOC);
// ######### FORM ############### 

if (isset($_POST['user_firstname']) || isset($_POST['user_lastname'])) {
    $firstname = htmlspecialchars(trim($_POST['user_firstname']));
    $lastname = htmlspecialchars(trim($_POST['user_lastname']));

    if ($firstname !== '' || $lastname !== '') {
        $query = 'INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)';
        $statement = $pdo->prepare($query);

        $statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
        $statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);
        $statement->execute();
        header('location: index.php');
    }
}







//  ####### verification ######"

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
</head>

<body>

    <p>Let's be friends for eternity !</p>
    <div>
        <ul>
            <?php foreach ($friends as $friend) : ?>
                <li><?= $friend['firstname'] . ' ' . $friend['lastname'] ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <form action="" method="post">
        <p>Add yourself to my friend list !</p>
        <div>
            <label for="firstname">firstname :</label>
            <input type="text" id="firstname" name="user_firstname" required>
        </div>
        <div>
            <label for="lastname">lastname:</label>
            <input type="lastname" id="lastname" name="user_lastname" required>
        </div>
        <div class="button">
            <button type="submit">Add Friend</button>
        </div>
    </form>
</body>

</html>